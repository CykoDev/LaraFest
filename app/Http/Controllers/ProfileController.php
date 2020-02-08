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

    public function update(Request $request) {

        $input = $request->all();
        $user = Auth::user();
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
        $user->update($input);
        return redirect(route('profile.edit'));
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

        // if (isset($request->Yes)) dd('Yes!');
        // else if (isset($request->No)) dd('No!');

        // $user = Auth::user();
        // if (!isset($$user->data['registrationType'])) {
        //     if ($request->submit == 'yes') {
        //         $userType = 'nustian';
        //         $userData['registrationType'] = $userType;
        //         $user->data = $userData;
        //         $user->save();
        //         $stage = 'form';
        //         return view('profile.edit', compact('stage', 'userType'));
        //     }
        //     else if ($request->submit == 'no') {
        //         $stage = 'register';
        //         return view('profile.edit', compact('stage'));
        //     }
        //     else if ($request->submit == 'student') {
        //         $userType = 'non-nustian';
        //         $userData['registrationType'] = $userType;
        //         $user->data = $userData;
        //         $user->save();
        //         $stage = 'form';
        //         return view('profile.edit', compact('stage', 'userType'));
        //     }
        //     else {
        //         $userType = 'professional';
        //         $userData['registrationType'] = $userType;
        //         $user->data = $userData;
        //         $user->save();
        //         $stage = 'form';
        //         return view('profile.edit', compact('stage', 'userType'));
        //     }
        // }
        // elseif ($user->profile_completed_at == null) {

        //     if ($request->submit == 'continue') {
        //         $stage = 'form';
        //         $userType = $userData['registrationType'];
        //         return view('profile.edit', compact('stage', 'userType'));
        //     }
        //     $user->data = ['exists' => 'yes'];
        //     $user->save();
        //     return redirect('/dashboard');
        // }
        // else {
        //     $stage = 'event';
        //     $userType = $userData['registrationType'];
        //     $choiceType = 'package';
        //     if ($userType == 'nustian') {
        //         if ($request->submit = 'individual') {
        //             $choiceType = 'individual';
        //         }
        //     }
        //     return view('profile.edit', compact('stage', 'choiceType'));
        // }
    }

    public function store(Request $request) {

        $user = Auth::user();
        $userData = $user->data;
        $userData = array_merge($userData, $request->all());
        $user->data = $userData;
        $user->profile_completed_at = now();
        $user->save();
        return redirect(route('dashboard'));
    }
}
