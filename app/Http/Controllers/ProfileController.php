<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
    //
    public function store(Request $request) {
        // if (isset($request->Yes)) dd('Yes!');
        // else if (isset($request->No)) dd('No!');
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            if (!isset($user->data['registrationType'])) {
                if ($request->submit == 'yes') {
                    $user->data['registrationType'] = 'nustian';
                    $user->save();
                    dd('NUSTian!');
                } else {
                    dd('Non-NUSTian!');
                }
            } else {
                dd('The next page!');
            }
        }
    }
}
