<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
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
        $this->middleware('moderator')->except('index', 'download', 'downloadZip');
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
        $file->move('img/uploads', $name);
        $photo = Photo::create([
            'path' => 'uploads/'.$name,
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
        return redirect()->back();
    }

    public function delete($id)
    {
        $photo = Photo::findOrFail(hex2bin($id));
        unlink(public_path().$photo->path);
        $photo->delete();
        return redirect()->back();
    }

    public function download($filepath)
    {
        $path = hex2bin($filepath);
        return response()->download(public_path().$path, str_replace('/', '', substr($path, -10)));
    }

    public function manageMany(Request $request){

        if (!empty($request->checkBoxArray)) {

            if (isset($request->deleteMany)) {

                $photos = Photo::findOrFail($request->checkBoxArray);
                foreach($photos as $photo){

                    unlink(public_path().$photo->path);
                    $photo->delete();
                }
                return redirect(route('media.index'));
            }
            elseif (isset($request->downloadZipMany)) {

                $zip = new ZipArchive;
                $zipFile = time() . 'zipped_media.zip';
                if ($zip->open(public_path($zipFile), ZipArchive::CREATE) === TRUE) {
                    $media = Photo::findOrFail($request->checkBoxArray);
                    foreach ($media as $mediaItem) {
                        $zip->addFile(public_path().$mediaItem->path, basename($mediaItem->path));
                    }
                    $zip->close();
                }
                return response()->download(public_path($zipFile))->deleteFileAfterSend(true);
            }
            else {
                return redirect(route('media.index'));
            }
        }
        else {
            return redirect(route('media.index'));
        }
    }
}
