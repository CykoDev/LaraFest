<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo()
    {
        // $role = Auth::user()->role->name;

        $user = Auth::user();

        if ($user->isAdmin()) {
            return route('admin.home');
        } else if ($user->isApplicant()) {
            return route('applicant.home');
        } else if ($user->isModerator()) {
            return route('moderator.home');
        } else if ($user->isMonitor()) {
            return route('monitor.home');
        } else {
            return RouteServiceProvider::HOME;
        }

        // switch ($role) {
        //     case 'admin':
        //         return '/home/admin';
        //         break;
        //     case 'applicant':
        //         return '/home/applicant';
        //         break;
        //     case 'moderator':
        //         return '/home/moderator';
        //         break;
        //     case 'monitor':
        //         return '/home/monitor';
        //         break;
        //     default:
        //         return RouteServiceProvider::HOME;
        // }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
