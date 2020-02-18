@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payment Status</h1>
    </div>

    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="text-center">
                @if(Auth::user()->invoiceProof)
                    <img class="img-fluid rounded px-3 px-sm-4 mt-3 mb-4" style="width: 35rem; height: 15rem; object-fit: cover;"   
                    src="{{ Auth::user()->invoiceProof->path }}">
                    <p class=" mt-3 font-weight-bold text-primary text-center">Your Current Payment Proof</p>
                @else
                    <img height="170" src="{{ asset('img/public/undraw_empty_xct9.svg') }}">
                    <p class=" mt-5 font-weight-bold text-warning text-center">Payment proof not uploaded yet</p>
                @endif
            </div>
            <br>
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Here's How This Works</h6>
                </div>
                <div class="card-body">
                    <p>
                        New here and not enrolled in stuff yet? Well once you do, generate your challan, pay the price (literally),
                        then upload a picture of the payment proof here (preferably a picture of your receipt or your own copy of the
                        invoice). Once done, now your payment would be awaiting verification. Our Registrations Team will periodically
                        verify payments of the applicants here. And when they do, they will update your payment status.
                    </p>
                    <p>
                        So you paid your challan, uploaded proof and are still not seeing a big green <span class="text-success font-weight-bold">'PAID' </span>
                        status? dont worry, you will soon (unless you just faked your payment and got away with it. In that case, good luck
                        and we never said this).
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-5 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Payment Status: 
                        @switch(Auth::user()->payment_status)
                            @case('unpaid')
                                <span class="text-danger">Pending Payment Proof</span>
                                @break
                            @case('unverified')
                                <span class="text-warning">Awaiting Verification</span>
                                @break
                            @case('paid')
                                <span class="text-success">Payment Verified</span>
                                @break
                        @endswitch
                    </h6>
                </div>
                <div class="card-body">
                    {!! Form::model(Auth::user(), ['method'=>'POST', 'action'=>['FinanceController@uploadProof'], 'files'=>true]) !!}

                    <h6 class="font-weight-bold">Upload Or Update Your Payment Proof Here</h4>

                    <div class="form-group my-4">
                        {!! Form::file('invoice_proof_id', null, ['class'=>'form-control']) !!}
                        @error('invoice_proof_id')
                            <br>
                            <span class="text-danger small">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                        {!! Form::hidden('payment_status', 'unverified') !!}

                    <div class="form=group mt-5">
                        {!! Form::submit(Auth::user()->invoiceProof ? 'Update Proof' : 'Submit Proof', ['class'=>'btn btn-primary px-5']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row pb-5">
        <div class="col-sm-3">
            <img class="img-fluid" src="{{ Auth::user()->invoiceProof ? Auth::user()->invoiceProof->path : Auth::user()->defaultImage }}" width=200 height=100>
        </div>

        <div class="col-sm-9">

            {!! Form::model(Auth::user(), ['method'=>'POST', 'action'=>['FinanceController@uploadProof'], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('invoice_proof_id', 'File: ') !!}
                {!! Form::file('invoice_proof_id', null, ['class'=>'form-control']) !!}
                @error('invoice_proof_id')
                    <br>
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

                {!! Form::hidden('payment_status', 'unverified') !!}

            <div class="form=group">
                {!! Form::submit(Auth::user()->invoiceProof ? 'Update Proof' : 'Submit Proof', ['class'=>'btn btn-primary px-5']) !!}
            </div>

        </div>
    </div>

    <p>Status: @switch(Auth::user()->payment_status)
        @case('unpaid')
            You need to upload proof of payment
            @break
        @case('unverified')
            Your payment is awaiting verification
            @break
        @case('paid')
            Your payment has been verified
            @break
        @endswitch</p> --}}

</div>

@endsection

