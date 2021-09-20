@extends('layouts.backend.master')

@section('title')
Create User
@endsection

@section('description')
Admin | Create  User

@endsection

@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Create User
            </h4>
        </div>
        <div class="card-body"  >


            <form action="{{ route('admin.user.store') }}" method="POST" id="add-admin-ajax">
                @csrf

                {{-- //name --}}
                <div class="row justify-content-center align-items-center">

                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="name" class="col-lg-2">Name</label>
                            <input type="text" name="name" id="name" class="form-control field col-lg-10">
                        </div>
                        <strong class="text-danger d-block  text-center" id="name-error">   </strong>
                    </div>

                </div>



                {{-- //username --}}
                <div class="row justify-content-center align-items-center ">

                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="username" class="col-lg-2">Username</label>
                            <input autocomplete="username" type="text" name="username" id="username" class="form-control field col-lg-10">
                        </div>
                        <strong class="text-danger d-block  text-center" id="username-error">   </strong>
                    </div>

                </div>
                {{-- //email --}}
                <div class="row justify-content-center align-items-center ">


                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="email" class="col-lg-2">Email</label>
                            <input type="email" name="email" id="email" class="form-control field col-lg-10">
                        </div>
                        <strong class="text-danger d-block  text-center" id="email-error">   </strong>
                    </div>

                </div>

                {{-- //mobile --}}
                <div class="row justify-content-center align-items-center ">


                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="mobile" class="col-lg-2">Mobile</label>
                            <input type="number" name="mobile" id="mobile" class="form-control field col-lg-10">
                        </div>
                        <strong class="text-danger d-block  text-center" id="mobile-error">   </strong>
                    </div>

                </div>

                {{-- //password --}}
                <div class="row justify-content-center align-items-center ">


                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="password" class="col-lg-2">Password</label>
                            <input autocomplete="new-password" type="password" name="password" id="password" class="form-control field col-lg-10">
                        </div>
                        <strong class="text-danger d-block  text-center" id="password-error">   </strong>
                    </div>

                </div>

                {{-- //password_confirmation --}}
                <div class="row justify-content-center align-items-center ">


                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="password_confirmation" class="col-lg-2">Password Confirmation</label>
                            <input autocomplete="new-password" type="password" name="password_confirmation" id="password_confirmation" class="form-control field col-lg-10">
                        </div>
                        <strong class="text-danger d-block  text-center" id="password_confirmation-error">   </strong>
                    </div>

                </div>







                <div class="row justify-content-center align-items-center ">

                    <div class="col-lg-8">
                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary offset-lg-2"> Add <i class="fas fa-plus"></i></button>

                       </div>
                    </div>

                </div>




            </form>
        </div>
    </div>

</div>
@endsection
