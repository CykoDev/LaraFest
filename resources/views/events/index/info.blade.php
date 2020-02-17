@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Events</h1>
        {!! Form::open(['method'=>'POST', 'action'=>'ExportController@exportEvents']) !!}
        {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> Generate Excel',
            ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) !!}
        {!! Form::close() !!}
    </div>

    @component('layouts.components.datatable')
    @slot('title')
        All Events
    @endslot
    @slot('headings')
        <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>name</th>
        <th>Type</th>
        <th>Event Date</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    @endslot
    @slot('body')
        @if($events)
            @foreach($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td><img src='{{ is_null($event->photo) ? $event->defaultImage : $event->photo->path }}' class="rounded-circle" width=40 height=40></td>
                <td><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></td>
                <td>{{ $event->type->name }}</td>
                <td>{{ $event->event_date->diffForHumans() }}</td>
                <td>{{ $event->created_at->diffForHumans() }}</td>
                <td>{{ $event->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


