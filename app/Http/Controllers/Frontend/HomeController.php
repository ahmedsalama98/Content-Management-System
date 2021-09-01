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
        return view('frontend.home' ,compact('posts'));
    }

    //end index


}
