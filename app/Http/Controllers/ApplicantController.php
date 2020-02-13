<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Event;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    //
    public function enrollPackage($id) {
        $package = Package::findOrFail($id);
        return view('packages.applicants.enroll', compact('package'));
    }

    public function storePackage(Request $request) {
        $userId = Auth::user()->id;
        $package = Package::findOrFail($request->packageId);
        foreach($request->eventIds as $id) {
            $event = Event::findOrFail($id);
            $package->events()->save($event, ['user_id' => $userId]);
        }
        $package->expense()->create(['price' => $package->price, 'user_id' => $userId]);
        dd($request->all());
    }
}
