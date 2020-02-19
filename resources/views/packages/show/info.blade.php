@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Package Information</h1>
        <a href="{{ route('packages.discounts.create', $package->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-pen-fancy fa-sm text-white-50"></i>
            Create Discount
        </a>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <span></span>
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('packages.edit', $package->slug) }}">
            <i class="fas fa-pen-fancy fa-sm text-white-50 mr-2"></i> Edit Package
        </a>
    </div>

    <div class="row">
        @include('layouts.components.card', [
            'textclass' => 'primary',
            'title' => 'Enrolled Users',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => $package->users->count(),
        ])
        @include('layouts.components.card', [
            'textclass' => 'primary',
            'title' => 'Package Price',
            'faIcon' => '<i class="fas fa-dollar-sign fa-2x mr-2"></i>',
            'data' => $package->currencySymbol . ' ' . $package->price
        ])
    </div>

    <div class="card shadow mb-4 mr-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ ucwords($package->name) }}</h6>
        </div>
        <div class="card-body">
            <p class="text-muted small">Created On: {{ $package->created_at->isoFormat('D MMMM, Y') }}</p>
            <p class="text-muted small">Updated On: {{ $package->updated_at->isoFormat('D MMMM, Y') }}</p>
            <section class="my-5">
                <h5 class="text-primary">Active Discount</h5>
                @if($package->discount)
                    <table>
                        <tr>
                            <td class="text-dark font-weight-bold pr-5">Discount Name</td>
                            <td>{{ ucwords($package->discount->name) }}</td>
                        </tr>
                        <tr>
                            <td class="text-dark font-weight-bold pr-5">Discount Percentage</td>
                            <td>{{ ucwords($package->discount->amount) }}%</td>
                        </tr>
                        <tr>
                            <td class="text-dark font-weight-bold pr-5">Discount Expiry</td>
                            <td>{{ ucwords($package->discount->expiry_at->isoFormat('D MMMM, Y')) }}</td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'action'=>['PackageController@destroyDiscount', $package->discount->id]]) !!}
                                {!! Form::submit('Delete', ['class'=>'d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td></td>
                        </tr>
                    </table>
                @else
                    <p>N/A</p>
                @endif
            </section>
            <section class="my-5">
                <h5 class="text-primary">Package Quotas</h5>
                @if($package->quotas()->exists())
                    <table>
                        <thead>
                            <tr>
                                <th>Event Type</th>
                                <th>Number Allowed</th>
                            <tr>
                        </thead>
                        <tbody>
                            @foreach($package->quotas as $quota)
                                <tr>
                                    <td style="padding-right:60px">{{ $quota->eventType->name }}</td>
                                    <td >{{ $quota->quota_amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>N/A</p>
                @endif
            </section>
            <section class="my-5">
                <h5 class="text-primary">Package Details</h5>
                <p class="px-4">{{ $package->description }}</p>
            </section>
        </div>
    </div>

    @if($package->data)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Package Data</h6>
            </div>
            <div class="card-body">
                @foreach($package->data as $key=>$value)
                    <div class="form-row py-1">
                        <div class="col-3">
                            <span class="text-dark font-weight-bold">
                                {{ ucwords(str_replace('_',' ',str_replace('_id', '', $key))) }}
                            </span>
                        </div>
                        <div class="col-7">
                            @if(strpos($key, 'photo_id'))
                                <a href="{{ $package->photo(str_replace('_id','',$key))->path }}" target="_blank">View</a>
                            @else
                                <span>{{ ucwords($value) }}</span>
                            @endif
                        </div>
                        <div class="col-2"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @component('layouts.components.datatable')
    @slot('title')
    {!! Form::open(['method'=>'POST', 'action'=>['ExportController@exportPackageApplicants', $package->id]]) !!}
    <span class="mr-3">Enrolled Users</span>
    {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> <small>Generate Excel</small>',
        ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) !!}
    {!! Form::close() !!}
    @endslot
    @slot('headings')
        <tr>
            <th><small class="font-weight-bold">Photo</small></th>
            <th><small class="font-weight-bold">Name</small></th>
            <th><small class="font-weight-bold">Email</small></th>
            <th><small class="font-weight-bold">Contact</small></th>
        </tr>
    @endslot
    @slot('body')
        @if($package->users)
            @foreach($package->users as $user)
            <tr>
                <td><img src='{{ is_null($user->photo) ? $user->defaultImage : $user->photo->path }}' class="rounded-circle" width=30 height=30></td>
                <td>
                    <small>
                        <a href="{{ route('users.show', $user->slug) }}">{{ $user->name }}</a>
                    </small>
                </td>
                <td>
                    <a href="mailto:{{ $user->email }}">
                        <small>{{ $user->email }}</small>
                    </a>
                </td>
                <td><small>{{ $user->data['mobile_no'] ? $user->data['mobile_no'] : 'N/A' }}</small></td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection
