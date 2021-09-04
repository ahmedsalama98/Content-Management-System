<?php

namespace App\Http\Controllers\Frontend\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function show($slug){


        $post = Post::with(['category', 'user','media',
        'approved_comments'=>function($q){
            return $q->with('user')->orderBy('created_at', 'desc');
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

    //end show


}
