<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Photo;
use App\Package;

class ProfileController extends Controller
{
    public function __construct(){

        $this->middleware('applicant');
    }

    public function update(Request $request, $route) {
        $input = $request->all();
        $user = Auth::user();
        if ($images = $request->file('data')){
            foreach($images as $key => $image){
                $type = substr($key, 0, strrpos($key, '_id'));
                $name = time().$image->getClientOriginalName();
                $image->move('img', $name);
                $photo = Photo::create([
                    'path' => $name,
                    'type' => $type,
                    'uploaded_by_user_id' => Auth::user()->id,
                ]);
                $input['data'][$key] = $photo->id;
                if($user->photo($type)){
                    unlink(public_path() . $user->photo($type)->path);
                    Photo::findOrFail($user->photo($type)->id)->delete();
                }
            }
        }
        if($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('img', $name);
            $photo = Photo::create([
                'path' => $name,
                'type' => 'user_photo',
                'uploaded_by_user_id' => Auth::user()->id,
                ]);
            $input['photo_id'] = $photo->id;
            if($user->photo){
                unlink(public_path() . $user->photo->path);
                Photo::findOrFail($user->photo->id)->delete();
            }
        }
        if(isset($input['data']) && isset($user->data)){
            $input['data'] = array_merge($user->data, $input['data']);
        }
        $user->update($input);
        return redirect(route($route));
    }

    public function edit(Request $request) {

        if(!isset(Auth::user()->data['registration_type'])) {
            $packages = Package::where('id', 2)->orWhere('id', 3)->get();
            return view('profile.applicant.package-options', compact('packages'));
        }
        switch(Auth::user()->data['registration_type']) {
            case 'nustian':
                return view('profile.applicant.edit.nustian');
                break;
            case 'non_nustian':
                return view('profile.applicant.edit.non-nustian');
                break;
            case 'professional':
                return view('profile.applicant.edit.professional');
                break;
            default:
                Auth::user()['data->registration_type'] = null;
                Auth::user()->save();
                return redirect(route('dashboard'));
                break;
        }
    }
}
