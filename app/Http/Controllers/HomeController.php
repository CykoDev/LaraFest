<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()){
            $user = Auth::user();
            switch(true) {
                case $user->isAdmin():
                    return view('home.admin');
                case $user->isModerator():
                    return view('home.moderator');
                case $user->isMonitor():
                    return view('home.monitor');
                default:
                    return view('home.viewer');
            }
        }
        else {
            return view('welcome');
        }
    }
}
