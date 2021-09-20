@extends('layouts.backend.master')

@section('title')
Create Admin
@endsection

@section('description')
Admin | Create  Admin

@endsection

@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Create Admin
            </h4>
        </div>
        <div class="card-body"  >


            <form action="{{ route('admin.admins.store') }}" method="POST" id="add-admin-ajax">
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


              {{-- //permissions --}}
                <div class="row justify-content-center align-items-center ">


                    @php
                        $models =['admins','users','categories','pages','posts','comments','settings','contact-messages'];
                        $crud =['read', 'create','update', 'delete'];
                    @endphp
                    <div class="col-lg-8">
                        <div class="form-group row align-items-center">
                            <label for="permissions" class="col-lg-2">Permissions</label>
                            {{-- <input type="password" name="password_confirmation" id="password" class="form-control field col-lg-10"> --}}

                            <div class="col-lg-10 text-left">

                                <ul class="nav nav-tabs" id="myTab" role="tablist" >

                                    @foreach ( $models as $index => $model )
                                      <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ $index ==0 ?'active':'' }} m-20" id="{{ $model }}-tab" data-toggle="tab" href="#{{ $model }}" role="tab" aria-controls="{{ $model }}" aria-selected="true">{{ $model }}</a>
                                      </li>
                                    @endforeach
                                </ul>


                                <div class="tab-content" id="myTabContent" style="padding: 20px 0; margin:0">
                                    @foreach ( $models as $index => $model )

                                    <div class="tab-pane fade show {{ $index ==0 ?'active':'' }}" id="{{ $model }}" role="tabpanel" aria-labelledby="{{ $model }}-tab">



                                        @foreach ($crud as $action )
                                            <div class="form-group row">

                                                <div class="col-3 ">
                                                    <label  class="form-check-label"   for="{{ $model.'-'.$action }}">{{ $model.' '.$action }}</label>
                                                </div>

                                                <div class="col-9 ">
                                                    <input   {{ $action =='read' ? 'checked ':''}} class="form-check-input field" type="checkbox" value="{{ $model.'-'.$action }}" name="permissions[]" id="{{ $model.'-'.$action }}">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                    @endforeach

                                </div>

                            </div>

                            <strong class="text-danger d-block  text-center" id="permissions-error">   </strong>




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
