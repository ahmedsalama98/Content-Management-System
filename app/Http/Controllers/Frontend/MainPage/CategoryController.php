<?php

namespace App\Http\Controllers\Frontend\MainPage;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{


    public function index( Request $request , $slug){

        $search = isset($request->search)? $request->search:null;

        $category = Category::whereStatus(1)->whereSlug($slug)->orWhere('id', $slug )->get()->first();

        if(is_null($category)){
            abort(404);
         }
        // return $category;
        $posts = Post::with(['category', 'user','media'])
        ->where( function($quere) use($search){
            $quere->when($search, function($query) use($search){
               return    $query->where('title' , 'like' , '%'.$search.'%')
                               ->orWhere('body' , 'like' , '%'.$search.'%');
           });
        })
        ->whereCategoryId($category->id)
        ->whereHas('user', function($q){
            return  $q->whereStatus(1);
         })
         ->wherePostType('post')


         ->latest()->paginate(5);


        return view('frontend.page.category' ,compact('posts' , 'category'));


    }


}
