@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif



    <div class="row">
        <div class="col-sm-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Event Types</h1>
            </div>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4 py-4 text-right">
            {!! Form::open(['method'=>'POST', 'action'=>'EventTypeController@store']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    @error('name')
                        <span class="text-danger small">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form=group">
                    {!! Form::submit('Create Type', ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>


    @component('layouts.components.datatable')
    @slot('title')
        All Types
    @endslot
    @slot('headings')
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Events</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    @endslot
    @slot('body')
        @if($types)
            @foreach($types as $type)
            <tr>
                <td>{{ $type->id }}</td>
                <td>
                    <a href="{{ route('types.edit', $type->slug) }}">
                        {{ $type->name }}
                    </a>
                </td>
                <td>{{ $type->events()->count() }}</td>
                <td>{{ $type->created_at->diffForHumans() }}</td>
                <td>{{ $type->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


