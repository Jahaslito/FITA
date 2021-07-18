@extends('layouts.custom')

@section('content')
    <body style="overflow: hidden">
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="card">
                <div class="login100-form-title" style="background-image: url(/public/images/background.png);">
					<span class="login100-form-title-1">
						{{ __('Register') }}
					</span>
                </div>

                <div class="login100-form ">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="wrap-input100  m-b-26">
                            <label for="name" class="label-input100">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Enter your name" class="input100 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="wrap-input100 validate-input m-b-26">
                            <label for="email" class="label-input100 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Enter your email address" class="input100 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="wrap-input100 validate-input m-b-26">
                            <label for="password" class="label-input100">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Enter your password" class=" input100 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="wrap-input100 validate-input m-b-26">
                            <label for="password-confirm" class="label-input100">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="Confirm your password" class=" input100 form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="flex-sb-m w-full p-b-30">
                            <div class=" mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="login100-form-btn">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                            <a class="btn btn-link " href="{{ route('login') }}" style="margin-right: 60px">
                                {{ __('Login') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
@endsection
