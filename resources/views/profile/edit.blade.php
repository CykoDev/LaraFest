@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">Hey there {{ ucwords($user->name) }}</h1>
    </div>

    <div class="row">



        <div class="col-lg-3 mb-4">

            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['ProfileController@update', 'profile.edit'], 'files'=>true]) !!}

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
                            <div id="imagePreview" style="background-image: url({{ $user->photo ? $user->photo->path : $user->defaultImage }});">
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
                    <h6 class="m-0 font-weight-bold text-primary">{{ ucwords($user->role->name) }} Profile</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
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

            @if($user->data)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
                    </div>
                    <div class="card-body">
                        @foreach($user->data as $key=>$value)
                            <div class="form-row py-2">
                                <div class="col-3">
                                    <span class="text-dark font-weight-bold">
                                        {{ ucwords(str_replace('_',' ',str_replace('_id', '', $key))) }}
                                    </span>
                                </div>
                                <div class="col-7">
                                    @if(strpos($key, 'photo_id'))
                                        {!! Form::file('data['.$key.']', null, ['class'=>'form-control']) !!}
                                    @else
                                        {!! Form::text('data['.$key.']', $value, ['class'=>'form-control']) !!}
                                    @endif
                                </div>
                                <div class="col-2"></div>
                            </div>
                        @endforeach
                    </div>

                    {!! Form::close() !!}
                </div>
            @endif
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
