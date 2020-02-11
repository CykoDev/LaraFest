<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Photo;
use App\Event;

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
        return view('events.create');
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
        if($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('img', $name);
            $photo = Photo::create([
                'path' => $name,
                'type' => 'event_photo',
                'uploaded_by_user_id' => Auth::user()->id,
                ]);
            $input['photo_id'] = $photo->id;
        }
        Event::create($input);
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
        return view('events.edit', compact('event'));
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

        if($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            $file->move('img', $name);
            $photo = Photo::create([
                'path' => $name,
                'type' => 'event_photo',
                'uploaded_by_user_id' => Auth::user()->id,
                ]);
            $input['photo_id'] = $photo->id;

            if($event->photo){

                unlink(public_path() . $event->photo->path);
                Photo::findOrFail($event->photo->id)->delete();
            }
        }

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
