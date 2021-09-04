@extends('layouts.frontend.auth')
@section('content')
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <form method="POST" action="{{ route('register.store') }}" class="register-form"  id="register-form">
                    @csrf

                    <div class="form-group">
                        <input  value="{{ old('name') }}" type="text" name="name" id="name" placeholder="Your Name"/>
                    </div>
                    @error('name')
                    <strong class="error">{{ $message }}</strong>
                    @enderror


                    <div class="form-group">
                        <input  value="{{ old('username') }}" type="text" name="username" id="username" placeholder="Your UserName"/>
                    </div>
                    @error('username')
                    <strong class="error">{{ $message }}</strong>
                    @enderror

                    <div class="form-group">
                        <input  value="{{ old('mobile') }}" type="number" name="mobile" id="mobile" placeholder="Your mobile"/>
                    </div>
                    @error('mobile')
                    <strong class="error">{{ $message }}</strong>
                    @enderror


                    <div class="form-group">
                        <input value="{{ old('email') }}" type="email" name="email" id="email" placeholder="Your Email"/>
                    </div>
                    @error('email')
                    <strong class="error">{{ $message }}</strong>
                    @enderror




                    <div class="form-group">
                        <input  type="password" name="password" id="password" placeholder="Password"/>
                    </div>
                    @error('password')
                    <strong class="error">{{ $message }}</strong>
                    @enderror


                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="password.cofirm" placeholder="Repeat your password"/>
                    </div>
                    @error('password.cofirm')
                    <strong class="error">{{ $message }}</strong>
                    @enderror

                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                    </div>
                    @error('agree-term')
                    <strong class="error">{{ $message }}</strong>
                    @enderror


                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="{{ asset('layouts/images/signup-image.jpg') }}" alt="sing up image"></figure>
                <a href="{{ route('login.show') }}" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>
</section>

@endsection



















