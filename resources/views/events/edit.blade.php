@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Event</h1>
    </div>

    <div class="row pb-5">
        <div class="col-sm-3">
            <img class="img-fluid rounded" src="{{ $event->photo ? $event->photo->path : $event->defaultImage }}" width=200 height=100>
        </div>

        <div class="col-sm-9">

            {!! Form::model($event, ['method'=>'PATCH', 'action'=>['EventController@update', $event->slug], 'files'=>true]) !!}

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
                    {!! Form::submit('Update Event', ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}

            {!! Form::model($event, ['method'=>'DELETE', 'action'=>['EventController@destroy', $event->id]]) !!}

            <div class="form=group my-2">
                {!! Form::submit('Delete Event', ['class'=>'btn btn-danger px-5']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>

</div>

@endsection

