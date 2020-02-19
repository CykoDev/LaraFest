@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Packages</h1>
    </div>

    @component('layouts.components.datatable')
    @slot('title')
        All Packages
    @endslot
    @slot('headings')
        <tr>
        <th><small class="font-weight-bold">Name</small></th>
        <th><small class="font-weight-bold">Price</small></th>
        <th><small class="font-weight-bold">Users</small></th>
        <th><small class="font-weight-bold">Description</small></th>
        <th><small class="font-weight-bold">Created At</small></th>
        <th><small class="font-weight-bold">Updated At</small></th>
        <th><small class="font-weight-bold">Actions</small></th>
        <th><small class="font-weight-bold">Get Excel</small></th>
        </tr>
    @endslot
    @slot('body')
        @if($packages)
            @foreach($packages as $package)
            <tr>
                <td>
                    <a href="{{ route('packages.show', $package->slug) }}">
                        <small>{{ $package->name }}</small>
                    </a>
                </td>
                <td><small>{{ $package->currencySymbol }} {{ $package->price  }}</small></td>
                <td><small>{{ $package->users->count() }}</small></td>
                <td><small>{{ mb_strimwidth($package->description, 0, 40, "...") }}</small></td>
                <td><small>{{ $package->created_at->diffForHumans() }}</small></td>
                <td><small>{{ $package->updated_at->diffForHumans() }}</small></td>
                <td>
                    <a href="{{ route('packages.edit', $package->slug) }}" class="btn btn-default p-0 text-primary">
                        <small class="font-weight-bold">Edit</small>
                    </a>
                </td>
                <td>
                    {!! Form::open(['method'=>'POST', 'action'=>['ExportController@exportPackageApplicants', $package->id]]) !!}
                    {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> <small>Generate Excel</small>',
                        ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


