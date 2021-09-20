
@extends('layouts.frontend.master')


@section('title')
Edit Post
@endsection

@section('description')
User Edit Post

@endsection
@section('style')

<link rel="stylesheet" href=" {{asset('layouts/editors/summernote/summernote-bs4.min.css')}}">
<link rel="stylesheet" href=" {{asset('layouts/editors/file_input/css/fileinput.min.css')}}">

<style>
    .file-footer-buttons{
        display: none !important;
    }
</style>
@endsection

@section('content')
<!-- Start Blog Area -->
<div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
    <div class="container">
        <h2> Add Post </h2>

        <div class="row mt--20">
            <div class="col-lg-9 col-12">

            <form id="edit-post-form" action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{--  Title  --}}

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control field" value="{{  $post->title }}" type="text" name="title">
                                <span id="title-error" class="text-danger"></span>
                                @error('title')
                                    <span class="text-danger"> {{ $messge }}</span>
                                @enderror
                            </div>

                            {{--  post  --}}

                            <div class="form-group">
                                <label for="post">Post</label>
                                <textarea class="form-control field" id="post"  name="post">{{  $post->body }}</textarea>

                                <span id="post-error" class="text-danger"></span>

                                @error('post')
                                    <span class="text-danger"> {{ $messge }}</span>
                                @enderror
                            </div>


                    <div class="row">
                            {{--  category  --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">category</label>

                                <select  class="form-control field" name="category" id="category">

                                    <option value="" selected>...</option>
                                    @forelse ( $categories  as $category )
                                    <option value="{{ $category->id }}"  {{ $category->id == $post->category_id  ? 'selected':''}}>{{ $category->title }}</option>
                                    @empty
                                        ...
                                    @endforelse
                                </select>

                                <span id="category-error" class="text-danger"></span>

                                @error('category')
                                    <span class="text-danger"> {{ $messge }}</span>
                                @enderror
                            </div>
                        </div>


                            {{--  status  --}}

                         <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">status</label>
                                <select  class="form-control field" name="status" id="status">

                                    <option value="1" {{ $post->status  ==1 ?'selected':''}}> Active</option>
                                    <option value="0"  {{ $post->status  ==0 ?'selected':''}}>InActive</option>
                                </select>

                                <span id="status-error" class="text-danger"></span>

                                @error('status')
                                    <span class="text-danger"> {{ $messge }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  comment_able  --}}


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="comment_able">Comments</label>
                                <select  class="form-control field" name="comment_able" id="comment_able">
                                    <option value="1" {{ $post->comment_able  ==1 ?'selected':''}}>Allowed</option>
                                    <option value="0" {{ $post->comment_able  ==0 ?'selected':''}}>Not Allowed</option>
                                </select>

                                <span id="comment_able-error" class="text-danger"></span>

                                @error('comment_able')
                                    <span class="text-danger"> {{ $messge }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>



                    {{--  images  --}}

                    <div class="form-group">
                        <label for="images">Images</label>
                        <input type="file"  id="photos"  name="images[]" class="form-control field" multiple="multiple" >
                        <span id="images-error" class="text-danger"></span>

                        @error('images')
                            <span class="text-danger"> {{ $messge }}</span>
                        @enderror
                    </div>


                    <div class="form-group">

                        <button type="submit" class="btn btn-primary"> Update <i class="fa fa-edit"></i></button>
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

<script src="{{ asset('layouts/editors/summernote/summernote-bs4.min.js') }}" ></script>

<script src="{{ asset('layouts/editors/file_input/js/fileinput.min.js')}}" ></script>
<script src="{{ asset('layouts/editors/file_input/js/plugins/piexif.min.js')}}" ></script>
<script src="{{ asset('layouts/editors/file_input/js/plugins/sortable.min.js')}}" ></script>



<script>

    $(function(){


        $('#post').summernote({
            placeholder: '...',
            tabsize: 2,
            height: 300,
            focus: true,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', ]],
              ['view', ['fullscreen', 'codeview', 'help']]
            ]
          });


          $("#photos").fileinput({
              'previewFileType': 'any',
              theme: 'fa',
              maxFileCount:5,
              allowedFileTypes:['image'],
              showUpload:false,
              showCancel:true,
              showRemove:false,
              initialPreview:[
                      @forelse ($post_media as $media )
                      '<img src="{{ asset($media->image_path) }}" class="file-preview-image" alt="{{ $media->file_name }}" title="{{ $media->file_name }}">' ,
                      @empty

                      @endforelse
              ],
              initialPreviewData:false,
              initialPreviewFileType:'image',
              initialPreviewConfig: [


            ],



        });







        })
</script>
@endsection
