<div class="wn__sidebar">
    <!-- Start Single Widget -->

    @php
        $search_route = Request::url();

        $serch_placeholder = 'Search in all posts ...';

        if(Route::is('category.show')){
            $serch_placeholder = 'Search in '. $category->title.  ' posts ...';
        }
        elseif( Route::is('author.show')){
            $serch_placeholder = 'Search in '. $author->name.  ' posts ...';
        }
        elseif( Route::is('archieve.show')){
            $serch_placeholder = 'Search in '. date('F Y' , mktime(0,0,0,$month ,1, $year)) .  ' posts ...';
        }


    @endphp
    <aside class="widget search_widget">
        <h3 class="widget-title">Search</h3>

        <form action="{{ $search_route }}">
            <div class="form-input">
                <input type="text" name="search" placeholder="{{ $serch_placeholder }}" value="{{ request()->search }}">
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


                    @forelse ($recent_posts as $post )
                    <div class="post-wrapper  d-flex " >

                     @php
                         $file_name = $post->media->count() > 0 ?$post->media->first()->file_name : 'default.small.png';
                     @endphp
                        <div class="thumb">
                            <a  href="{{ route('post.show' , $post->slug) }}"><img   src="{{ asset('uploads/posts_media/'.$file_name)    }}" alt="blog images"></a>
                        </div>
                        <div class="content">
                            <h4><a href="{{ route('post.show' , $post->slug) }}">{{ Str::limit($post->title , 20 ,'...') }}</a></h4>
                            <p>{{ $post->created_at->format('M d , Y') }}</p>
                        </div>
                    </div>
                    @empty

                    @endforelse


            </ul>
        </div>
    </aside>
    <!-- End Single Widget -->
    <!-- Start Single Widget -->
    <aside class="widget comment_widget">
        <h3 class="widget-title">Comments</h3>
        <ul>

            @forelse ($recent_comments as $comment )
            <li>
                <div class="post-wrapper">
                    <div class="thumb">

                        @php
                        $comment_profile_image = isset($comment->user)? asset($comment->user->image_path) : asset('uploads/users_images/default.png');
                    @endphp
                    <img  class="avatar " src="{{ $comment_profile_image}}" alt="comment images">                    </div>
                    <div class="content">
                        <p>{{ $comment->name }} says:</p>
                        <a href="{{ route('post.show',$comment->post->slug ) }}">{{ Str::limit($comment->comment , 15, '...') }}</a>
                    </div>
                </div>
            </li>
            @empty

            @endforelse

        </ul>
    </aside>
    <!-- End Single Widget -->
    <!-- Start Single Widget -->
    <aside class="widget category_widget">
        <h3 class="widget-title">Categories</h3>
        <ul>

            @forelse ($global_categories as $category )
            <li><a href="{{ route('category.show' , $category->slug)}}">{{ $category->title }}</a></li>
            @empty

            @endforelse

        </ul>
    </aside>
    <!-- End Single Widget -->
    <!-- Start Single Widget -->
    <aside class="widget archives_widget">
        <h3 class="widget-title">Archives</h3>
        <ul>
            @forelse ($global_archieve as $key=>$value )
                <li><a href="{{ route('archieve.show' , $key. '-'. $value) }}">{{ date('F ' , mktime( 0,0,0 ,$key,1)) }}  {{ '  ' }} {{ $value }}</a></li>
            @empty

            @endforelse
        </ul>
    </aside>
    <!-- End Single Widget -->
</div>
