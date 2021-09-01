@extends('layouts.frontend.master')

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
                                        <li>J{{ $post->created_at->format('M d , Y') }}</li>
                                        <li><a href="#"  rel="author">{{ $post->user->name}}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="post_content">

                                <p> {!! $post->body !!}</p>

                            </div>
                            <ul class="blog_meta">
                                <li> Category :</li>
                                <li><a href="#"><span> {{ $post->category->title }}</span> </a></li>

                            </ul>
                        </div>
{{--   post  --}}

                    </article>
{{--  comments  --}}
                    <div class="comments_area">
                        <h3 class="comment__title" id="comments_count">{{ $post->approved_comments->count() }} comments</h3>
                        <ul class="comment__list">

                            @forelse ($post->approved_comments as $comment)
                            <li>
                                <div class="wn__comment">
                                    <div class="thumb">
                                      @if (isset($comment->user->user_image))
                                      <img  style="border-radius: 50%" src="{{ asset('uploads/users_images/'.$comment->user->user_image) }}" alt="comment images">

                                      @else
                                        <img  style="border-radius: 50%" src="{{ get_gravatar($comment->email , 46)}}" alt="comment images">
                                      @endif

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
                                        <P> {{ $comment->comment }}</P>
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
                        <h3 class="reply_title">Leave a Reply</h3>
                        <form class="comment__form" method="POST" id="add_comment" action="{{ route('post.addComment', $post->id) }}">
                            @csrf
                            @method('POST')
                            <p>Your email address will not be published.Required fields are marked </p>
                            <div class="input__box">
                                <textarea name="comment" placeholder="Your comment here" class="field"></textarea>
                                <strong id='comment-error' class="error"> </strong>
                            </div>
                            <div class="input__wrapper clearfix">
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
                            </div>
                            <div class="submite__btn">
                                <button type="submit" class="btn btn-primary">Post Comment</button>
                            </div>
                        </form>
                    </div>
{{--  add comment  --}}

                </div>
            </div>
            <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                <div class="wn__sidebar">
                    <!-- Start Single Widget -->
                    <aside class="widget search_widget">
                        <h3 class="widget-title">Search</h3>
                        <form action="#">
                            <div class="form-input">
                                <input type="text" placeholder="Search...">
                                <button><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </aside>
                    <!-- End Single Widget -->
                    <!-- Start Single Widget -->
                    <aside class="widget recent_widget">
                        <h3 class="widget-title">Recent</h3>
                        <div class="recent-posts">
                            <ul>
                                <li>
                                    <div class="post-wrapper d-flex">
                                        <div class="thumb">
                                            <a href="blog-details.html"><img src="images/blog/sm-img/1.jpg" alt="blog images"></a>
                                        </div>
                                        <div class="content">
                                            <h4><a href="blog-details.html">Blog image post</a></h4>
                                            <p>	March 10, 2015</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-wrapper d-flex">
                                        <div class="thumb">
                                            <a href="blog-details.html"><img src="images/blog/sm-img/2.jpg" alt="blog images"></a>
                                        </div>
                                        <div class="content">
                                            <h4><a href="blog-details.html">Post with Gallery</a></h4>
                                            <p>	March 10, 2015</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-wrapper d-flex">
                                        <div class="thumb">
                                            <a href="blog-details.html"><img src="images/blog/sm-img/3.jpg" alt="blog images"></a>
                                        </div>
                                        <div class="content">
                                            <h4><a href="blog-details.html">Post with Video</a></h4>
                                            <p>	March 10, 2015</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-wrapper d-flex">
                                        <div class="thumb">
                                            <a href="blog-details.html"><img src="images/blog/sm-img/4.jpg" alt="blog images"></a>
                                        </div>
                                        <div class="content">
                                            <h4><a href="blog-details.html">Maecenas ultricies</a></h4>
                                            <p>	March 10, 2015</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-wrapper d-flex">
                                        <div class="thumb">
                                            <a href="blog-details.html"><img src="images/blog/sm-img/5.jpg" alt="blog images"></a>
                                        </div>
                                        <div class="content">
                                            <h4><a href="blog-details.html">Blog image post</a></h4>
                                            <p>	March 10, 2015</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </aside>
                    <!-- End Single Widget -->
                    <!-- Start Single Widget -->
                    <aside class="widget comment_widget">
                        <h3 class="widget-title">Comments</h3>
                        <ul>
                            <li>
                                <div class="post-wrapper">
                                    <div class="thumb">
                                        <img src="images/blog/comment/1.jpeg" alt="Comment images">
                                    </div>
                                    <div class="content">
                                        <p>demo says:</p>
                                        <a href="#">Quisque semper nunc vitae...</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post-wrapper">
                                    <div class="thumb">
                                        <img src="images/blog/comment/1.jpeg" alt="Comment images">
                                    </div>
                                    <div class="content">
                                        <p>Admin says:</p>
                                        <a href="#">Curabitur aliquet pulvinar...</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post-wrapper">
                                    <div class="thumb">
                                        <img src="images/blog/comment/1.jpeg" alt="Comment images">
                                    </div>
                                    <div class="content">
                                        <p>Irin says:</p>
                                        <a href="#">Quisque semper nunc vitae...</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post-wrapper">
                                    <div class="thumb">
                                        <img src="images/blog/comment/1.jpeg" alt="Comment images">
                                    </div>
                                    <div class="content">
                                        <p>Boighor says:</p>
                                        <a href="#">Quisque semper nunc vitae...</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post-wrapper">
                                    <div class="thumb">
                                        <img src="images/blog/comment/1.jpeg" alt="Comment images">
                                    </div>
                                    <div class="content">
                                        <p>demo says:</p>
                                        <a href="#">Quisque semper nunc vitae...</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </aside>
                    <!-- End Single Widget -->
                    <!-- Start Single Widget -->
                    <aside class="widget category_widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Creative</a></li>
                            <li><a href="#">Electronics</a></li>
                            <li><a href="#">Kids</a></li>
                            <li><a href="#">Flower</a></li>
                            <li><a href="#">Books</a></li>
                            <li><a href="#">Jewelle</a></li>
                        </ul>
                    </aside>
                    <!-- End Single Widget -->
                    <!-- Start Single Widget -->
                    <aside class="widget archives_widget">
                        <h3 class="widget-title">Archives</h3>
                        <ul>
                            <li><a href="#">March 2015</a></li>
                            <li><a href="#">December 2014</a></li>
                            <li><a href="#">November 2014</a></li>
                            <li><a href="#">September 2014</a></li>
                            <li><a href="#">August 2014</a></li>
                        </ul>
                    </aside>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
