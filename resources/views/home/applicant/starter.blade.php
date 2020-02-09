@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lets get Started</h1>
    </div>

    <div>
        <p>Are you signing up as a NUSTian?</p>
        {!! Form::open(['method'=>'PATCH', 'action'=>['ProfileController@update', 'profile.edit']]) !!}
            <div class="form-group">
                {!! Form::radio('data[registration_type]', 'nustian') !!}
                {!! Form::label('customCheck1', 'Yes ') !!}

                {!! Form::radio('data[registration_type]', '') !!}
                {!! Form::label('customCheck2', 'No ') !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Continue', [ 'class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>

</div>

@endsection


