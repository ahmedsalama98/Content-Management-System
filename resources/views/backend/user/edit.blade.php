@extends('layouts.backend.master')

@section('title')
Edit User
@endsection

@section('description')
Admin | Edit  User

@endsection

@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Edit User
            </h4>
        </div>
        <div class="card-body"  >


            <form action="{{ route('admin.user.update' , $user->id) }}" method="POST" id="edit-admin-ajax">
                @csrf
                @method('PUT')


                {{-- //name --}}
                <div class="row justify-content-center align-items-center">

                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="name" class="col-lg-2">Name</label>
                            <input value="{{ $user->name }}" type="text" name="name" id="name" class="form-control field col-lg-10">
                        </div>
                        <strong class="text-danger d-block  text-center" id="name-error">   </strong>
                    </div>

                </div>



                {{-- //username --}}
                <div class="row justify-content-center align-items-center ">

                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="username" class="col-lg-2">Username</label>
                            <input value="{{ $user->username }}" autocomplete="username" type="text" name="username" id="username" class="form-control field col-lg-10">
                        </div>
                        <strong class="text-danger d-block  text-center" id="username-error">   </strong>
                    </div>

                </div>
                {{-- //email --}}
                <div class="row justify-content-center align-items-center ">


                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="email" class="col-lg-2">Email</label>
                            <input value="{{ $user->email }}" type="email" name="email" id="email" class="form-control field col-lg-10">
                        </div>
                        <strong class="text-danger d-block  text-center" id="email-error">   </strong>
                    </div>

                </div>

                {{-- //mobile --}}
                <div class="row justify-content-center align-items-center ">


                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="mobile" class="col-lg-2">Mobile</label>
                            <input type="number" value="{{ $user->mobile }}" name="mobile" id="mobile" class="form-control field col-lg-10">
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
                            <button type="submit" class="btn btn-primary offset-lg-2"> Edit <i class="fas fa-edit"></i></button>

                       </div>
                    </div>

                </div>




            </form>
        </div>
    </div>

</div>
@endsection
