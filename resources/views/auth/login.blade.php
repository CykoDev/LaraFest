@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image" style="
                    background: url({{ asset('img/public/backagainfor2020.jpg') }});
                    background-size: cover;
                "></div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ __('Login To Your Account') }}</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email..." autofocus>

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
                            <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Login') }}
                        </button>
                        <hr>
                        <a href="#" class="btn btn-google btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i>{{ __(' Login with Google') }}
                        </a>
                        <a href="#" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i>{{ __(' Login with Facebook') }}
                        </a>
                    </form>

                    <hr>

                    <div class="row mt-3">

                        @if (Route::has('password.request'))
                            <div class="col-6 text-left">
                                <a class="small" href="{{ route('password.request') }}">
                                    {{ __('forgot your password?') }}
                                </a>
                            </div>
                        @endif


                        <div class="col-6 text-right">
                            <a class="small" href="{{ route('register') }}">
                                {{ __('create an account!') }}
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
