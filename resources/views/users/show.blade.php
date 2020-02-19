@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">User Information</h1>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4">

            <div class="text-center p-3 ml-4">
                <img width="200" height="200" class="rounded-circle" src="{{ $user->photo ? $user->photo->path : $user->defaultImage }}">
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
                            <sub>Email verified at {{ $user->email_verified_at->isoFormat('D MMMM, Y') }}</sub><br>
                            <sub>Signedup at {{ $user->created_at->isoFormat('D MMMM, Y') }}</sub><br>
                            <sub>Profile last updated at {{ $user->updated_at->isoFormat('D MMMM, Y') }}</sub><br>
                            <sub class="text-primary">Invoice ID: {{ substr(bin2hex($user->id.$user->name),0,10) }}</sub><br>
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
                        @foreach($user->data as $key=>$value)
                            <div class="form-row py-1">
                                <div class="col-3">
                                    <span class="text-dark font-weight-bold">
                                        {{ ucwords(str_replace('_',' ',str_replace('_id', '', $key))) }}
                                    </span>
                                </div>
                                <div class="col-7">
                                    @if(strpos($key, 'photo_id'))
                                        <a href="{{ $user->photo(str_replace('_id','',$key))->path }}" target="_blank">View</a>
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

</div>

@endsection
