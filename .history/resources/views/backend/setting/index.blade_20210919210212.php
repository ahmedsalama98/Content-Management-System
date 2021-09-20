@extends('layouts.backend.master')

@section('title')
Settings
@endsection

@section('description')
Admin | Settings page
@endsection

@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Settings



            </h4>
        </div>
        <div class="card-body" >



            <div class="row" >
                <div class="col-md-2">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">General</a>
                    <a class="nav-link " id="v-pills-social_accounts-tab" data-toggle="pill" href="#v-pills-social_accounts" role="tab" aria-controls="v-pills-social_accounts" aria-selected="true">Social Accounts</a>

                  </div>
                </div>
                <div class="col-md-10">



                    <form action="{{ route('admin.settings.update') }}" method="POST" id="settings-update-ajax">
                        @method('PUT')
                        @csrf

                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">.



                                @forelse ($general as $social)




                                     <div class="row justify-content-center">
                                         <div class="col-md-10">
                                            <div class="form-group">

                                                @php
                                                    $key =$social->key;
                                                    $value =$social->value;
                                                @endphp
                                                <label for="{{ $social->key}}">{{ $social->display_name }}</label>
                                                <input class="form-control" type="text" name="settings[{{ $key}}]" id="{{ $key }}" value="{{  $value }}">
                                            </div>
                                         </div>
                                     </div>
                                @empty

                                @endforelse


                                 </div>
                            <div class="tab-pane fade show " id="v-pills-social_accounts" role="tabpanel" aria-labelledby="v-pills-social_accounts-tab">...

                                 @forelse ($social_accounts as $social)




                                        <div class="row justify-content-center">
                                            <div class="col-md-10">
                                            <div class="form-group">

                                                @php
                                                    $key =$social->key;
                                                    $value =$social->value;
                                                @endphp
                                                <label for="{{ $social->key}}">{{ $social->display_name }}</label>
                                                <input class="form-control" type="text" name="settings[{{ $key}}]" id="{{ $key }}" value="{{  $value }}">
                                            </div>
                                            </div>
                                        </div>
                                @empty

                                @endforelse

                            </div>


                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                   <div class="form-group">

                                       <button type="submit" class="btn btn-primary">Updat <i class="fa fa-edit"></i></button>
                                   </div>
                                </div>
                            </div>



                    </form>



                </div>
                </div>
              </div>
        </div>
    </div>

</div>
@endsection
