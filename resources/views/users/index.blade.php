@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Users</h1>
        {!! Form::open(['method'=>'POST', 'action'=>'ExportController@exportAllUsers']) !!}
        {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> Generate Excel',
            ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) !!}
        {!! Form::close() !!}
    </div>

    <div class="row">
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
        <th><small class="font-weight-bold">ID</small></th>
        <th><small class="font-weight-bold">Photo</small></th>
        <th><small class="font-weight-bold">Name</small></th>
        <th><small class="font-weight-bold">Email</small></th>
        <th><small class="font-weight-bold">Role</small></th>
        <th><small class="font-weight-bold">Status</small></th>
        <th><small class="font-weight-bold">Created At</small></th>
        <th><small class="font-weight-bold">Updated At</small></th>
        <th><small class="font-weight-bold">Actions</small></th>
        </tr>
    @endslot
    @slot('body')
        @if($users)
            @foreach($users as $user)
            <tr>
                <td><small>{{ $user->id }}</small></td>
                <td><img src='{{ is_null($user->photo) ? $user->defaultImage : $user->photo->path }}' class="rounded-circle" width=30 height=30></td>
                <td>
                    <a href="{{ route('users.show', $user->slug) }}">
                        <small>{{ $user->name }}</small>
                    </a>
                </td>
                <td>
                    <a href="mailto:{{ $user->email }}">
                        <small>{{ $user->email }}</small>
                    </a>
                </td>
                <td><small>{{ $user->role->name }}</small></td>
                <td><small>{{ $user->is_active ? 'Active' : 'Not Active' }}</small></td>
                <td><small>{{ $user->created_at->isoFormat('D / M / Y') }}</small></td>
                <td><small>{{ $user->updated_at->isoFormat('D / M / Y') }}</small></td>
                <td>
                    <a href="{{ route('users.edit', $user->slug) }}" class="btn btn-default p-0 text-primary">
                        <small class="font-weight-bold">Edit</small>
                    </a>
                </td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


