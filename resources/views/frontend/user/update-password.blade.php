
@extends('layouts.frontend.master')


@section('title')
Update  Password
@endsection

@section('description')
Update user Password
@endsection


@section('content')
<!-- Start Blog Area -->



<div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
    <div class="container">
        <h2> Update your Password</h2>

        <div class="row mt--20">
            <div class="col-lg-9 col-12">


                <form  id="update-password-form" action="{{ route('user.update-password.store') }}" method="POST">
                    @csrf
                    <div class="row">

    {{--  old-password  --}}
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="old-password">Old Password </label>
                                <input type="password"  name="old-password" class="form-control field" id="old-password" >
                                <strong id='old-password-error' class="text-danger"> </strong>
                            </div>

                        </div>


    {{--  new-password  --}}
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="new-password">New Password </label>
                                <input type="password"  name="new-password" class="form-control field" id="new-password" >
                                <strong id='new-password-error' class="text-danger"> </strong>
                            </div>

                        </div>




    {{--  new-password-confirmation  --}}
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="new-password-confirmation">New Password  Confirmation </label>
                                <input type="password"  name="new-password-confirmation" class="form-control field" id="new-password-confirmation" >
                                <strong id='new-password-confirmation-error' class="text-danger"> </strong>
                            </div>

                        </div>







                    </div>



                            <div class="form-group">

                                <button class="btn btn-primary" type="submit" >Update  Password </button>
                            </div>

                </form>

            </div>
            <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">

                @include('layouts.frontend.dashboard_sidebar')
            </div>
        </div>
    </div>
</div>
<!-- End Blog Area -->
@endsection
