@extends('layouts.frontend.master')

@php
$page_title = 'Home';

$page_description = ' Content management system Home Page';

if(Route::is('archieve.show') ){
    $page_title = 'Archieve';
    $page_description = ' Content management system Archieve for '. $month . '-'.$year;


}
@endphp
@section('title')
{{ $page_title }}
@endsection

@section('description')
{{ $page_description}}
@endsection


@section('content')
<!-- Start Blog Area -->
<div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="blog-page">
                    <div class="page__header">
                        <h2>
                            @if (Route::is('archieve.show'))
                            {{ date('F Y' , mktime(0,0,0,$month ,1, $year)) }}  Posts
                            @else

                            All  Posts
                            @endif
                        </h2>
                    </div>
                    {{--  start posts  --}}
                    @forelse ( $posts as  $post)
                        <article class="blog__post d-flex flex-wrap">
                            <div class="thumb">
                                <a href="{{ route('post.show', $post->slug) }}"  >

                                    @if ($post->media->count())
                                    <img src="{{ asset('uploads/posts_media/'.$post->media->first()->file_name) }}" alt="blog images">
                                    @else
                                    <img  src="{{ asset('uploads/posts_media/default.png') }}" alt="blog images">
                                    @endif
                                </a>
                            </div>
                            <div class="content">
                                <h4><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h4>
                                <ul class="post__meta">
                                    <li>Posts by : <a href="{{ route('author.show' ,$post->user->username)}}">{{ $post->user->name}}</a></li>
                                    <li class="post_separator">/</li>
                                    <li>{{ $post->created_at->format('M d , Y') }}</li>
                                </ul>
                                <p> {!! Str::limit($post->body , 150 , '...') !!}</p>
                                <div class="blog__btn">
                                    <a href="{{ route('post.show', $post->slug) }}">read more</a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div> No posts Found</div>
                    @endforelse


                    {{--   end posts  --}}
                    <!-- Start Single Post -->
                    {{--  <article class="blog__post text--post">
                        <div class="content">
                            <h4><a href="blog-details.html">Blog image post</a></h4>
                            <ul class="post__meta">
                                <li>Posts by : <a href="#">road theme</a></li>
                                <li class="post_separator">/</li>
                                <li>Mar 10 2018</li>
                            </ul>
                            <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Crastoup pretium arcu ex. Aenean posuere libero eu augue rhoncus Praesent ornare tortor amet.</p>
                            <div class="blog__btn">
                                <a href="blog-details.html">read more</a>
                            </div>
                        </div>
                    </article>  --}}
                    <!-- End Single Post -->

                </div>
                {{--  <ul class="wn__pagination">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                </ul>  --}}

                {!! $posts->appends(request()->input())->onEachSide(1)-> links() !!}
            </div>
            <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">

                @include('layouts.frontend._sidebar')
            </div>
        </div>
    </div>
</div>
<!-- End Blog Area -->
@endsection
