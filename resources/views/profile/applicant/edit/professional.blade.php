@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Let's Complete Your Profile</h1>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <p class="mb-3">Well helloo we got a Professional here</p>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4">

            {!! Form::model(Auth::user(), ['method'=>'PATCH', 'action'=>['ProfileController@updateApplicant', 'dashboard'], 'files'=>true]) !!}
            {{ Form::hidden('profile_completed_at', NOW()) }}

            <div class="text-center p-3 ml-5">
                <div class="picCard">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input name='photo_id' type='file' id="photo_id">
                            <label for="photo_id">
                                <i class="fas fa-pencil-alt mt-2"></i>
                            </label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url({{ Auth::user()->photo ? Auth::user()->photo->path : Auth::user()->defaultImage }});">
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="form=group mt-5">
                    {!! Form::submit('Submit Changes', ['class'=>'btn btn-primary px-4']) !!}
                </div>
            </div>
        </div>
        <div class="col-lg-7 mb-4 ml-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ ucwords(Auth::user()->role->name) }} Profile</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                {!! Form::label('name', 'Username: ') !!}
                                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                @error('name')
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
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 17rem;" src="{{ asset('img/public/undraw_feeling_proud_qne1.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
                </div>
                <div class="card-body">
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold my-auto">
                                Registration Type
                            </span>
                            @error('registration_type')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-7">
                            Non Nustian
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[full_name]', 'Full Name: ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::text('data[full_name]', null, ['class'=>'form-control']) !!}
                            @error('data[full_name]')
                                <span class="text-danger small">
                                    <br><strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[cnic]', 'CNIC: ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::number('data[cnic]', null, ['class'=>'form-control']) !!}
                            @error('data[cnic]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[cnic_photo_id]', 'CNIC photo: ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::file('data[cnic_photo_id]', null, ['class'=>'form-control']) !!}
                            @error('data[cnic_photo_id]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[city]', 'City: ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::text('data[city]', null, ['class'=>'form-control']) !!}
                            @error('data[city]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[organization]', 'Organization: ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::text('data[organization]', null, ['class'=>'form-control']) !!}
                            @error('data[organization]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[occupation]', 'Occupation: ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::text('data[occupation]', null, ['class'=>'form-control']) !!}
                            @error('data[occupation]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[gender]', 'Gender: ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::select('data[gender]', [''=>'choose','male'=> 'male', 'female'=> 'female', 'other'=> 'other'], null, ['class'=>'form-control']) !!}
                            @error('data[gender]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[mobile_no]', 'Mobile no: ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::number('data[mobile_no]', null, ['class'=>'form-control']) !!}
                            @error('data[mobile_no]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[emegerncy_contact]', 'Emergency Contact: ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::number('data[emegerncy_contact]', null, ['class'=>'form-control']) !!}
                            @error('data[emegerncy_contact]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[accommodation]', 'Do You Need Accomodation? ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::select('data[accommodation]', [''=>'choose', 'yes'=> 'Sign me up!', 'no'=> 'Eh na I\'m fine'], null, ['class'=>'form-control']) !!}
                            @error('data[accommodation]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::label('data[ambassador_code]', 'Ambassador Code (optional): ') !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::text('data[ambassador_code]', null, ['class'=>'form-control']) !!}
                            @error('data[ambassador_code]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row py-2">
                        <div class="col-3 my-auto">
                            <span class="text-dark font-weight-bold">
                                {!! Form::select('data[assistance]', [''=>'choose', 'yes'=> 'Uh Yea', 'no'=> 'No Go Away'], null, ['class'=>'form-control']) !!}
                            </span>
                        </div>
                        <div class="col-7">
                            {!! Form::text('data[assistance]', null, ['class'=>'form-control']) !!}
                            @error('data[assistance]')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);

            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#photo_id").change(function() {
        console.log("here");
        readURL(this);
    });
</script>
@endpush
