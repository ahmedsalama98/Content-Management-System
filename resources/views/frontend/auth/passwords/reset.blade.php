@extends('layouts.frontend.auth')
@section('title')
Reset Password
@endsection
@section('content')

<section class="sign-in" >
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('layouts/images/signin-image.jpg') }}" alt="sing up image"></figure>
                <a href="{{ route('register.show') }}" class="signup-image-link">Create an account</a>
                <a href="{{ route('password.request') }}" class="signup-image-link">Forgote Your Password ?</a>
            </div>


            <div class="signin-form" >
                <h2 class="form-title">Reset Password </h2>
                <form class="register-form" id="login-form" method="POST" action="{{ route('password.update') }}">
                  @csrf
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input value="{{ old('email') }}" type="email" name="email" id="email" placeholder=" email"/>


                    </div>

                    @error('email')
                    <strong class="error">{{ $message }}</strong>
                    @enderror

                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Password"/>
                    </div>
                    @error('password')
                    <strong class="error">{{ $message }}</strong>
                    @enderror

                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="  {{ __('Reset Password') }}"/>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection
