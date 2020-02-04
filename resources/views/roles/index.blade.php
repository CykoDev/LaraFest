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
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    @endslot
    @slot('body')
        @if($roles)
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>
                    <a href="{{ route('users.index-role', $role->slug) }}">{{ $role->name }}</a>
                </td>
                <td>{{ $role->description }}</td>
                <td>{{ $role->created_at->diffForHumans() }}</td>
                <td>{{ $role->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


