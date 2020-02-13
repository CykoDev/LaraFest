@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image" style="
                    background: url({{ asset('img/public/undraw_develop_app_kvt2.svg') }});
                    background-position: center;
                    background-repeat: no-repeat;
                    background-attachment: scroll;
                    background-size: contain;
                "></div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ __('Create An Account') }}</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Username" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Register') }}
                        </button>
                    </form>

                    <hr class="my-3">

                    <div class="row mt-3">

                        <div class="col-12 text-right small">
                            already have an account?
                            <a href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </div>

                    </div>

                    <div class="mt-4">
                        @include('layouts.footers.guest')
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
</div>
@endsection
