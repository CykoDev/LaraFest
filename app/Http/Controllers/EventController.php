<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use \DOMDocument;

use App\Photo;
use App\Event;
use App\EventType;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = EventType::pluck('name', 'id')->all();
        return view('events.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $event = new Event;

        // Event Image
        if($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('img/'.$event->imageFolder, $name);
            $photo = Photo::create([
                'path' => $event->imageFolder.$name,
                'type' => 'event_photo',
                'uploaded_by_user_id' => Auth::user()->id,
                ]);
            $input['photo_id'] = $photo->id;
        }

        // Event Content Images
        $dom = new DomDocument();
		$dom->loadHtml($request->details, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

		foreach($images as $img){
			$src = $img->getAttribute('src');

			if(preg_match('/data:image/', $src)){

				preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];

				$filename = uniqid();
				$filepath = "/img/$filename.$mimetype";

				$image = Image::make($src)
				  ->encode($mimetype, 100)
				  ->save(public_path($filepath));

				$new_src = asset($filepath);
				$img->removeAttribute('src');
                $img->setAttribute('src', $new_src);

                Photo::create([
                    'path'=>$filename.'.'.$mimetype,
                    'type'=>'event_content_media',
                    'uploaded_by_user_id' => Auth::user()->id,
                    ]);
			}
		}
        $input['details'] = $dom->saveHTML();

        // Event creation
        $event->create($input);
        return redirect(route('events.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $event = Event::whereSlug($slug)->firstOrFail();
        $types = EventType::pluck('name', 'id')->all();
        return view('events.edit', compact('event', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $input = $request->all();
        $event = Event::whereSlug($slug)->firstOrFail();

        // Event Image
        if($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            $file->move('img/'.$event->imageFolder, $name);
            $photo = Photo::create([
                'path' => $event->imageFolder.$name,
                'type' => 'event_photo',
                'uploaded_by_user_id' => Auth::user()->id,
                ]);
            $input['photo_id'] = $photo->id;

            if($event->photo){

                unlink(public_path() . $event->photo->path);
                Photo::findOrFail($event->photo->id)->delete();
            }
        }

        // Event Content Images
        $dom = new DomDocument();
		$dom->loadHtml($request->details, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

		foreach($images as $img){
			$src = $img->getAttribute('src');

			if(preg_match('/data:image/', $src)){

				preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];

				$filename = uniqid();
				$filepath = "/img/$filename.$mimetype";

				$image = Image::make($src)
				  ->encode($mimetype, 100)
				  ->save(public_path($filepath));

				$new_src = asset($filepath);
				$img->removeAttribute('src');
                $img->setAttribute('src', $new_src);

                Photo::create([
                    'path'=>$filename.'.'.$mimetype,
                    'type'=>'event_content_media',
                    'uploaded_by_user_id' => Auth::user()->id,
                    ]);
			}
        }
        $input['details'] = $dom->saveHTML();

        // Event update
        $event->update($input);
        Session::flash('status', [
            'class' => 'success',
            'message' => 'Event successfully updated',
        ]);
        return redirect(route('events.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if($event->photo){
            unlink(public_path() . $event->photo->path);
            Photo::findOrFail($event->photo->id)->delete();
        }
        $event->delete();
        Session::flash('status', [
            'class' => 'danger',
            'message' => 'Event successfully deleted',
        ]);
        return redirect(route('events.index'));
    }
}
