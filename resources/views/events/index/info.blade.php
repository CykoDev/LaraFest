@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">All Events</h1>
        {!! Form::open(['method'=>'POST', 'action'=>'ExportController@exportEvents']) !!}
        {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> Generate Excel',
            ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) !!}
        {!! Form::close() !!}
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <span></span>
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('events.create') }}">
            <i class="fas fa-pen-fancy fa-sm text-white-50 mr-2"></i> Create Event
        </a>
    </div>


    @component('layouts.components.datatable')
    @slot('title')
        All Events
    @endslot
    @slot('headings')
        <tr>
        <th><small class="font-weight-bold">Photo</small></th>
        <th><small class="font-weight-bold">Name</small></th>
        <th><small class="font-weight-bold">Type</small></th>
        <th><small class="font-weight-bold">Price</small></th>
        <th><small class="font-weight-bold">Users</small></th>
        <th><small class="font-weight-bold">Starts On</small></th>
        <th><small class="font-weight-bold">Ends On</small></th>
        <th><small class="font-weight-bold">Actions</small></th>
        <th><small class="font-weight-bold">Get Excel</small></th>
        </tr>
    @endslot
    @slot('body')
        @if($events)
            @foreach($events as $event)
            <tr>
                <td><img src='{{ is_null($event->photo) ? $event->defaultImage : $event->photo->path }}' class="rounded" width=50 height=30></td>
                <td>
                    <a href="{{ route('events.show', $event->slug) }}">
                        <small>{{ $event->name }}</small>
                    </a>
                </td>
                <td><small>{{ $event->type->name }}</small></td>
                <td><small>{{ $event->currencySymbol . ' ' . $event->price }}</small></td>
                <td><small>{{ $event->users->count() }}</small></td>
                <td><small>{{ $event->event_date->isoFormat('D/M/Y | h:m') }}</small></td>
                <td><small>{{ $event->end_date->isoFormat('D/M/Y | h:m') }}</small></td>
                <td>
                    <a href="{{ route('events.edit', $event->slug) }}" class="btn btn-default p-0 text-primary">
                        <small class="font-weight-bold">Edit</small>
                    </a>
                </td>
                <td>
                    {!! Form::open(['method'=>'POST', 'action'=>['ExportController@exportEventApplicants', $event->id]]) !!}
                    {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> <small>Get Excel</small>',
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


