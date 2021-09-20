@extends('layouts.backend.master')

@section('title')
Edit Category
@endsection

@section('description')
Admin | Edit Post Category

@endsection

@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Edit Category
            </h4>
        </div>
        <div class="card-body" >


            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" id="edit-category-ajax">
                @csrf
                @method('PUT')


                <div class="row justify-content-center align-items-center ">

                    <div class="col-md-7">
                        <div class="form-group row align-items-center">
                            <label for="title" class="col-md-2">Title</label>
                            <input type="text" name="title" id="title" class="form-control field col-md-10" value="{{ $category->title }}">
                        </div>
                        <strong class="text-danger d-block  text-center" id="title-error">   </strong>
                    </div>

                </div>

                <div class="row justify-content-center align-items-center ">

                    <div class="col-md-7">
                        <div class="form-group row align-items-center">
                            <label for="status" class="col-md-2">Status</label>

                            <select name="status" id="status" class="form-control field col-md-10">
                                <option value="1" {{ $category->status ==1 ? 'selected':'' }}>Active</option>
                                <option value="0" {{ $category->status ==0 ? 'selected':'' }}>InActive</option>

                            </select>
                        </div>

                        <strong class="text-danger d-block  text-center" id="status-error">   </strong>

                    </div>

                </div>


                <div class="row justify-content-center align-items-center ">

                    <div class="col-md-7">
                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary offset-md-2"> Update <i class="fas fa-edit"></i></button>

                       </div>
                    </div>

                </div>




            </form>
        </div>
    </div>

</div>
@endsection
