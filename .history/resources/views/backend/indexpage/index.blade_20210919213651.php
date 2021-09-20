@extends('layouts.backend.master')

@section('title')
Admin | Dashboard
@endsection

@section('description')
Admin | Dashboard page
@endsection

@section('content')





<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           All Users


                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($all_users )}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-succes text-uppercase mb-1">
                           All Users


                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($all_users )}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
@endsection
