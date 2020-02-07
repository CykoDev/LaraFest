@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hi Applicant!</h1>

    </div>
    <div>
        <p>Are you signing up as a NUSTian?</p>
        {{-- {!! Form::open(['method'=>'POST', 'action'=>'HomeController@postApplicant', 'files'=>false]) !!} --}}
        {!! Form::open(['method'=>'POST', 'action'=>'ProfileController@store', 'files'=>false]) !!}
        <div class="form-group">
            {!! Form::button('Yes', ['type'=>'submit', 'name'=>'submit', 'value'=>'yes', 'class'=>'btn btn-primary']) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::button('No', ['type'=>'submit', 'name'=>'submit', 'value'=>'no', 'class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

</div>

@endsection


