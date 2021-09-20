@extends('layouts.frontend.master')

@section('title')
    {{ $post->title  }}
@endsection
@section('content')

<div class="page-blog-details section-padding--lg bg--white">
    <div class="container">


        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="blog-details content">
                    <article class="blog-post-details">
                        <div class="post-thumbnail">
                            @if ($post->media->count() > 0)
                            <div className="owl-carousel">

{{--   post media  --}}
                            <!-- Start Slider area -->
                            <div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">


                                @foreach ( $post->media as $index=>$media )


                                <!-- Start Single Slide -->
                                <div class="slide animation__style10  align__center--left">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="slider__content">
                                                    <div class="contentbox">
                                                        <img  style="display:block; max-width: 500px; margin: auto; margin-bottom:50px" src="{{ asset('uploads/posts_media/'.$media->file_name) }}"  alt="...">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @endforeach
                                <!-- End Single Slide -->

                            </div>
                            <!-- End Slider area -->

                        </div>


                            @else
                            <img style="display:block; max-width: 500px; margin: auto; margin-bottom:50px" src="{{ asset('uploads/posts_media/default.png') }}" alt="blog images">
                            @endif


                            {{--  <button class="confirm_action">confirm_action</button>  --}}

{{--   post media  --}}
{{--   post  --}}

                        </div>
                        <div class="post_wrapper" style="margin-top: 50px">
                            <div class="post_header">
                                <h2>{{ $post->title }}</h2>
                                <div class="blog-date-categori">
                                    <ul>
                                        <li>{{ $post->created_at->format('M d , Y') }}</li>
                                        <li><a href="{{ route('author.show' ,$post->user->username)}}"  rel="author">{{ $post->user->name}}</a></li>
                                    </ul>
                                </div>


                                @if ( Auth::id() == $post->user_id)
                                <div class="post_owner_controle">
                                    <div class="open_button"> <i class="fa fa-ellipsis-h"></i> </div>

                                    <div class="actions">
                                        <a  class="btn btn-primary" href="{{ route('post.edit' , $post->id) }}">Edit Post <i class="fa fa-edit"></i></a>
                                        <form method="POST"  id="regular-delete-post"  action="{{ route('post.destroy', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="_from_post_page" value="true">
                                            <button  type="submit" class="btn btn-danger d-block btn-block"> Delete Post <i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>

                                @endif

                            </div>
                            <div class="post_content">

                                <p> {!! $post->body !!}</p>

                            </div>
                            <ul class="blog_meta">
                                <li> Category :</li>
                                <li><a href="{{ route('category.show' ,$post->category->slug)}}"><span> {{ $post->category->title }}</span> </a></li>

                            </ul>



                        </div>
{{--   post  --}}

                    </article>
{{--  comments  --}}
                    <div class="comments_area">
                        <h3 class="comment__title" ><span id="comments_count">{{ $post->approved_comments->count() }}</span> comments</h3>
                        <ul class="comment__list" id="commnets-container">

                            @forelse ($post->approved_comments as $comment)
                            <li>
                                <div class="wn__comment" id="parent-id-{{ $comment->id }}">
                                    <div class="thumb">
                                        @php
                                            $comment_profile_image = isset($comment->user)? asset($comment->user->image_path) : asset('uploads/users_images/default.png');
                                        @endphp
                                        <img  class="avatar " src="{{ $comment_profile_image}}" alt="comment images">


                                        {{--  <img  style="border-radius: 50%" src="{{ get_gravatar($comment->email , 46)}}" alt="comment images">  --}}

                                    </div>
                                    <div class="content">
                                        <div class="comnt__author d-block d-sm-flex">
                                            <span><a href="#">

                                                @if (isset($comment->user))
                                                  {{ $comment->user->name }}
                                                @else
                                                    guest
                                                @endif

                                            </a> </span>
                                            <span>{{ $comment->created_at->format( 'M d , Y H:i A') }}</span>

                                        </div>
                                        <P class="comment-comment"> {{ $comment->comment }}</P>


                                        @if ( Auth::id() == $comment->user_id ||Auth::id() == $post->user_id)
                                        <div class="comment_owner_controle">
                                            <div class="open_button"> <i class="fa fa-ellipsis-v"></i> </div>

                                            <div class="actions">
                                                @if (Auth::id() == $comment->user_id)
                                                <button  data-parentid="{{ $comment->id }}"  data-csrf="{{csrf_token()}}" data-oldcomment="{{$comment->comment}}" data-url="{{ route('comment.update', $comment->id) }}" class="btn btn-primary edit-comment-ajax-button" >Edit Comment <i class="fa fa-edit"></i></button>
                                                @endif
                                                <form method="POST" data-parentid="{{ $comment->id }}"  class="delete-comment-ajax"  action="{{ route('comment.destroy', $comment->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button  type="submit" class="btn btn-danger d-block btn-block"> Delete Comment <i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>

                                        @endif
                                    </div>
                                </div>

                            </li>

                            @empty
                                <p> No Comments found</p>
                            @endforelse


                        </ul>
                    </div>
{{--  comments  --}}


{{--  add comment  --}}

                    <div class="comment_respond">

                        @if ( $post ->comment_able ==1)
                        <h3 class="reply_title">Leave a Reply</h3>
                        @php
                        $profileimage = Auth::check() ? asset(Auth::user()->image_path) : asset('uploads/users_images/default.png');
                        @endphp
                        <form class="comment__form" method="POST" data-csrf="{{ csrf_token() }}"    data-profileimage="{{  $profileimage }}" id="add_comment" action="{{ route('comment.store', $post->id) }}">
                            @csrf
                            @method('POST')
                            <p>Your email address will not be published.Required fields are marked </p>
                                    <div class="input__box">
                                        <textarea name="comment" placeholder="Your comment here" class="field"></textarea>
                                        <strong id='comment-error' class="error"> </strong>
                                    </div>
                                    <div class="input__wrapper clearfix">

                                    @if (!Auth::check())
                                        <div class="input__box name one--third">

                                        <input type="text" placeholder="name" name="name"  class="field">

                                        <strong id='name-error' class="error"> </strong>
                                        </div>
                                        <div class="input__box email one--third">
                                            <input type="email" placeholder="email" name="email" class="field">
                                            <strong id='email-error' class="error"> </strong>
                                        </div>
                                        <div class="input__box website one--third">
                                            <input type="text" placeholder="website" name="website" class="field">
                                            <strong id='website-error' class="error"> </strong>
                                        </div>

                                    @endif
                                </div>
                                    <div class="submite__btn">
                                        <button type="submit" class="btn btn-primary">Post Comment</button>
                                    </div>
                        </form>
                        @else
                        <h3 class="reply_title">Comments turned off</h3>
                        @endif
                    </div>
{{--  add comment  --}}

                </div>
            </div>
            <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">

                @include('layouts.frontend._sidebar')
            </div>

        </div>
    </div>

    <div id="appneds-component">

    </div>
</div>
@endsection
@section('script')
<script>






</script>
@endsection
