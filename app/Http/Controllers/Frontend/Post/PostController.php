<?php

namespace App\Http\Controllers\Frontend\Post;

use App\Models\Post;
use App\Models\Category;
use App\Models\Post_Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller

{


   public  $view_path ='frontend.post.';
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }
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

         if( is_null($post)){
             return abort(404);
         }
         return view($this->view_path.'index', compact('post'));

    }

    //end show
    public function create(){
        $categories = Category::select(['id', 'title'])->whereStatus(1)->get();
        return view($this->view_path. 'create'  , compact('categories'));
    }

    public function store(Request $request){

        //post validation
        $validator = Validator::make($request->all(),[
            'title'=>['required','min:3'],
            'post'=>['required','min:3'],
            'status'=>['required',],
            'comment_able'=>['required',],
            'category'=>['required',],
            'images.*' =>['nullable', 'image','mimes:png,jpeg,jpg','max:2048'],
        ]);
        //send error response if validator fails

        if($validator->fails()){
            $message = 'please validate your post';
            return $this->sendErrors($validator->errors()->toArray() , $message);
        }
        //check image extension is valid
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



        //create new post
        $post = Auth::user()->posts()->create($data);

        Cache::forget('recent_posts');
        //store the post media
        if( $request->hasFile('images')){
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
        $message ='Post added Successfully';

        return $this->sendResponse([], $message);
    }

    public function edit(Post $post ){

        $this->authorizeAction( $post->user_id);
        $categories = Category::select(['id', 'title'])->whereStatus(1)->get();
        $post_media = $post->media;

        return view($this->view_path. 'edit'  , compact('categories' , 'post' , 'post_media'));
    }

    public function update(Post $post , Request $request){


            //post validation
            $this->authorizeAction( $post->user_id);
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



            //create new post
            $post->update($data);

            //store the post media
            if( $request->hasFile('images')){

                foreach($post->media as $media){
                    if(File::exists(public_path($media->image_path))){
                        Storage::disk('public_uploads')->delete('posts_media/'. $media->file_name);
                    }
                    $media->delete();
                }

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


    public function destroy(Post $post , Request $request){

        $this->authorizeAction( $post->user_id);
        $postMedia =$post->media;

        if($postMedia ->count() > 0){

            foreach($postMedia as $media){
                if(File::exists(public_path($media->image_path))){
                    Storage::disk('public_uploads')->delete('posts_media/'. $media->file_name);
                }
            }
        }

        $post->delete();



        if(  $request->input('_from_post_page') && $request->input('_from_post_page') == 'true'){
            return redirect()->back()->with(['success'=>'post deleted successFully']);
        }
        return $this->sendResponse([],'post deleted successFully');
    }



    protected function authorizeAction($post_user_id){

        if( Auth::id() != $post_user_id){
            return abort(403);
        }
    }
}
