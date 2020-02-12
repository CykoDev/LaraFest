@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h1>{{ $package->name }}</h1>

<h6>Price: <span>{{ $package->price }}</span></h6>

{!! Form::open(['method'=>'POST', 'action'=>'ApplicantController@store', 'files'=>false]) !!}

@foreach($package->quotas as $quota)

    @for($i = 0; $i < $quota->quota_amount; $i++)
    <div class="form-group">
        {!! Form::label('event', $quota->eventType->name . ': ') !!}
        {!! Form::select('event', $quota->eventType->events, null, ['class'=>'form-control']) !!}
        @error('event')
            <span class="text-danger small">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    @endfor

@endforeach

{!! Form::close() !!}

</div>

@endsection
