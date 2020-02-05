@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Events</h1>
        {!! Form::open(['method'=>'POST', 'action'=>'UserController@exportAllUsers']) !!}
        {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> Generate Excel',
            ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) !!}
        {!! Form::close() !!}
    </div>

    {{-- <div class="row">
        @include('layouts.components.card', [
            'textclass' => 'primary',
            'title' => 'View Applicants',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => '',
            'link' => route('users.index-role', 'applicant'),
        ])
         @include('layouts.components.card', [
            'textclass' => 'info',
            'title' => 'View Admins',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => '',
            'link' => route('users.index-role', 'admin'),
        ])
         @include('layouts.components.card', [
            'textclass' => 'warning',
            'title' => 'View Moderators',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => '',
            'link' => route('users.index-role', 'moderator'),
        ])
         @include('layouts.components.card', [
            'textclass' => 'success',
            'title' => 'View Monitors',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => '',
            'link' => route('users.index-role', 'monitor'),
        ])
    </div>

    @component('layouts.components.datatable')
    @slot('title')
        All Users
    @endslot
    @slot('headings')
        <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    @endslot
    @slot('body')
        @if($users)
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><img src='{{ is_null($user->photo) ? $user->defaultImage : $user->photo->path }}' class="rounded-circle" width=40 height=40></td>
                <td><a href="{{ route('users.edit', $user->slug) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ $user->is_active ? 'Active' : 'Not Active' }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent --}}

</div>

@endsection


