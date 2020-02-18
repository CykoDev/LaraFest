<?php

namespace App\Http\Controllers;

use App\Package;
use App\PackageQuota;
use App\EventType;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('applicant')->only('indexBrowse', 'enroll', 'unEnroll', 'showView');
        $this->middleware('monitor')->only('index',);
        $this->middleware('admin')->except('index', 'indexBrowse', 'enroll', 'unEnroll', 'showView', 'show');
    }

    public function enroll(Request $request, $route)
    {
        $user = Auth::user();
        $package = Package::findOrFail($request->packageId);
        $user->package()->associate($package)->save();
        if ($request->eventIds) {
            foreach ($request->eventIds as $id) {
                $event = Event::findOrFail($id);
                $user->package()->events()->save($event, ['user_id' => $user->id]);
            }
        }
        $package->expense()->create(['price' => $package->price, 'user_id' => $user->id]);
        return redirect(route($route));
    }

    public function unEnroll($slug)
    {
    }

    public function index()
    {
        $packages = Package::all();
        return view('packages.index.info', compact('packages'));
    }

    public function indexBrowse()
    {
        return view('packages.index.browse');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($slug)
    {
        $package = Package::whereSlug($slug)->firstOrFail();
        return view('packages.show.info', compact('package'));
    }

    public function showView($slug)
    {
        $package = Package::whereSlug($slug)->firstOrFail();
        return view('packages.show.view', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $package = Package::whereSlug($slug)->firstOrFail();
        $eventTypes = EventType::pluck('name', 'id')->all();
        return view('packages.edit', compact('package', 'eventTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // dd($request->quotas['id']);

        $package = Package::findOrFail($id);
        $quotas = $request->quotas;

        if ($request->quotas) {
            for ($i = 0; $i < sizeof($package->quotas); $i++) {
                if (in_array($package->quotas[$i]->id, $quotas['id'])) {
                    $index = array_search($package->quotas[$i]->id, $quotas['id']);
                    $package->quotas[$i]->update([
                        'event_type_id' => $quotas['event_type_id'][$index],
                        'quota_amount' => $quotas['quota_amount'][$index],
                    ]);
                    $quotas['id'][$index] = null;
                } else {
                    $package->quotas[$i]->delete();
                }
            }
        } else {
            foreach ($package->quotas as $quota) {
                $quota->delete();
            }
        }

        if ($request->quotas['id']) {
            for ($i = 0; $i < sizeof($quotas['id']); $i++) {
                if (is_null($quotas['id'][$i])) {
                    continue;
                }
                $package->quotas()->create([
                    'event_type_id' => $quotas['event_type_id'][$i],
                    'quota_amount' => $quotas['quota_amount'][$i],
                ]);
            }
        }

        $package->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        return redirect(route('packages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
