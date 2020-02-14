@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h1>{{ $package->name }}</h1>

<h6>Price: <span>{{ $package->price }}</span></h6>

{!! Form::open(['method'=>'POST', 'action'=>'ApplicantController@storePackage', 'files'=>false]) !!}

{!! Form::hidden('packageId', $package->id) !!}

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
