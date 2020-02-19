@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Alright Lets Get Started</h1>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="text-center p-3 pt-5 mt-2 mb-5">
                <img height="140" src="{{ asset('img/public/undraw_welcome_cats_thqn.svg') }}" alt="welcome!">
            </div>
            <br>
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Here's What You Get In The Nustian Package</h6>
                </div>
                <div class="card-body">
                    <p>
                        {!! App\Package::whereName('Nustian Package')->firstOrFail()->description !!}
                        <br>Price: Rs. 1000
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick question, then we speed up</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="{{ asset('img/public/undraw_landscape_mode_53ej.svg') }}" alt="">
                    </div>
                    <p>
                        Are you signing up as a Nustian?<br> If yes, you will be automatically assigned our Nustian package!<br>
                        <sub>If you suddenly became a Nustian right here and now, that wont count. Other scenarios count but we dont wanna list them.</sub>
                    </p>

                    {!! Form::open(['method'=>'PATCH','action'=>['ProfileController@update', 'packages.view']]) !!}
                        {!! Form::hidden('data[registration_type]', 'nustian') !!}
                        <div class="form=group">
                            {!! Form::submit('Sign Me up as Nustian', ['class'=>'btn btn-primary mr-5 px-5']) !!}
                        </div>

                    {!! Form::close() !!}
                    <br>
                    {!! Form::open(['method'=>'PATCH','action'=>['ProfileController@update','profile.applicant.edit']]) !!}
                        {!! Form::hidden('data[registration_type]', '') !!}
                        <div class="form=group">
                            {!! Form::submit('How About NO', ['class'=>'btn btn-primary mr-5 px-5']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


