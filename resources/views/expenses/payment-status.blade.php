@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Upload Proof</h1>
    </div>

    <div class="row pb-5">
        <div class="col-sm-3">
            <img class="img-fluid" src="{{ $user->invoiceProof ? $user->invoiceProof->path : $user->defaultImage }}" width=200 height=100>
        </div>

        <div class="col-sm-9">

            {!! Form::model($user, ['method'=>'POST', 'action'=>['ProfileController@uploadProof'], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('invoice_proof', 'File: ') !!}
                {!! Form::file('invoice_proof', null, ['class'=>'form-control']) !!}
                @error('invoice_proof')
                    <br>
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

                {!! Form::hidden('payment_status', 'unverified') !!}

            <div class="form=group">
                {!! Form::submit($user->invoiceProof ? 'Update Proof' : 'Submit Proof', ['class'=>'btn btn-primary px-5']) !!}
            </div>

        </div>
    </div>

</div>

@endsection

