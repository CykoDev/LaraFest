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
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Users</th>
        <th>Description</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    @endslot
    @slot('body')
        @if($packages)
            @foreach($packages as $package)
            <tr>
                <td>{{ $package->id }}</td>
                <td><a href="{{ route('packages.edit', $package->slug) }}">{{ $package->name }}</a></td>
                <td>{{ $package->currencySymbol }} {{ $package->price  }}</td>
                <td>{{ $package->users->count() }}</td>
                <td>{{ $package->description }}</td>
                <td>{{ $package->created_at->diffForHumans() }}</td>
                <td>{{ $package->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


