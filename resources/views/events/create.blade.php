@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Event</h1>
    </div>

    {!! Form::open(['method'=>'POST', 'action'=>'EventController@store', 'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title: ') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
            @error('title')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Profile Image: ') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            @error('photo_id')
            <br>
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('event_date', 'Password: ') !!}
            {!! Form::date('event_date', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
            @error('event_date')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form=group">
            {!! Form::submit('Create Event', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

</div>

@endsection

