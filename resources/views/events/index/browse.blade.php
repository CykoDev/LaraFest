@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row mb-5">
        <div class="col text-right">
            <img src="{{ asset('img/public/undraw_browsing_urt9.svg') }}" height="150">
        </div>
        <div class="col my-auto text-left">
            <div class="d-sm-flex justify-content-between mb-4">
                <h1 class="h2 mb-0 text-gray-800">Browse Events</h1>
            </div>
        </div>
        <div class="col"></div>
        <div class="col"></div>
    </div>

    <div class="album py-2 bg-light">
        <div class="container">
            {{ $events->links() }}
            <div class="row">
                @if($events)
                    @foreach($events as $event)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img height="150px" class="card-img-top" src='{{ is_null($event->photo) ? $event->defaultImage : $event->photo->path }}'>
                                <div class="card-body">
                                    <h5 class="text-primary">{{ ucwords(mb_strimwidth($event->name, 0, 100, "...")) }}</h5>
                                    <small>{{ $event->type->name }}</small>
                                    <p class="card-text">{{ mb_strimwidth($event->details, 0, 100, "...") }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('events.view', $event->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary">View</a>
                                            @if (Auth::user()->events->contains($event))
                                                {!! Form::open(['method'=>'POST', 'action'=>['EventController@unEnroll', $event->slug]]) !!}
                                                {!! Form::submit('Un-enroll', ['class'=>'btn btn-sm btn-outline-warning']) !!}
                                                {!! Form::close() !!}
                                            @else
                                                {!! Form::open(['method'=>'POST', 'action'=>['EventController@enroll', $event->slug]]) !!}
                                                {!! Form::submit('Enroll', ['class'=>'btn btn-sm btn-outline-success']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        </div>
                                        <small class="text-muted">{{ $event->event_date->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            {{ $events->links() }}
        </div>
    </div>



</div>

@endsection


