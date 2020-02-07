<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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

                    $users = User::all();
                    $roles = Role::all();

                    for($i=0; $i < 12; $i++){

                        $userMonthCount[$i+1] = User::whereMonth('created_at', $i+1)->count();
                    }
                    return view('home.admin', compact(
                        'users', 'userMonthCount', 'roles',
                    ));
                    break;
                case $user->isModerator():

                    return view('home.moderator');
                    break;
                case $user->isMonitor():

                    return view('home.monitor');
                    break;
                default:
                    
                    return view('home.applicant');
                    break;
            }
        }
        else {
            return view('welcome');
        }
    }

    public function adminUser()
    {
        return view('dashboard.admin');
    }

    public function getApplicant(Request $request)
    {
        if ($request->session()->get('stage') === null) {
            $request->session()->put('stage', '1');
        }
        // $stage = $request->session()->get('stage');
        $stage = '1';
        error_log('This stage: ' . $stage);
        return view('dashboard.applicant', compact('stage'));
    }

    public function postApplicant(Request $request)
    {
        $stage = $request->session()->get('stage');
        // if ($theStage !== null) {
        //     return view('dashboard.moderator', compact('theStage'));
        // } else {
        //     // $stage = session('stage');
        //     return view('dashboard.monitor');
        // }
        $data = $request->all();
        switch ($stage) {
            case '1':
                $request->session()->put('applicant-data', $data);
                if ($request->work == 'P') {
                    $request->session()->put('stage', '2p');
                    $stage = '2p';
                    error_log('Professional Stage: ' . $stage);
                } else {
                    $request->session()->put('stage', '2p');
                    $stage = '2s';
                    error_log('Student Stage: ' . $stage);
                }
                break;
            case '2s':
                error_log('Surprise!!!!!');
                session(['applicant-data' => session('applicant-data') . $data]);
                break;
        }
        $theData = $request->session()->get('applicant-data');
        return view('dashboard.applicant', compact('stage', 'theData'));
    }

    public function moderator()
    {
        return view('dashboard.moderator');
    }

    public function monitor()
    {
        return view('dashboard.monitor');
    }
}
