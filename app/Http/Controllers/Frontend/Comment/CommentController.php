<?php

namespace App\Http\Controllers\Frontend\Comment;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{



    public function updat(){

    }

    public function store(Post $post , Request $request){
        $auth_check = Auth::check();
        if( $post->comment_able ==0){
            $reponse_message ='cant add comment in this post';
            return $this->sendErrors([], $reponse_message);
        }

        if($auth_check){
            $validator = Validator::make($request->all(), [
                'comment'=>['required', 'string'],
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'comment'=>['required', 'string'],
                'name'=>['required', 'string'],
                'email'=>['required', 'email'],
                'website'=>['nullable', 'string'],
            ]);

        }

        if( $validator->fails()){
            $reponse_message ='validate your comment Fields';
            return $this->sendErrors($validator->errors()->toArray(), $reponse_message);
        }

        $user_id =$auth_check ? Auth::id() : null;
        $url = $request->input('website')? $request->website:null;
        $name =$auth_check? Auth::user()->name :$request->name;
        $email =$auth_check? Auth::user()->email :$request->email;
        $comment_data = [
            'user_id'=>$user_id,
            'post_id'=>$post->id,
            'comment'=>$request->comment,
            'name'=>$name,
            'email'=>$email,
            'url'=>$url,
            'ip_address'=>$request->ip()
        ];
        $comment = $post->comments()->create($comment_data);


        $reponse_data =[];
        $reponse_message ='comment added succesfully , wiat for approved  ';
        return $this->sendRespone( $reponse_data, $reponse_message);
    }
}
