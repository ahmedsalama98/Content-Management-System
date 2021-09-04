@extends('layouts.frontend.auth')

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
                <h2 class="form-title">Login</h2>
                <form class="register-form" id="login-form" action="{{ route('login.store') }}" method="POST">
                  @csrf
                    <div class="form-group">
                        <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input value="{{ old('username')? old('username'):old('email') }}" type="text" name="identfy" id="your_name" placeholder="username or email"/>


                    </div>

                    @error('email')
                    <strong class="error">{{ $message }}</strong>
                    @enderror
                    @error('username')
                    <strong class="error">{{ $message }}</strong>
                    @enderror

                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Password"/>
                    </div>
                    @error('password')
                    <strong class="error">{{ $message }}</strong>
                    @enderror
                    <div class="form-group">
                        <input type="checkbox" name="remember" id="remember" class="" />
                        <label for="remember" class="label-agree-term"><span><span></span></span>Remember me</label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection
