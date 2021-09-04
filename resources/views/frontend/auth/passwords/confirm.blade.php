@extends('layouts.frontend.auth')
@section('title')
Confirm Password
@endsection
@section('content')

<section class="sign-in" >
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('layouts/images/signin-image.jpg') }}" alt="sing up image"></figure>
                <a href="{{ route('password.request') }}" class="signup-image-link">                                        {{ __('Forgot Your Password?') }}
                </a>
            </div>


            <div class="signin-form" >
                <h2 class="form-title">
                    {{ __('Please confirm your password before continuing.') }}
                </h2>
                <form class="register-form" id="login-form" action="{{ route('password.confirm') }}" method="POST">
                  @csrf
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input value="{{ old('password') }}" type="password" name="password" id="password" placeholder=" password"/>
                    </div>
                    @error('password')
                    <strong class="error">{{ $message }}</strong>
                    @enderror
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="{{ __('Confirm Password') }}"/>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection
