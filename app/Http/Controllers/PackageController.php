<?php

namespace App\Http\Controllers;

use App\Package;
use App\PackageQuota;
use App\EventType;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('packages.index.info', compact('packages'));
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
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

        if($request->quotas){
            for ($i=0; $i<sizeof($package->quotas); $i++) {
                if (in_array($package->quotas[$i]->id, $quotas['id'])) {
                    $index = array_search($package->quotas[$i]->id, $quotas['id']);
                    $package->quotas[$i]->update([
                        'event_type_id' => $quotas['event_type_id'][$index],
                        'quota_amount' => $quotas['quota_amount'][$index],
                    ]);
                    $quotas['id'][$index] = null;
                }
                else {
                    $package->quotas[$i]->delete();
                }
            }
        }
        else {
            foreach($package->quotas as $quota){
                $quota->delete();
            }
        }

        if($request->quotas['id']){
            for($i=0; $i<sizeof($quotas['id']); $i++) {
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
