<?php

namespace App\Http\Controllers\Frontend\MainPage;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class HomeController extends Controller
{
    public function index(Request $request)

    {

        $search = isset($request->search)? $request->search:null;
        $posts = Post::with(['category', 'user','media'])
        ->where(function($query) use($search){
            $query->when($search, function($query) use($search){
                return   $query->where('title' , 'like' , '%'.$search.'%')
                                ->orWhere('body' , 'like' , '%'.$search.'%');
        });
        })
        ->whereHas('category', function($q){
           return  $q->whereStatus(1);
        })
        ->whereHas('user', function($q){
            return  $q->whereStatus(1);
         })
         ->wherePostType('post')
         ->latest()->paginate(5);

        return view('frontend.page.home' ,compact('posts'));


    }
}
