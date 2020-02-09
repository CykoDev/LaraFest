{{-- @extends('layouts.app')

@section('content') --}}

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Complete Profile</h1>
    </div>

    {!! Form::open(['method'=>'POST', 'action'=>'HomeController@postApplicant', 'files'=>false]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Full Name: ') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
            @error('name')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email: ') !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
            @error('email')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('gender', 'Gender: ') !!}
            {!! Form::select('gender', ['M'=> 'Male', 'F'=> 'Female', 'O'=> 'Other'], null, ['class'=>'form-control']) !!}
            @error('gender')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('mobile', 'Mobile Number: ') !!}
            {!! Form::text('mobile', null, ['class'=>'form-control']) !!}
            @error('mobile')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('work', 'Work Status:') !!}
            {!! Form::select('work', ['P'=> 'Professional', 'S'=> 'Student'], null, ['class'=>'form-control']) !!}
            @error('work')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('assist', 'Do you need any additional assistance?') !!}
            {!! Form::text('assist', null, ['class'=>'form-control']) !!}
            @error('assist')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form=group">
            {!! Form::submit('Next', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

</div>

{{-- @endsection --}}


