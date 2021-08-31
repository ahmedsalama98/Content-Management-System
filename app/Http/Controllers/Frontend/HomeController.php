<?php

namespace App\Http\Controllers\Frontend;



use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        // $this->middleware('auth');
    }


    public function index()

    {




        $posts = Post::with(['category', 'user','media'])
        ->whereHas('category', function($q){
           return  $q->whereStatus(1);
        })
        ->whereHas('user', function($q){
            return  $q->whereStatus(1);
         })
         ->wherePostType('post')
         ->latest()->paginate(5);
        return view('frontend.index' ,compact('posts'));
    }

    //end index

    public function postShow($slug){


        $post = Post::with(['category', 'user','media',
        'comments'=>function($q){
            return $q->orderBy('created_at', 'desc');
        }])
        ->whereHas('category', function($q){
           return  $q->whereStatus(1);
        })
        ->whereHas('user', function($q){
            return  $q->whereStatus(1);
         })
         ->whereSlug($slug)
         ->wherePostType('post')->get()->first();

         if(is_null($post)){
            return redirect()->route('home')->withErrors(['product'=>'product not found']);
         }



         return view('frontend.post.index', compact('post'));

    }
}
