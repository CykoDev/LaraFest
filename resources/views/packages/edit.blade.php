@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Package</h1>
    </div>

    {!! Form::model($package, ['method'=>'PATCH', 'action'=>['PackageController@update', $package->id]]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                @error('name')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('price', 'Price: ') !!}
                {!! Form::number('price', null, ['class'=>'form-control']) !!}
                @error('price')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description: ') !!}
                {!! Form::textarea('description', null,  ['class'=>'form-control', 'rows'=>5]) !!}
                @error('description')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <h3 class="my-5">Package Quotas</h3>

            <div id="quota-container">
                @foreach($package->quotas as $quota)
                    <div class="form-group">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                {!! Form::hidden('quotas[id][]', $quota->id) !!}
                                {!! Form::label('quotas[event_type_id][]', 'Role: ') !!}
                                {!! Form::select('quotas[event_type_id][]', [''=>'Choose Type'] + $eventTypes, $quota->event_type_id, ['class'=>'form-control']) !!}
                                @error('quotas[event_type_id][]')
                                    <span class="text-danger small">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                {!! Form::label('quotas[quota_amount][]', 'Price: ') !!}
                                {!! Form::number('quotas[quota_amount][]', $quota->quota_amount, ['class'=>'form-control']) !!}
                                @error('quotas[quota_amount][]')
                                    <span class="text-danger small">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <a class="deletequota btn btn-default text-danger font-weight-bold px-3 mt-4">X</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="form=group my-5">
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col">
                        <a id='addquota' class="btn btn-primary text-white px-3">Add Quota</a>
                    </div>
                    <div class="col"></div>
                </div>
            </div>

            <div class="form=group mt-5">
                {!! Form::submit('Update Package', ['class'=>'btn btn-primary px-5']) !!}
            </div>

            {!! Form::close() !!}

            {!! Form::model($package, ['method'=>'DELETE', 'action'=>['PackageController@destroy', $package->id]]) !!}

            <div class="form=group my-2">
                {!! Form::submit('Delete Package', ['class'=>'btn btn-danger px-5']) !!}
            </div>

            {!! Form::close() !!}

</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '#addquota',function(){
            $('#quota-container').append(`
                <div class="form-group">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col">
                            {!! Form::hidden('quotas[id][]', '.') !!}
                            {!! Form::label('quotas[event_type_id][]', 'Role: ') !!}
                            {!! Form::select('quotas[event_type_id][]', [''=>'Choose Type'] + $eventTypes, null, ['class'=>'form-control']) !!}
                            @error('quotas[event_type_id][]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            {!! Form::label('quotas[quota_amount][]', 'Price: ') !!}
                            {!! Form::number('quotas[quota_amount][]', null, ['class'=>'form-control']) !!}
                            @error('quotas[quota_amount][]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            <a class="deletequota btn btn-default text-danger font-weight-bold px-3 mt-4">X</a>
                        </div>
                    </div>
                </div>
        `);
        });
        $(document).on('click', '.deletequota', function(){
            $(this).parent().parent().parent().remove();
        });
    });
</script>
@endpush
