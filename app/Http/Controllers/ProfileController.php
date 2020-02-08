<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function edit(Request $request)
    {
        // if (isset($request->Yes)) dd('Yes!');
        // else if (isset($request->No)) dd('No!');
        if (Auth::check()) {
            $user = Auth::user();
            $userData = $user->data;
            if (!isset($userData['registrationType'])) {
                if ($request->submit == 'yes') {
                    $userType = 'nustian';
                    $userData['registrationType'] = $userType;
                    $user->data = $userData;
                    $user->save();
                    $stage = 'form';
                    return view('profile.edit', compact('stage', 'userType'));
                } else if ($request->submit == 'no') {
                    $stage = 'register';
                    return view('profile.edit', compact('stage'));
                } else if ($request->submit == 'student') {
                    $userType = 'non-nustian';
                    $userData['registrationType'] = $userType;
                    $user->data = $userData;
                    $user->save();
                    $stage = 'form';
                    return view('profile.edit', compact('stage', 'userType'));
                } else {
                    $userType = 'professional';
                    $userData['registrationType'] = $userType;
                    $user->data = $userData;
                    $user->save();
                    $stage = 'form';
                    return view('profile.edit', compact('stage', 'userType'));
                }
            } else if ($user->profile_completed_at == null) {
                if ($request->submit == 'continue') {
                    $stage = 'form';
                    $userType = $userData['registrationType'];
                    return view('profile.edit', compact('stage', 'userType'));
                }
                $user->data = ['exists' => 'yes'];
                $user->save();
                return redirect('/dashboard');
            } else {
                $stage = 'event';
                $userType = $userData['registrationType'];
                $choiceType = 'package';
                if ($userType == 'nustian') {
                    if ($request->submit = 'individual') {
                        $choiceType = 'individual';
                    }
                }
                return view('profile.edit', compact('stage', 'choiceType'));
            }
        }
    }

    public function store(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            $userData = $user->data;
            $userData = array_merge($userData, $request->all());
            $user->data = $userData;
            $user->profile_completed_at = now();
            $user->save();
            return redirect('/dashboard');
        }
    }
}
