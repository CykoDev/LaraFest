@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Event Page</h1>
    </div>

    <div class="card shadow mb-4 mx-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ ucwords($event->title) }}
                @if (Auth::user()->events()->exists($event))
                    <sub class="ml-2 text-success font-weight-bold text-small">enrolled</sub>
                @endif
            </h6>
            <sub class="m-0 text-right">{{ ucwords($event->type->name) }}</sub>
        </div>
        <div class="card-body">
            <img src="{{ is_null($event->photo) ? $event->defaultImage : $event->photo->path }}" style="
                object-fit: cover;
                width: 100%;
                height: 300px;
            " class="mb-5">
            <p class="mb-3 text-primary px-5 font-weight-bold">Kickstarting on {{$event->event_date->isoFormat('D MMMM, Y') }}</p>
            <p class="px-5">{!! $event->details !!}</p>
            <div class="text-right">
                @if (Auth::user()->events()->exists($event))
                    {!! Form::open(['method'=>'POST', 'action'=>['EventController@unEnroll', $event->slug]]) !!}
                        <div class="form=group">
                            {!! Form::submit('UNENROLL', ['class'=>'btn btn-warning mr-5 px-5']) !!}
                        </div>
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['method'=>'POST', 'action'=>['EventController@enroll', $event->slug]]) !!}
                        <div class="form=group">
                            {!! Form::submit('ENROLL', ['class'=>'btn btn-primary mr-5 px-5']) !!}
                        </div>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
