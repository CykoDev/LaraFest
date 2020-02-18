<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Package;
use Illuminate\Http\Request;

class PackagesDiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware('monitor')->only('index', 'show');
        $this->middleware('moderator')->except('index', 'show');
    }

    public function index()
    {
        $discounts = Discount::all();
        return view('discounts.index', compact('discounts'));
    }

    public function create($id)
    {
        $package = Package::findOrFail($id);
        return view('packages.discounts.create', compact('package'));
    }

    public function store(Request $request)
    {
        $package = Package::findOrFail($request->packageId);
        if ($package->discount) $package->discount()->delete();
        $package->discount()->create(['name' => $request->name, 'amount' => $request->amount, 'expiry_at' => $request->expiry]);
        return redirect()->back();
    }

    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //
    }
}
