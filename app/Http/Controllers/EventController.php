<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use \DOMDocument;

use App\Photo;
use App\Event;
use App\EventType;
use App\Discount;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('applicant')->only('indexBrowse', 'enroll', 'unEnroll', 'showView');
        $this->middleware('monitor')->only('index', 'show');
        $this->middleware('moderator')->only('createDiscount', 'storeDiscount', 'destroyDiscount');
        $this->middleware('moderator')->except('index', 'show', 'indexBrowse', 'enroll', 'unEnroll', 'showView');
    }

    public function enroll($slug)
    {
        $event = Event::whereSlug($slug)->firstOrFail();
        Auth::user()->events()->save($event, ['user_id' => Auth::id()]);
        $event->expense()->create([
            'price' => $event->price,
            'user_id' => Auth::id(),
            'name' => 'Event: ' . $event->name,
        ]);
        return redirect()->back();
    }

    public function unEnroll($slug)
    {
        $event = Event::whereSlug($slug)->firstOrFail();
        Auth::user()->events()->detach($event);
        Auth::user()->expenses()->where('expendable_id', '=', $event->id)->delete();
        return redirect()->back();
    }

    public function index()
    {
        $events = Event::all();
        return view('events.index.info', compact('events'));
    }

    public function indexBrowse()
    {
        if (Auth::user()->data['registration_type']) {
            if (Auth::user()->data['registration_type'] == 'nustian' || Auth::user()->package()->exists()) {
                $events = Event::paginate(9);
                return view('events.index.browse', compact('events'));
            }
        }
        return redirect()->back();
    }

    public function create()
    {
        $types = EventType::pluck('name', 'id')->all();
        return view('events.create', compact('types'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['event_date'] = strtotime($input['event_date']);
        $input['end_date'] = strtotime($input['end_date']);

        $event = new Event;

        // Event Image
        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('img/' . $event->imageFolder, $name);
            $photo = Photo::create([
                'path' => $event->imageFolder . $name,
                'type' => 'event_photo',
                'uploaded_by_user_id' => Auth::user()->id,
            ]);
            $input['photo_id'] = $photo->id;
        }

        // Event Content Images
        if ($request->details) {
            $dom = new DomDocument();
            $dom->loadHtml($request->details, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            foreach ($images as $img) {
                $src = $img->getAttribute('src');

                if (preg_match('/data:image/', $src)) {

                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];

                    $filename = uniqid();
                    $filepath = 'img/' . $event->imageFolder . "content/$filename.$mimetype";

                    $image = Image::make($src)
                        ->encode($mimetype, 100)
                        ->save(public_path($filepath));

                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);

                    Photo::create([
                        'path' => $event->imageFolder . 'content/' . $filename . '.' . $mimetype,
                        'type' => 'event_content_media',
                        'uploaded_by_user_id' => Auth::user()->id,
                    ]);
                }
            }
            $input['details'] = $dom->saveHTML();
        }

        // Event creation
        $event->create($input);
        return redirect(route('events.index'));
    }

    public function show($slug)
    {
        $event = Event::whereSlug($slug)->firstOrFail();
        return view('events.show.info', compact('event'));
    }

    public function showView($slug)
    {
        $event = Event::whereSlug($slug)->firstOrFail();
        return view('events.show.view', compact('event'));
    }

    public function edit($slug)
    {
        $event = Event::whereSlug($slug)->firstOrFail();
        $types = EventType::pluck('name', 'id')->all();
        return view('events.edit', compact('event', 'types'));
    }

    public function update(Request $request, $slug)
    {
        $input = $request->all();
        $input['event_date'] = strtotime($input['event_date']);
        $input['end_date'] = strtotime($input['end_date']);

        $event = Event::whereSlug($slug)->firstOrFail();

        // Event Image
        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('img/' . $event->imageFolder, $name);
            $photo = Photo::create([
                'path' => $event->imageFolder . $name,
                'type' => 'event_photo',
                'uploaded_by_user_id' => Auth::user()->id,
            ]);
            $input['photo_id'] = $photo->id;

            if ($event->photo) {

                if (Storage::exists($event->photo->path)) {
                    unlink(public_path() .  $event->photo->path);
                }
                Photo::findOrFail($event->photo->id)->delete();
            }
        }

        // Event Content Images
        if ($request->details) {
            $dom = new DomDocument();
            $dom->loadHtml($request->details, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            foreach ($images as $img) {
                $src = $img->getAttribute('src');

                if (preg_match('/data:image/', $src)) {

                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];

                    $filename = uniqid();
                    $filepath = 'img/' . $event->imageFolder . "content/$filename.$mimetype";

                    $image = Image::make($src)
                        ->encode($mimetype, 100)
                        ->save(public_path($filepath));

                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);

                    Photo::create([
                        'path' => $event->imageFolder . 'content/' . $filename . '.' . $mimetype,
                        'type' => 'event_content_media',
                        'uploaded_by_user_id' => Auth::user()->id,
                    ]);
                }
            }
            $input['details'] = $dom->saveHTML();
        }

        // Event update
        $event->update($input);
        Session::flash('status', [
            'class' => 'success',
            'message' => 'Event successfully updated',
        ]);
        return redirect(route('events.index'));
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if ($event->photo) {
            if (Storage::exists($event->photo->path)) {
                unlink(public_path() .  $event->photo->path);
            }
            Photo::findOrFail($event->photo->id)->delete();
        }
        $event->delete();
        Session::flash('status', [
            'class' => 'danger',
            'message' => 'Event successfully deleted',
        ]);
        return redirect(route('events.index'));
    }

    public function createDiscount($id)
    {
        $event = Event::findOrFail($id);
        return view('events.discounts.create', compact('event'));
    }

    public function storeDiscount(Request $request)
    {
        $event = Event::findOrFail($request->eventId);
        if ($event->discount) $event->discount()->delete();
        $event->discount()->create($request->all());
        return redirect(route('events.show', $event->slug));
    }

    public function destroyDiscount($id)
    {
        Discount::findOrFail($id)->delete();
        return redirect()->back();
    }
}
