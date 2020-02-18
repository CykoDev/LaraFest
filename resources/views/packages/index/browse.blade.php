@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Browse Packages</h1>
    </div>

    <div>
        {!! Form::open(['method' => 'POST', 'action' => 'ProfileController@resetProfile', 'files' => false]) !!}
            {!! Form::hidden('payment_status', 'unpaid') !!}
            {!! Form::hidden('profile_created_at', null) !!}
            <div class="form=group">
                {!! Form::submit('Reset Profile', ['class'=>'btn btn-primary px-5']) !!}
            </div>
        {!! Form::close() !!}
    </div>

    <div class="row mt-5">
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Nustian Package</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="height: 10rem;" src="{{ asset('img/public/undraw_feeling_proud_qne1.svg') }}" alt="">
                    </div>
                    <p>
                        If you study at NUST, this package is for you.
                    </p>
                    <br>
                    {!! Form::open(['method'=>'PATCH','action'=>['ProfileController@update', 'packages.view']]) !!}
                        {!! Form::hidden('data[registration_type]', 'nustian') !!}
                        <div class="form=group text-center">
                            {!! Form::submit('Signup', ['class'=>'btn btn-primary px-5']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Professional Package</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="height: 10rem;" src="{{ asset('img/public/undraw_book_reading_kx9s.svg') }}" alt="">
                    </div>
                    <p>
                        Wait, you aren't a student? Choose this package.
                    </p>
                    <br>
                    {!! Form::open(['method'=>'PATCH','action'=>['ProfileController@update', 'packages.view']]) !!}
                        {!! Form::hidden('data[registration_type]', 'professional') !!}
                        <div class="form=group text-center">
                            {!! Form::submit('Signup', ['class'=>'btn btn-primary px-5']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Non-Nustian Package</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="height: 10rem;" src="{{ asset('img/public/undraw_reading_0re1.svg') }}" alt="">
                    </div>
                    <p>
                        You study outside NUST? This package is for you!
                    </p>
                    <br>
                    {!! Form::open(['method'=>'PATCH','action'=>['ProfileController@update', 'packages.view']]) !!}
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


