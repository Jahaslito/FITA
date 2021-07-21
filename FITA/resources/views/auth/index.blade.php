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
                        <label for="email" class="label-input100">{{ __('Username') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" placeholder="Enter your username" class=" input100 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="wrap-input100 form-group m-b-18">
                        <label for="password" class="label-input100">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" placeholder="Enter your password" class=" input100 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <div class="contact100-form-checkbox">
                                <input class="input-checkbox100" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="label-checkbox100" for="remember">
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