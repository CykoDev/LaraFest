@extends('layouts.app')

@section('content')

<h1>{{ $package->name }}</h1>

<a class="btn btn-primary" href="{{ route('packages.edit', $package->id) }}">Edit Package</a>
<a class="btn btn-primary" href="discounts/create/{{ $package->id }}">Add Discount</a>

@endsection
