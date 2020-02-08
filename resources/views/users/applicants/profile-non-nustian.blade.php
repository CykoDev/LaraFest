<h1>Non-Nustian!</h1>

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Complete Profile</h1>
    </div>

    {!! Form::open(['method'=>'POST', 'action'=>'ProfileController@store', 'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Full Name: ') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
            @error('name')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('fname', 'Father\'s Name: ') !!}
            {!! Form::text('fname', null, ['class'=>'form-control']) !!}
            @error('fname')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('dob', 'Date of Birth: ') !!}
            {!! Form::date('dob', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
            @error('dob')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email: ') !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
            @error('email')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('cnic', 'CNIC Number: ') !!}
            {!! Form::text('cnic', null, ['class'=>'form-control']) !!}
            @error('cnic')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('cnicfile', 'CNIC Copy:') !!}
            <br>
            {!! Form::file('cnicfile', null, ['class'=>'form-control']) !!}
            @error('cnicfile')
            <br>
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('city', 'City: ') !!}
            {!! Form::text('city', null, ['class'=>'form-control']) !!}
            @error('city')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('blood', 'Blood Group: ') !!}
            {!! Form::text('blood', null, ['class'=>'form-control']) !!}
            @error('blood')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('edu', 'Education Level: ') !!}
            {!! Form::select('edu', ['Male'=> 'Male', 'Female'=> 'Female', 'Other'=> 'Other'], null, ['class'=>'form-control']) !!}
            @error('edu')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('institution', 'Institution\'s Name: ') !!}
            {!! Form::text('institution', null, ['class'=>'form-control']) !!}
            @error('institution')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('batch', 'Batch: ') !!}
            {!! Form::text('batch', null, ['class'=>'form-control']) !!}
            @error('batch')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('gender', 'Gender: ') !!}
            {!! Form::select('gender', ['Male'=> 'Male', 'Female'=> 'Female', 'Other'=> 'Other'], null, ['class'=>'form-control']) !!}
            @error('gender')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('mobile', 'Mobile Number: ') !!}
            {!! Form::text('mobile', null, ['class'=>'form-control']) !!}
            @error('mobile')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('ecn', 'Emergency Contact Number: ') !!}
            {!! Form::text('ecn', null, ['class'=>'form-control']) !!}
            @error('ecn')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('accom', 'Accommodation: ') !!}
            {!! Form::select('accom', ['Yes'=> 'Yes', 'No'=> 'No'], null, ['class'=>'form-control']) !!}
            @error('accom')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('code', 'Ambassador Code: (optional)') !!}
            {!! Form::text('code', null, ['class'=>'form-control']) !!}
            @error('code')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('assist', 'Do you need any additional assistance? (optional)') !!}
            {!! Form::text('assist', null, ['class'=>'form-control']) !!}
            @error('assist')
                <span class="text-danger small">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form=group">
            {!! Form::submit('Next', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

</div>
