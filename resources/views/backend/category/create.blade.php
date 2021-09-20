@extends('layouts.backend.master')

@section('title')
Create Category
@endsection

@section('description')
Admin | Create Post Category

@endsection

@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Create Category
            </h4>
        </div>
        <div class="card-body" >


            <form action="{{ route('admin.category.store') }}" method="POST" id="add-category-ajax">
                @csrf


                <div class="row justify-content-center align-items-center ">

                    <div class="col-md-7">
                        <div class="form-group row align-items-center">
                            <label for="title" class="col-md-2">Title</label>
                            <input type="text" name="title" id="title" class="form-control field col-md-10">
                        </div>
                        <strong class="text-danger d-block  text-center" id="title-error">   </strong>
                    </div>

                </div>

                <div class="row justify-content-center align-items-center ">

                    <div class="col-md-7">
                        <div class="form-group row align-items-center">
                            <label for="status" class="col-md-2">Status</label>

                            <select name="status" id="status" class="form-control field col-md-10">
                                <option value="1">Active</option>
                                <option value="0">InActive</option>

                            </select>
                        </div>

                        <strong class="text-danger d-block  text-center" id="status-error">   </strong>

                    </div>

                </div>


                <div class="row justify-content-center align-items-center ">

                    <div class="col-md-7">
                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary offset-md-2"> Add <i class="fas fa-plus"></i></button>

                       </div>
                    </div>

                </div>




            </form>
        </div>
    </div>

</div>
@endsection
