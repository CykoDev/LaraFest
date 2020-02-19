@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Discount</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4 mr-5">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Discount Event: {{ ucwords($event->name) }}</h6>
                </div>
                <div class="card-body">


                    {!! Form::open(['method'=>'POST', 'action'=>'EventController@storeDiscount', 'files'=>false]) !!}

                        {!! Form::hidden('eventId', $event->id) !!}

                        @if ($event->discount)
                            <small class="text-muted">Creating a new discount will overwrite any existing accounts</small>
                        @endif

                        <div class="form-group">
                            {!! Form::label('name', 'Discount Name: ') !!}
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                            @error('name')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::label('amount', 'Amount (%): ') !!}
                            {!! Form::number('amount', null, ['class'=>'form-control', 'min'=>0, 'max'=>100]) !!}
                            @error('amount')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::label('expiry_at', 'Expiry Date: ') !!}
                            {!! Form::date('expiry_at', null, ['class'=>'form-control']) !!}
                            @error('expiry_at')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form=group">
                            {!! Form::submit('Add Discount', ['class'=>'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>

</div>

@endsection
