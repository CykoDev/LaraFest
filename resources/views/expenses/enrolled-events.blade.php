@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Enrolled Events</h1>
    </div>

    <div class="row mt-5">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Package Events</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="height: 7rem;" src="{{ asset('img/public/undraw_book_reading_kx9s.svg') }}" alt="">
                    </div>
                    @if (Auth::user()->package()->exists())
                        @if(Auth::user()->package->events()->exists())
                                <table class="mx-5 mt-4">
                                    @foreach(Auth::user()->package->events(Auth::id()) as $event)
                                        <tr>
                                            <td class="text-dark font-weight-bold pr-5">
                                                <a href="{{ route('events.view', $event->slug) }}">
                                                    {{ ucwords($event->name) }}
                                                </a>
                                            </td>
                                            <td>{{ $event->currencySymbol.' '.$event->price }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <p class="text-center mt-4">N/A</p>
                        @endif
                    @else
                        <p class="text-center mt-4">N/A</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Individual Events</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="height: 7rem;" src="{{ asset('img/public/undraw_dev_productivity_umsq.svg') }}" alt="">
                    </div>
                    @if(Auth::user()->events()->exists())
                        <table class="mx-5 mt-4">
                            @foreach(Auth::user()->events as $event)
                                <tr>
                                    <td class="text-dark font-weight-bold pr-5">
                                        <a href="{{ route('events.view', $event->slug) }}">
                                            {{ ucwords($event->name) }}
                                        </a>
                                    </td>
                                    <td>{{ $event->currencySymbol.' '.$event->price }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="text-center mt-4">N/A</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
