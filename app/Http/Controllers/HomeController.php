<?php

namespace App\Http\Controllers;

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
        return view('home');
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
