@extends('layouts.app')

@section('content')

<h1>{{ $event->name }}</h1>

<a class="btn btn-primary" href="{{ route('events.edit', $event->slug) }}">Edit Event</a>
<a class="btn btn-primary" href="discounts/create/{{ $event->id }}">Add Discount</a>

@endsection
