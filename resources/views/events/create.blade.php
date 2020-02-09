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
            {!! Form::label('photo_id', 'Event Image: ') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            @error('photo_id')
            <br>
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('event_date', 'Event date: ') !!}
            {!! Form::date('event_date', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
            @error('event_date')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('details', 'Details: ') !!}
            {!! Form::textarea('details', null,  ['class'=>'form-control', 'rows'=>5]) !!}
            @error('details')
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

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#details').summernote({
                height:300,
            });
        });
    </script>
@endpush
