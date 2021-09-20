<?php

namespace App\Http\Controllers\Backend\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:posts-read'])->only(['index']);
        // $this->middleware(['permission:posts-create'])->only(['create','store']);
        $this->middleware(['permission:posts-update'])->only(['update','edit']);
        $this->middleware(['permission:posts-delete'])->only(['destroy']);

    }

    public function index(Request $request)
    {

        $search = $request->search?? null;
        $category_id = $request->category_id??null;
        $user_id =  isset($request->user_id ) && filter_var($request->user_id , FILTER_VALIDATE_INT)? $request->user_id:  null;
        $sorted_by = isset($request-> sorted_by )&& ( $request-> sorted_by=='created_at' ||$request-> sorted_by=='title' )?$request->sorted_by :'created_at';
        $order_by = isset($request->order_by )&& ( $request->order_by=='desc' ||$request->order_by=='asc' )?$request->order_by :'desc';
        $limit = isset($request->limit ) && filter_var($request->limit , FILTER_VALIDATE_INT)? $request->limit:5;
        if($limit> 500){
            $limit= 500;
        }


        $posts = Post::with(['user','category'])
                 ->whereHas('category')->whereHas('user')
                 ->withCount('comments')
                 ->where( function($q) use( $search){

                    return $q->when(  $search , function($q)use( $search){
                        return  $q->where('title' ,'like', '%'.$search .'%')
                               ->orWhere('body' ,'like', '%'.$search .'%');
                    });
                 })
                 ->where( function($q) use( $user_id){
                    return $q->when(  $user_id , function($q)use( $user_id){
                        return  $q->where('user_id' ,$user_id );
                    });
                 })
                 ->where( function($q) use( $category_id){

                    return $q->when( $category_id , function($q)use($category_id ){
                        return  $q->where('category_id' , $category_id);

                    });
                 })
                 ->orderBy($sorted_by , $order_by)->paginate($limit);

        return view('backend.post.index' , compact('posts'));
    }


    public function edit($id)
    {
       $post = Post::with('media')->findOrFail($id);
        return view('backend.post.edit' , compact('post'));
    }


    public function update(Request $request, $id)
    {
        $post = Post::with('media')->findOrFail($id);


        $validator = Validator::make($request->all(),[
            'title'=>['required','min:3'],
            'post'=>['required','min:3'],
            'status'=>['required',],
            'comment_able'=>['required',],
            'category'=>['required',],
            'images.*' =>['nullable', 'image','mimes:png,jpeg,jpg','max:2048'],
        ]);
        //send error response if validaton fails

        if($validator->fails()){
            $message = 'please validate your post';
            return $this->sendErrors($validator->errors()->toArray() , $message);
        }
        //check image extention is valid
        $allowedExtensions =['png','jpeg','jpg'];
        if( $request->hasFile('images')){

            foreach($request->file('images') as $index=> $image){
                $imagExtention = $image->getClientOriginalExtension();
                $checkAllowedExtntion = in_array($imagExtention , $allowedExtensions);
                if(!$checkAllowedExtntion){
                    $message = 'please choose valid image Extntion ...';
                    return $this->sendErrors([] , $message);
                }
            }
        }
        $data =[
            'title'=>Purify::clean($request->title),
            'body'=>Purify::clean( $request->post)  ,
            'status'=>$request->status,
            'comment_able'=>$request->comment_able,
            'category_id'=>$request->category,
        ];



        //update post
        $post->update($data);

        //store the post media
        if( $request->hasFile('images')){

            $this->deleteMedia($post->media);


            foreach($request->file('images') as $index=> $image){
                $imageName = $post->slug . time().$index+1 .'.' . $image->getClientOriginalExtension();
                $path = 'uploads/posts_media/'.$imageName;
                Image::make($image)->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
                })->save($path,100);
                $post->media()->create([
                    'file_name'=>$imageName,
                    'file_size'=>$image->getSize(),
                    'file_type'=>$image->getClientOriginalExtension(),
                ]);
            }
        }
        //send succes response
    $message ='Post updated Successfully';

    return $this->sendResponse([], $message);

    }




    public function destroy($id)
    {
        $post = Post::with('media')->findOrFail($id);

        if( $post->media->count()> 0){
            $this->deleteMedia($post->media);
        }

        $post->delete();


        return $this->sendResponse([],'Post Deleted SuccessFully');

    }



    protected function deleteMedia( $all_media ){
        foreach($all_media as $media){
            if(File::exists(public_path($media->image_path))){
                Storage::disk('public_uploads')->delete('posts_media/'. $media->file_name);
            }
            $media->delete();
        }
    }




}
