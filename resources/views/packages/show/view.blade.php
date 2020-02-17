@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lets Get This Over With</h1>
    </div>

    <div class="card shadow mb-4 mx-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Package Details
                @if (Auth::user()->package()->exists($package))
                    <sub class="ml-2 text-success font-weight-bold text-small">enrolled</sub>
                @endif
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col my-auto">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('img/public/undraw_reading_0re1.svg') }}" alt="">
                    </div>
                </div>
                <div class="col my-auto px-5">
                    <h3>{{ ucwords($package->name) }}</h3>
                    <span class="font-weight-bold text-primary mt-2">Price:</span>
                    <span>{{ $package->currencySymbol.' '.$package->price }}</span>
                    <p class="mt-3">{{ $package->description }}</p>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['method'=>'POST', 'action'=>['PackageController@enroll', $package->slug], 'files'=>false]) !!}

        {!! Form::hidden('packageId', $package->id) !!}

        @foreach($package->quotas as $quota)
            <div class="card shadow mb-4 mx-5">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Select Your {{ ucwords($quota->eventType->name) }} Events
                    </h6>
                </div>
                <div class="card-body px-5 mx-5">
                    @for($i = 0; $i < $quota->quota_amount; $i++)
                        <div class="form-group px-5 mx-5">
                            {!! Form::label('eventIds[]', $quota->eventType->name . ': ') !!}
                            {!! Form::select('eventIds[]', $quota->eventType->events->pluck('title', 'id'), null, ['class'=>'form-control']) !!}
                            @error('eventIds[]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endfor
                </div>
            </div>
        @endforeach

        <div class="card shadow mb-4 mx-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Alright get set go!
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col my-auto">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="{{ asset('img/public/undraw_confirmation_2uy0.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="col my-auto">
                        <div class="form=group text-center p-3">
                            {!! Form::submit('Enroll in Package', ['class'=>'btn btn-primary px-5 py-3']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {!! Form::close() !!}

</div>

@endsection
