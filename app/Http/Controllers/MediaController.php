<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Photo;

class MediaController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('monitor')->only('index');
        $this->middleware('moderator')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('media.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move('img', $name);
        $photo = Photo::create([
            'path' => $name,
            'uploaded_by_user_id' => Auth::user()->id,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        unlink(public_path().$photo->path);
        $photo->delete();
        return redirect(route('media.index'));
    }

    public function destroyMany(Request $request){

        if(isset($request->delete)){

            // $this->destroy($request->photo_id);
            return $request->photo_id;
            return redirect(route('media.index'));
        }
        elseif (isset($request->deleteMany) && !empty($request->checkBoxArray)) {

            $photos = Photo::findOrFail($request->checkBoxArray);
            foreach($photos as $photo){

                unlink(public_path().$photo->path);
                $photo->delete();
            }
            return redirect(route('media.index'));
        }
        else {
            return redirect(route('media.index'));
        }
    }
}
