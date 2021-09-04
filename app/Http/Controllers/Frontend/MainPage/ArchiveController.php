<?php

namespace App\Http\Controllers\Frontend\MainPage;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchiveController extends Controller
{
    public function index(Request $request , $date){

       $exploded_date = explode('-' , $date);

       $search = isset($request->search)? $request->search:null;

       $month = $exploded_date[0];
       $year = $exploded_date[1];
        $posts = Post::with(['category', 'user','media'])
        ->where( function($quere) use($search){
            $quere->when($search, function($query) use($search){
               return    $query->where('title' , 'like' , '%'.$search.'%')
                               ->orWhere('body' , 'like' , '%'.$search.'%');
           });
        })
        ->whereHas('category', function($q){
           return  $q->whereStatus(1);
        })
        ->whereHas('user', function($q){
            return  $q->whereStatus(1);
         })
        ->whereMonth( 'created_at','=',$month)
        ->whereYear('created_at','=',$year)

         ->wherePostType('post')
         ->latest()->paginate(5);

        return view('frontend.page.home' ,compact('posts' , 'month', 'year'));

    }

}
