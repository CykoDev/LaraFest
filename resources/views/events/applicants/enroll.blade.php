@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h1>{{ $event->name }}</h1>

<h6>Price: <span>{{ $event->price }}</span></h6>

{!! Form::open(['method'=>'POST', 'action'=>'ApplicantController@storeEvent', 'files'=>false]) !!}

{!! Form::hidden('eventId', $event->id) !!}

@foreach($package->quotas as $quota)

    @for($i = 0; $i < $quota->quota_amount; $i++)
    <div class="form-group">
        {!! Form::label('eventIds[]', $quota->eventType->name . ': ') !!}
        {!! Form::select('eventIds[]', $quota->eventType->events->pluck('title', 'id'), null, ['class'=>'form-control']) !!}
        @error('eventIds[]')
            <span class="text-danger small">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    @endfor

@endforeach

<div class="form=group">
    {!! Form::submit('Enroll in Package', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}

</div>

@endsection
