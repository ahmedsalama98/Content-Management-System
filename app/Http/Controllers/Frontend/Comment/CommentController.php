<?php

namespace App\Http\Controllers\Frontend\Comment;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\postOwnerNewCommentNotify;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }

    public function store(Post $post , Request $request){
        $auth_check = Auth::check();
        if( $post->comment_able ==0){
            $response_message ='cant add comment in this post';
            return $this->sendErrors([], $response_message);
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
            $response_message ='validate your comment Fields';
            return $this->sendErrors($validator->errors()->toArray(), $response_message);
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
            'ip_address'=>$request->ip(),
            'status'=>1,
        ];
        $comment = $post->comments()->create($comment_data);

        $user = User::find($post->user_id)->first();
        //  Notification::sendNow($post->user , new postOwnerNewCommentNotify( $comment ));
       $post->user->notify(new postOwnerNewCommentNotify( $comment ) );
        $reponse_data = $comment->toArray();
        $reponse_message ='comment added succesfully , wiat for approved  ';
        return $this->sendResponse( $reponse_data, $reponse_message);
    }


    public function update(Request $request , Comment $comment){

        if( Auth::id() != $comment->user_id){
            return $this->sendErrors([], 'unauthorized');
        }
       $validator=  Validator::make($request->all() ,[
           'comment'=>['required', 'min:3'],
       ]);

       if( $validator->fails()){
        return $this->sendErrors($validator->errors()->toArray(), 'please validate your comment');
       }
       $comment->comment = $request->comment ;
       $comment->save();

       return $this->sendResponse([],'comment updated successfully');


    }

    public function destroy(Request $request , Comment $comment){

        $post_user_id = $comment ->post->user_id;
        if( Auth::id() != $comment->user_id && Auth::id() !=  $post_user_id){
            return $this->sendErrors([$post_user_id ,Auth::id()  ], 'unauthorized');
        }

       $comment->delete();

       return $this->sendResponse([ $post_user_id],'comment Deleted successfully');


    }

}
