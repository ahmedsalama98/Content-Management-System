@extends('layouts.backend.master')

@section('title')
Edit Post
@endsection

@section('description')
Admin | Edit Comment
@endsection


@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 ">
            <h4 class="m-0 font-weight-bold text-primary">Edit Comment</h4>

        </div>
        <div class="card-body" >
            <form id="edit-comment-ajax" action="{{ route('admin.comment.update', $comment->id) }}" method="POST" >
                @csrf
                @method('PUT')




                        <div class="row justify-content-center align-items-center">
    {{--  comment  --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea class="form-control field" name="comment" cols="30" rows="5">{{ $comment->comment }}</textarea>
                                    <span id="comment-error" class="text-danger"></span>
                                    @error('comment')
                                        <span class="text-danger"> {{ $messge }}</span>
                                    @enderror
                                </div>

                            </div>




                        </div>



                        <div class="row justify-content-center align-items-center">

                            <div class="col-md-6">
                                    {{--  status  --}}

                                    <div class="form-group">
                                        <label for="status">status</label>
                                        <select  class="form-control field" name="status" id="status">

                                            <option value="1" {{ $comment->status  ==1 ?'selected':''}}> Active</option>
                                            <option value="0"  {{ $comment->status  ==0 ?'selected':''}}>InActive</option>
                                        </select>

                                        <span id="status-error" class="text-danger"></span>

                                        @error('status')
                                            <span class="text-danger"> {{ $messge }}</span>
                                        @enderror
                                    </div>



                            </div>

                        </div>

                        <div class="row justify-content-center align-items-center">

                            <div class="col-md-6">


                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary"> Update <i class="fa fa-edit"></i></button>
                                </div>



                            </div>

                        </div>













        </form>



        </div>
    </div>

</div>
@endsection

