<?php

namespace App\Http\Controllers\Frontend\MainPage;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function index(  Request $request , $username){

        $author = User::whereStatus(1)->whereUsername($username)->orWhere('id', $username)->get()->first();

        if(is_null($author)){
           abort(404);
        }
        if( $author->id == Auth::id()){
            return redirect()->route('user.dashboard');
        }

        $search = isset($request->search)? $request->search:null;


        // return $category;
        $posts = Post::with(['category', 'user','media'])
        ->where( function($quere) use($search){
            $quere->when($search, function($query) use($search){
               return    $query->where('title' , 'like' , '%'.$search.'%')
                               ->orWhere('body' , 'like' , '%'.$search.'%');
           });
        })
        ->whereUserId($author->id)
        ->whereHas('user', function($q){
            return  $q->whereStatus(1);
         })
         ->wherePostType('post')
         ->latest()->paginate(5);
         return view('frontend.page.author' ,compact('posts' , 'author'));


    }
}
