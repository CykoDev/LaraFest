<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Role;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index()
    {
        $user = Auth::user();
        switch (true) {
            case $user->isAdmin():

                $users = User::all();
                $roles = Role::all();
                for ($i = 0; $i < 12; $i++) {
                    $userMonthCount[$i + 1] = User::whereMonth('created_at', $i + 1)->count();
                }
                return view('home.admin', compact(
                    'users',
                    'userMonthCount',
                    'roles',
                ));
                break;

            case $user->isModerator():

                $users = User::all();
                $roles = Role::all();
                for ($i = 0; $i < 12; $i++) {
                    $userMonthCount[$i + 1] = Role::whereName('applicant')->firstOrFail()->users()->whereMonth('created_at', $i + 1)->count();
                }
                return view('home.moderator', compact(
                    'users',
                    'userMonthCount',
                    'roles',
                ));
                break;

            case $user->isMonitor():

                $users = User::all();
                $roles = Role::all();
                for ($i = 0; $i < 12; $i++) {
                    $userMonthCount[$i + 1] = Role::whereName('applicant')->firstOrFail()->users()->whereMonth('created_at', $i + 1)->count();
                }
                return view('home.monitor', compact(
                    'users',
                    'userMonthCount',
                    'roles',
                ));
                break;

            case $user->isApplicant():

                // return view('home.applicant.comingsoon');

                if (is_null($user->profile_completed_at)) {
                    return view('home.applicant.starter');
                } else {
                    return view('home.applicant.enrolled');
                }
                break;

            default:

                return view('welcome');
                break;
        }
    }
}
