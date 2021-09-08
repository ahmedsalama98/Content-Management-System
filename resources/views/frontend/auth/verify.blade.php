@extends('layouts.frontend.auth')
@section('content')
<section class="sign-in" >
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('layouts/images/signin-image.jpg') }}" alt="sing up image"></figure>
                <a href="{{ route('register.show') }}" class="signup-image-link">Create an account</a>
            </div>

            @if (session('resent'))
            <div class="success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
           @endif


            <div class="signin-form" >

                <h2 class="form-title">
                    {{ __('Verify Your Email Address') }}
                </h2>
                <h2 class="form-title">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}
                </h2>
                <form class="register-form" id="login-form" action="{{ route('verification.resend') }}" method="POST">
                  @csrf

                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="{{ __('click here to request another') }}"/>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>



@endsection
