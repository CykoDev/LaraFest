@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">professional</h1>
    </div>

    {!! Form::model(Auth::user(), ['method'=>'PATCH', 'action'=>['ProfileController@update', 'dashboard'], 'files'=>true]) !!}

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
            {!! Form::label('email', 'Email: ') !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
            @error('email')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[cnic]', 'CNIC Number: ') !!}
            {!! Form::text('data[cnic]', null, ['class'=>'form-control']) !!}
            @error('data[cnic]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[cnic_photo_id]', 'CNIC Copy:') !!}
            <br>
            {!! Form::file('data[cnic_photo_id]', null, ['class'=>'form-control']) !!}
            @error('data[cnic_photo_id]')
            <br>
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[city]', 'City: ') !!}
            {!! Form::text('data[city]', null, ['class'=>'form-control']) !!}
            @error('data[city]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[organization]', 'Organization: ') !!}
            {!! Form::text('data[organization]', null, ['class'=>'form-control']) !!}
            @error('data[organization]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('data[occupation]', 'Occupation: ') !!}
            {!! Form::text('data[occupation]', null, ['class'=>'form-control']) !!}
            @error('data[occupation]')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Upload your Picture:') !!}
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
            {!! Form::label('data[accommodation]', 'Accommodation: ') !!}
            {!! Form::select('data[accommodation]', ['Yes'=> 'yes', 'No'=> 'no'], null, ['class'=>'form-control']) !!}
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

