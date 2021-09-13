
@extends('layouts.frontend.master')


@section('title')
Update  Info
@endsection

@section('description')
Update user Information
@endsection


@section('content')
<!-- Start Blog Area -->

@php
    $user =Auth::user();
@endphp

<div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
    <div class="container">
        <h2> Update your Info</h2>

        <div class="row mt--20">
            <div class="col-lg-9 col-12">


                <form  id="update-info-form" action="{{ route('user.update-info.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">

    {{--  name  --}}
                        <div class="col-md-3">

                            <div class="form-group">
                                <label for="name">Name </label>
                                <input type="text" value="{{ $user->name}}" name="name" class="form-control field" id="name" >
                                <strong id='name-error' class="text-danger"> </strong>
                            </div>

                        </div>


    {{--  email  --}}
                        <div class="col-md-3">

                            <div class="form-group">
                                <label for="email">Email </label>
                                <input type="text" value="{{ $user->email}}" name="email" class="form-control field" id="email" >
                                <strong id='email-error' class="text-danger"> </strong>
                            </div>

                        </div>




    {{--  mobile  --}}
                        <div class="col-md-3">

                            <div class="form-group">
                                <label for="mobile">mobile </label>
                                <input type="number" value="{{ $user->mobile}}" name="mobile" class="form-control field" id="mobile" >
                                <strong id='mobile-error' class="text-danger"> </strong>
                            </div>

                        </div>






    {{--  receive_email  --}}
                        <div class="col-md-3">

                            <div class="form-group">
                                <label for="receive_email">Receive Emails </label>

                                <select name="receive_email" class="form-control field" id="receive_email">

                                    <option value="1" {{ $user->receive_email ==1 ? 'selected' : '' }}>Allowed</option>
                                    <option value="0" {{ $user->receive_email ==0 ? 'selected' : '' }}> Not Allowed</option>

                                </select>
                                <strong id='receive_email-error' class="text-danger"> </strong>

                            </div>

                        </div>


                    </div>


{{--  bio  --}}
                            <div class="form-group">
                                <label for="bio">bio </label>
                                <textarea name="bio" class="form-control field" id="bio" rows="5" >{{ $user->bio}}</textarea>
                              <strong id='bio-error' class="text-danger"> </strong>
                            </div>


{{--  profile-image  --}}


                            <div class="form-group">
                                <label for="profile-image">Profile Image </label>
                                <input type="file"  name="profile-image" class="form-control field" id="profile-image" >
                                <strong id='profile-image-error' class="text-danger"> </strong>
                            </div>





                            <div class="form-group">

                                <button class="btn btn-primary" type="submit" >Update Information</button>
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

@section('script')

<script>

    let inputFile = document.getElementById('profile-image');



    function  imgPreview(event){

        let input = event.target;

        if( input.files && input.files[0]){

            let reder = new FileReader();


            reder.onload = (e)=>{

                let src = e.target.result;

                document.getElementById('profile-avatar').src =src;

            }
            reder.readAsDataURL(input.files[0]);
        }
    }

    inputFile.addEventListener('change' , imgPreview)
</script>

@endsection
