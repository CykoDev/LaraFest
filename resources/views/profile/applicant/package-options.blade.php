@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Not From NUST? Well That's New</h1>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <p class="mb-3">Well How About You Choose From The Two Packages Below?</p>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4 px-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Professional Package</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="{{ asset('img/public/undraw_book_reading_kx9s.svg') }}" alt="">
                    </div>
                    <p>
                        package info
                    </p>
                    <br>
                    {!! Form::open(['method'=>'PATCH','action'=>['ProfileController@update','profile.applicant.edit']]) !!}
                        {!! Form::hidden('data[registration_type]', 'professional') !!}
                        <div class="form=group text-center">
                            {!! Form::submit('Signup', ['class'=>'btn btn-primary px-5']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4 px-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Non-Nustian Package</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="{{ asset('img/public/undraw_reading_0re1.svg') }}" alt="">
                    </div>
                    <p>
                        package info
                    </p>
                    <br>
                    {!! Form::open(['method'=>'PATCH','action'=>['ProfileController@update','profile.applicant.edit']]) !!}
                        {!! Form::hidden('data[registration_type]', 'non_nustian') !!}
                        <div class="form=group text-center">
                            {!! Form::submit('Signup', ['class'=>'btn btn-primary px-5']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


