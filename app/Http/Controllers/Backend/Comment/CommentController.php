<?php

namespace App\Http\Controllers\Backend\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:comments-read'])->only(['index']);
        $this->middleware(['permission:comments-update'])->only(['update','edit']);
        $this->middleware(['permission:comments-delete'])->only(['destroy']);

    }

    public function index(Request $request)
    {
        $search = $request->search?? null;
        $post_id =  isset($request->post_id ) && filter_var($request->post_id , FILTER_VALIDATE_INT)? $request->post_id:  null;
        $user_id =  isset($request->user_id ) && filter_var($request->user_id , FILTER_VALIDATE_INT)? $request->user_id:  null;
        $sorted_by = isset($request-> sorted_by )&& ( $request-> sorted_by=='created_at' ||$request-> sorted_by=='title' )?$request->sorted_by :'created_at';
        $order_by = isset($request->order_by )&& ( $request->order_by=='desc' ||$request->order_by=='asc' )?$request->order_by :'desc';
        $limit = isset($request->limit ) && filter_var($request->limit , FILTER_VALIDATE_INT)? $request->limit:5;
        if($limit> 500){
            $limit= 500;
        }


        $comments = Comment::with(['user','post'])
                 ->whereHas('post')
                 ->where( function($q) use( $search){
                    return $q->when(  $search , function($q)use( $search){
                        return  $q->where('comment' ,'like', '%'.$search .'%');
                    });
                 })
                 ->where( function($q) use( $user_id){
                    return $q->when(  $user_id , function($q)use( $user_id){
                        return  $q->where('user_id' ,$user_id );
                    });
                 })
                 ->where( function($q) use( $post_id){

                    return $q->when( $post_id , function($q)use($post_id ){
                        return  $q->where('post_id' , $post_id);

                    });
                 })
                 ->orderBy($sorted_by , $order_by)->paginate($limit);

        return view('backend.comment.index' , compact('comments'));
    }




    public function edit(Comment $comment)
    {

        return view('backend.comment.edit' , compact('comment'));

    }


    public function update(Request $request, Comment $comment)
    {
        $validator = Validator::make($request->all(), [

            'comment'=>['required','min:2',],
            'status'=>['required',],
        ]);

        if( $validator->fails()){
            return $this->sendResponse([],'please validate comment');
        }

        $comment->comment = $request->comment;
        $comment->status = $request->status;
        $comment->save();

        return $this->sendResponse([], 'comment updated successfully');
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();

        return $this->sendResponse([], 'comment deleted successfully');
    }
}
