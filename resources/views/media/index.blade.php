@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Media</h1>
    </div>

    @component('layouts.components.datatable')
    @slot('title')
        All Images
    @endslot
    @slot('headings')
        <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Type</th>
        <th>Created At</th>
        <th>Updated At</th>
        <td>Delete</td>
        </tr>
    @endslot
    @slot('body')
        @if($photos)
            @foreach($photos as $photo)
            <tr>
                <td><small>{{ $photo->id }}</small></td>
                <td><img src='{{ $photo->path }}' class="rounded" width=120 height=90></td>
                <td><small>{{ str_replace('_', ' ', $photo->type) }}</small></td>
                <td><small>{{ $photo->created_at->diffForHumans() }}</small></td>
                <td><small>{{ $photo->updated_at->diffForHumans() }}</small></td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['MediaController@destroy', $photo->id]]) !!}

                    {!! Form::submit('Delete', ['class'=>'btn btn-danger text-sm rounded px-2 py-1']) !!}

                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


