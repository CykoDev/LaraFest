@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Roles</h1>
    </div>

    @component('layouts.components.datatable')
    @slot('title')
        All Roles
    @endslot
    @slot('headings')
        <tr>
            @if(Auth::user()->isAdmin())
                <th><small class="font-weight-bold">ID</small></th>
            @endif
            <th><small class="font-weight-bold">Name</small></th>
            <th><small class="font-weight-bold">Users</small></th>
            <th><small class="font-weight-bold">Description</small></th>
            <th><small class="font-weight-bold">Created At</small></th>
            <th><small class="font-weight-bold">Updated At</small></th>
            @if(Auth::user()->isAdmin())
                <th><small class="font-weight-bold">Get Users Excel</small></th>
            @endif
        </tr>
    @endslot
    @slot('body')
        @if($roles)
            @foreach($roles as $role)
            <tr>
                @if(Auth::user()->isAdmin())
                    <td><small>{{ $role->id }}</small></td>
                @endif
                <td>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('users.index-role', $role->slug) }}"><small>{{ $role->name }}</small></a>
                    @else
                        <small>{{ $role->name }}</small>
                    @endif
                </td>
                <td><small>{{ $role->users()->count() }}</small></td>
                <td><small>{{ $role->description }}</small></td>
                <td><small>{{ $role->created_at->diffForHumans() }}</small></td>
                <td><small>{{ $role->updated_at->diffForHumans() }}</small></td>
                @if(Auth::user()->isAdmin())
                    <td>
                        {!! Form::open(['method'=>'POST', 'action'=>['ExportController@exportRoleUsers', $role->name]]) !!}
                        {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> <small>Generate Excel</small>',
                            ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                @endif
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


