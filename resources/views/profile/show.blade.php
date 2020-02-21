@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">Hey there {{ ucwords($user->name) }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4">

            <div class="text-center p-3 ml-4">
                <img width="200" height="200" class="rounded-circle" src="{{ $user->photo ? $user->photo->path : $user->defaultImage }}">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary px-5 mt-5">
                    <small>Edit Profile</small>
                </a>
            </div>

        </div>

        <div class="col-lg-7 mb-4 ml-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ ucwords($user->role->name) }} Profile</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-primary">{{ ucwords($user->name) }}</p>
                            <p class="text-primary">{{ ucwords($user->email) }}</p>
                            <sub>Email verified at {{ isset($user->email_verified_at) ? $user->email_verified_at->isoFormat('D MMMM, Y') : 'N/A' }}</sub><br>
                            <sub>Signedup at {{ $user->created_at->isoFormat('D MMMM, Y') }}</sub><br>
                            <sub>Profile last updated at {{ $user->updated_at->isoFormat('D MMMM, Y') }}</sub><br>
                            <sub class="text-primary">Invoice ID: {{ substr(bin2hex($user->id.$user->name),0,10) }}</sub><br>
                            @if($user->isApplicant())
                                @if(isset($user->profile_completed_at))
                                    <sub class="text-primary font-weight-bold">Profile Completed</sub>
                                @else
                                    <sub class="text-warning font-weight-bold">Profile Not Yet Completed<br>
                                        <a class="text-primary" href="{{ route('profile.applicant.edit') }}">
                                            &#8594; Complete Profile
                                        </a>
                                    </sub>
                                @endif
                            @endif
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 17rem;" src="{{ asset('img/public/undraw_feeling_proud_qne1.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($user->data)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
                    </div>
                    <div class="card-body">
                        @if($user->package()->exists())
                            <div class="form-row py-1">
                                <div class="col-3">
                                    <span class="text-primary font-weight-bold">
                                        Package Name
                                    </span>
                                </div>
                                <div class="col-7">
                                    {{ ucwords($user->package->name) }}
                                </div>
                                <div class="col-2"></div>
                            </div>
                        @endif
                        @foreach($user->data as $key=>$value)
                            <div class="form-row py-1">
                                <div class="col-3">
                                    <span class="text-dark font-weight-bold">
                                        {{ ucwords(str_replace('_',' ',str_replace('_id', '', $key))) }}
                                    </span>
                                </div>
                                <div class="col-7">
                                    @if(strpos($key, 'photo_id'))
                                        <a href="{{ $user->photo(str_replace('_id','',$key))->path }}" target="_blanl">View</a>
                                    @else
                                        <span>{{ ucwords($value) }}</span>
                                    @endif
                                </div>
                                <div class="col-2"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if ($user->isApplicant() && $user->events()->exists())
        @component('layouts.components.datatable')
        @slot('title')
            Enrolled Events
        @endslot
        @slot('headings')
            <tr>
            <th><small class="font-weight-bold">Photo</small></th>
            <th><small class="font-weight-bold">Name</small></th>
            <th><small class="font-weight-bold">Type</small></th>
            <th><small class="font-weight-bold">Price</small></th>
            <th><small class="font-weight-bold">Starts On</small></th>
            <th><small class="font-weight-bold">Ends On</small></th>
            </tr>
        @endslot
        @slot('body')
            @if($user->events()->exists())
                @foreach($user->events as $event)
                <tr>
                    <td><img src='{{ is_null($event->photo) ? $event->defaultImage : $event->photo->path }}' class="rounded" width=50 height=30></td>
                    <td>
                        <a href="{{ route('events.show', $event->slug) }}">
                            <small>{{ $event->name }}</small>
                        </a>
                    </td>
                    <td><small>{{ $event->type->name }}</small></td>
                    <td><small>{{ $event->currencySymbol . ' ' . $event->price }}</small></td>
                    <td><small>{{ $event->event_date->isoFormat('D/M/Y | h:m') }}</small></td>
                    <td><small>{{ $event->end_at->isoFormat('D/M/Y | h:m') }}</small></td>
                </tr>
                @endforeach
            @endif
        @endslot
        @endcomponent
    @endif

    <div class="mx-4">
        @if($user->isApplicant() && $user->package()->exists())
            @component('layouts.components.datatable')
            @slot('title')
                <span class="mr-3">Package Events</span>
            @endslot
            @slot('headings')
                <tr>
                <th><small class="font-weight-bold">Photo</small></th>
                <th><small class="font-weight-bold">Name</small></th>
                <th><small class="font-weight-bold">Type</small></th>
                <th><small class="font-weight-bold">Price</small></th>
                <th><small class="font-weight-bold">Starts On</small></th>
                <th><small class="font-weight-bold">Ends On</small></th>
                </tr>
            @endslot
            @slot('body')
                @if($user->package->events($user->id))
                    @foreach($user->package->events($user->id) as $event)
                    <tr>
                        <td><img src='{{ is_null($event->photo) ? $event->defaultImage : $event->photo->path }}' class="rounded" width=50 height=30></td>
                        <td>
                            <a href="{{ route('events.show', $event->slug) }}">
                                <small>{{ $event->name }}</small>
                            </a>
                        </td>
                        <td><small>{{ $event->type->name }}</small></td>
                        <td><small>{{ $event->currencySymbol . ' ' . $event->price }}</small></td>
                        <td><small>{{ $event->event_date->isoFormat('D/M/Y | h:m') }}</small></td>
                        <td><small>{{ $event->end_date->isoFormat('D/M/Y | h:m') }}</small></td>
                    </tr>
                    @endforeach
                @endif
            @endslot
            @endcomponent
        @endif
    </div>

</div>

@endsection


