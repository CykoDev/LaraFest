<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;

class ApplicantController extends Controller
{
    //
    public function enroll($id) {
        $package = Package::findOrFail($id);
        return view('packages.applicants.enroll', compact('package'));
    }

    public function store(Request $request) {

    }
}
