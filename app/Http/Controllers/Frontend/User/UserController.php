<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function dashboard(Request $request){


        $posts = Auth::user()->posts()->with(['category', 'media'])->latest()->paginate(5);
        return view('frontend.user.dashboard', compact('posts'));
    }

    public function updateInformationShow()
    {

        return view('frontend.user.update-info');

    }

    public function updateInformationStore(Request $request)
    {



         $validator =    Validator::make($request->all(), [

            'name'=>['required','string','min:2'],
            'email'=>['required','email', Rule::unique('users')->ignore(Auth::id()),],
            'mobile'=>['nullable' , 'min:8'],
            'receive_email'=>['nullable'],
            'bio'=>['nullable' , 'min:2'],
            'profile-image'=>['nullable' , 'image' , 'mimes:jpg,png,jpeg'],
         ]);


         if( $validator->fails()){
             return $this->sendErrors($validator->errors()->toArray() , 'please send valid information');
         }

         $user =Auth::user();

         $data =[
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'receive_email'=>$request->receive_email,
            'bio'=>$request->bio,
         ];

         if( $request->hasFile('profile-image')){

            if( ! is_null($user->user_image)){
                if( File::exists($user->image_path)){
                    Storage::disk('public_uploads')->delete('users_images/' .$user->user_image);
                }
            }
            $image = $request->file('profile-image');
            $imageName = Str::slug( $user->username). '.' .$image->getClientOriginalExtension();
            $path = 'uploads/users_images/' .$imageName ;
            Image::make($image->getRealPath())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                })->save($path,100);
                $data['user_image'] =$imageName ;

         }

          $user->update($data);




        return $this->sendResponse([], 'Information updated successfully');


    }

    public function updatePasswordShow(Request $request)
    {

        return view('frontend.user.update-password');

    }

    public function updatePasswordStore(Request $request)
    {
        $validator =    Validator::make($request->all(), [
            'old-password'=>['required','string','min:8'],
            'new-password'=>['required','string','min:8' , 'same:new-password-confirmation'],
         ]);


         if( $validator->fails()){
             return $this->sendErrors($validator->errors()->toArray() , 'please send valid password');
         }

         $user =Auth::user();

         if(Hash::check($request->input('old-password'), $user->password)){

            $user->password = Hash::make($request->input('new-password'));
            $user->save();

            return $this->sendResponse([], 'password updated successfully');
         }else{
            return $this->sendErrors([] , 'the old password not true');
         }


    }

}
