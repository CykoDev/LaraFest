@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Discount</h1>
    </div>

    {!! Form::open(['method'=>'POST', 'action'=>'EventsDiscountController@store', 'files'=>false]) !!}

        {!! Form::hidden('eventId', $id) !!}

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
            {!! Form::label('amount', 'Amount: ') !!}
            {!! Form::text('amount', null, ['class'=>'form-control']) !!}
            @error('amount')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('expiry', 'Expiry: ') !!}
            {!! Form::date('expiry', null, ['class'=>'form-control']) !!}
            @error('expiry')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form=group">
            {!! Form::submit('Add Discount', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}


@endsection
