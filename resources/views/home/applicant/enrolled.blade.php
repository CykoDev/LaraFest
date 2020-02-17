@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Alright! You Just Popped Your Cher-Berry!</h1>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="text-center p-3 pt-5 mt-2">
                <img height="200" src="{{ asset('img/public/undraw_dev_productivity_umsq.svg') }}" alt="welcome!">
            </div>
            <br>
            <div class="card shadow mx-5 mb-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Package Events</h6>
                </div>
                <div class="card-body">
                    @foreach(Auth::user()->package->events(Auth::id()) as $event)
                        <p>{{ $event->name }}</p>
                    @endforeach
                </div>
            </div>
            <div class="card shadow mx-5">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Your Individually Enrolled Events</h6>
                </div>
                <div class="card-body">
                    @foreach(Auth::user()->events as $event)
                        <p>{{ $event->name }}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Your Current Package</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col my-auto">
                            <h3 class="text-primary">{{ ucwords(Auth::user()->package->name) }}</h3>
                        <small>Price: {{ Auth::user()->package->currencySymbol }} {{ Auth::user()->package->price }}</small>
                        </div>
                        <div class="col my-auto">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="{{ asset('img/public/undraw_landscape_mode_53ej.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('expenses.summary') }}">
                        <div class="card shadow p-3">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="{{ asset('img/public/undraw_wallet_aym5.svg') }}" alt="">
                                <p>View Expenses</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('meet-the-creators') }}">
                        <div class="card shadow p-3">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="{{ asset('img/public/undraw_team_page_pgpr.svg') }}" alt="">
                                <p>Meet The Creators</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


