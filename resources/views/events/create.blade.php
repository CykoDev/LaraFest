@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Event</h1>
    </div>

    <div class="col-8">
        {!! Form::open(['method'=>'POST', 'action'=>'EventController@store', 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('name', 'name: ') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                @error('name')
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
                {!! Form::label('price', 'Event Price (optional): ') !!}
                {!! Form::number('price', 0, ['class'=>'form-control', 'min'=>0]) !!}
                @error('price')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="event_date">Event Date/Time: </label>
                <br>
                <input type="datetime-local" name="event_date">
                @error('event_date')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_date">Ending Date/Time: </label>
                <br>
                <input type="datetime-local" name="end_date">
                @error('end_date')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('event_type_id', 'Event Type: ') !!}
                {!! Form::select('event_type_id', [''=>'Choose Type'] + $types, null, ['class'=>'form-control']) !!}
                @error('event_type_id')
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

</div>

@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#details').summernote({
                height:300,
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ],
            });
        });
    </script>
@endpush
