@extends('layouts.custom')
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(/public/images/background.png);">
					<span class="login100-form-title-1">
						Sign In
					</span>
                </div>

                <form class="login100-form " method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="wrap-input100 form-group m-b-26" >
                        <label for="email" class="label-input100">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" placeholder="Enter your username" class=" input100 form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="wrap-input100 form-group m-b-18">
                        <label for="password" class="label-input100">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" placeholder="Enter your password" class=" input100 form-control" name="password" required autocomplete="current-password">
                            @error('password')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="form-group form-check">
                            <div class="form-group form-check" id="customCheckbox">
                                <input id="divCheckbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="" for="remember" style="margin-left: 10px; color: #808080">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link " href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="flex-sb-m w-full p-b-30">
                        <div class=" mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="login100-form-btn">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <a class="btn btn-link " href="{{ route('register') }}" style="margin-right: 60px">
                            {{ __('Create Account') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    </body>
    </html>
@endsection
