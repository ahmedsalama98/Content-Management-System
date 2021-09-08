@extends('layouts.frontend.auth')
@section('title')
Send Email
@endsection
@section('content')

<section class="sign-in" >
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('layouts/images/signin-image.jpg') }}" alt="sing up image"></figure>
                <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
            </div>


            <div class="signin-form" >
                <h2 class="form-title">Send Email </h2>
                <form class="register-form" id="login-form" action="{{ route('password.email') }}" method="POST">
                  @csrf
                    <div class="form-group">
                        <input value="{{ old('email') }}" type="email" name="email" id="email" placeholder=" email"/>

                    </div>

                    @error('email')
                    <strong class="error">{{ $message }}</strong>
                    @enderror



                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value=" {{ __('Send Password Reset Link') }}"/>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection
