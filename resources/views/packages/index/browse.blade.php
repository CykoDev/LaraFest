@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Browse Packages</h1>
    </div>

    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are You ACTUALLY Serious?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
                </div>
                <div class="modal-body">
                    <p class="small">
                        This Option will reset your profile along with all your enrollments and expenses. And even if you
                        paid your invoice and/or uploaded your payment proof, it WILL not recognize your past payments. Only
                        choose this option if you have not paid your invoice or if you really know what you are doing.
                    </p>
                    <p class="mt-3 text-danger small">
                        If done by mistake, we are NOT responsible and WILL and CAN not fix your problem.
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" type="button" data-dismiss="modal">Cancel</button>
                    {!! Form::open(['method'=>'POST', 'action'=>'ProfileController@resetProfile']) !!}
                    {!! Form::button('<i class="fas fa-biohazard mr-2"></i> Reset Profile',
                        ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <small class="m-0 font-weight-bold text-primary">Need To Change Your Package Details?</small>
            </div>
            <div class="card-body">
                <small>
                    You might then want to reset your profile, start anew and change your package or package options. Do not pay your
                    invoice/due fees until you are satisfied with your expenses. Verify your expenses
                    <a href="{{ route('expenses.summary') }}">here</a> before paying any money.<br>
                    If you still want to reset your profile,
                    head over here.
                </small>
                <br>
                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm mt-3" href="#" data-toggle="modal" data-target="#resetModal">
                    <i class="fas fa-biohazard mr-2"></i> Reset Profile
                </a>
            </div>
        </div>
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
                    {!! App\Package::whereName('Nustian Package')->firstOrFail()->description !!}
                    <br><br>Price: Rs. 1000
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
                    {!! App\Package::whereName('Professional Package')->firstOrFail()->description !!}
                    <br><br>Price: Rs. 1300
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
                    {!! App\Package::whereName('Non Nustian Package')->firstOrFail()->description !!}
                    <br><br>Price: Rs. 1300
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


