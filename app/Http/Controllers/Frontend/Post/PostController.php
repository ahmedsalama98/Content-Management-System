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


        //  return ord('ب');
         return view('frontend.post.index', compact('post'));

    }

    //end show

    public function storeComment(Post $post , Request $request){
        $validator = Validator::make($request->all(), [
            'comment'=>['required', 'string'],
            'name'=>['required', 'string'],
            'email'=>['required', 'email'],
            'website'=>['nullable', 'string'],
        ]);

        if( $validator->fails()){
            $reponse_message ='validate your comment Fields';
            return $this->sendErrors($validator->errors()->toArray(), $reponse_message);
        }

        $user = Auth::check() ? Auth::id() : null;
        $url = $request->input('website')? $request->website:null;
        $comment_data = [
            'user_id'=>$user,
            'post_id'=>$post->id,
            'comment'=>$request->comment,
            'name'=>$request->name,
            'email'=>$request->email,
            'url'=>$url,
            'ip_address'=>$request->ip()
        ];
        $comment = $post->comments()->create($comment_data);


        $reponse_data =[];
        $reponse_message ='comment added succesfully , wiat for approved  ';
        return $this->sendRespone( $reponse_data, $reponse_message);
    }
}
