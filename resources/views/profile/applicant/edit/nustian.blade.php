@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">nustian</h1>
    </div>

    {!! Form::model(Auth::user(), ['method'=>'PATCH', 'action'=>['ProfileController@updateApplicant', 'dashboard'], 'files'=>true]) !!}

        {{ Form::hidden('profile_completed_at', NOW()) }}

        <div class="form-group">
            {!! Form::label('data[full_name]', 'Full Name: ') !!}
            {!! Form::text('data[full_name]', null, ['class'=>'form-control']) !!}
            @error('data[full_name]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Upload your Picture: (Lets see your face)') !!}
            <br>
            {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            @error('photo_id')
            <br>
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
            {!! Form::label('data[cms_id]', 'CMS ID: ') !!}
            {!! Form::text('data[cms_id]', null, ['class'=>'form-control']) !!}
            @error('data[cms_id]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[batch]', 'Batch: ') !!}
            {!! Form::text('data[batch]', null, ['class'=>'form-control']) !!}
            @error('data[batch]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[department]', 'Department: ') !!}
            {!! Form::text('data[department]', null, ['class'=>'form-control']) !!}
            @error('data[department]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[gender]', 'Gender: ') !!}
            {!! Form::select('data[gender]', ['Male'=> 'male', 'Female'=> 'female', 'Other'=> 'other'], null, ['class'=>'form-control']) !!}
            @error('data[gender]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[mobile_no]', 'Mobile Number: ') !!}
            {!! Form::text('data[mobile_no]', null, ['class'=>'form-control']) !!}
            @error('data[mobile_no]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[emegerncy_contact]', 'Emergency Contact Number: ') !!}
            {!! Form::text('data[emegerncy_contact]', null, ['class'=>'form-control']) !!}
            @error('data[emegerncy_contact]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[accommodation]', 'Do you need accommodation? ') !!}
            {!! Form::select('data[accommodation]', [''=>'choose', 'yes'=> 'Sign me up!', 'no'=> 'Eh na I\'m fine'], null, ['class'=>'form-control']) !!}
            @error('data[accommodation]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[ambassador_code]', 'Ambassador Code: (optional)') !!}
            {!! Form::text('data[ambassador_code]', null, ['class'=>'form-control']) !!}
            @error('data[ambassador_code]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[assistance]', 'Do you need any additional assistance? (optional)') !!}
            {!! Form::text('data[assistance]', null, ['class'=>'form-control']) !!}
            @error('data[assistance]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form=group">
            {!! Form::submit('Complete Profile', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

</div>

@endsection
