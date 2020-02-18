@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ ucwords($role->name) }}s</h1>
        {!! Form::open(['method'=>'POST', 'action'=>['ExportController@exportRoleUsers', $role->name]]) !!}
        {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> Generate Excel',
            ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) !!}
        {!! Form::close() !!}
    </div>

    @if(Auth::user()->isAdmin())
        <div class="row">
            @include('layouts.components.card', [
                'textclass' => 'primary',
                'title' => 'View All Users',
                'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
                'data' => '',
                'link' => route('users.index'),
            ])
        </div>
    @endif

    @component('layouts.components.datatable')
    @slot('title')
        {{ ucwords($role->name) }} Users
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
                <td>
                    <a href="{{ route('users.index-role', $role->slug) }}">{{ $role->name }}</a>
                </td>
                <td>{{ $user->is_active ? 'Active' : 'Not Active' }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


