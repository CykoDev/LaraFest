@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    </div>

    <div class="row pb-5">
        <div class="col-sm-3">
            <img class="img-fluid rounded" src="{{ $user->photo ? $user->photo->file : $user->defaultImage }}" width=200 height=100>
        </div>

        <div class="col-sm-9">

            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
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
                {!! Form::label('role_id', 'Role: ') !!}
                {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
                @error('role_id')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('is_active', 'Status: ') !!}
                {!! Form::select('is_active', [1=>'Active', 0=>'Not Active'], null, ['class'=>'form-control']) !!}
                @error('is_active')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'File: ') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                @error('photo_id')
                    <br>
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password: ') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
                @error('password')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form=group">
                {!! Form::submit('Update User', ['class'=>'btn btn-primary px-5']) !!}
            </div>




            {!! Form::close() !!}

            {!! Form::model($user, ['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}

            <div class="form=group my-2">
                {!! Form::submit('Delete User', ['class'=>'btn btn-danger px-5']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>

</div>

@endsection

