@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Choose a Package to Continue</h1>
    </div>

    <div>
        {!! Form::open(['method'=>'PATCH', 'action'=>['ProfileController@update', 'profile.edit']]) !!}
            <div class="form-group">
                {!! Form::radio('data[registration_type]', 'non_nustian') !!}
                {!! Form::label('customCheck1', 'Non Nustian ') !!}

                {!! Form::radio('data[registration_type]', 'professional') !!}
                {!! Form::label('customCheck2', 'Professional ') !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Continue', [ 'class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>

</div>

@endsection


