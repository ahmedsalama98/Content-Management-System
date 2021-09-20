<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


// fronend view

if(!request()->is('admin/*')){
            Paginator::defaultView('vendor.pagination.custom');


        //recent posts cache handle
                if(!Cache::has('recent_posts')){

                    $recent_posts = Post::with(['category', 'user','media'])
                    ->whereHas('category', function($q){
                    return  $q->whereStatus(1);
                    })
                    ->whereHas('user', function($q){
                        return  $q->whereStatus(1);
                    })
                    ->wherePostType('post')
                    ->latest()->limit(5)->get();

                    Cache::remember('recent_posts', 3600, function ()use($recent_posts) {

                        return $recent_posts;
                    });

                }
        //recent comment cache handle

                if(!Cache::has('recent_comments')){

                    $recent_comments = Comment::with(['post', 'user'])
                    ->whereHas('post', function($q){
                        return  $q->whereStatus(1);
                    })
                    ->whereStatus(1)
                    ->latest()->limit(5)->get();

                    Cache::remember('recent_comments', 3600, function ()use($recent_comments) {

                        return $recent_comments;
                    });

                }

         //global categories cache handle

                if(!Cache::has('global_categories')){

                    $global_categories = Category::whereStatus(1)
                    ->latest()->get();
                    Cache::remember('global_categories', 3600, function ()use($global_categories) {
                        return $global_categories;
                    });

                }

         //global categories cache handle

                if( ! Cache::has('global_archieve')){
                    $global_archieve = Post::whereStatus(1)
                    ->latest()->select(
                        DB::raw('year(created_at) as year'),
                        DB::raw('month(created_at)as month'),
                    )->pluck('year', 'month')->toArray();
                    Cache::remember('global_archieve', 3600, function ()use($global_archieve) {
                        return $global_archieve;
                    });

                }



                $recent_posts = Cache::get('recent_posts');
                $recent_comments = Cache::get('recent_comments');
                $global_categories = Cache::get('global_categories');
                $global_archieve = Cache::get('global_archieve');






       //path cache ito view
                view()->composer('*' , function($view) use($recent_posts ,$recent_comments ,$global_categories ,$global_archieve){
                    return $view->with([
                        'recent_posts'=>$recent_posts,
                        'recent_comments'=>$recent_comments,
                        'global_categories'=>$global_categories,
                        'global_archieve'=>$global_archieve,
                    ]);
                });


}
//end fronend view





    }
}
