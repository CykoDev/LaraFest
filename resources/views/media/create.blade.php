@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endpush


@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Upload Media</h1>
    </div>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminMediaController@store', 'class'=>'dropzone']) !!}


        {{-- <div class="form=group">
            {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
        </div> --}}

    {!! Form::close() !!}

</div>

@endsection


@push('scripts')
<script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js'></script>
@endpush


