<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data )
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string',  'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric',  'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'user_image'=>['nullable','image','max:20000','mimes:jpg,jpeg,png'],
            'agree-term'=>['required']
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data ,$request)
    {
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // if($request->hasFile('user_image')){

        //     if($image =$request->file('user_image')){
        //         $fileName = Str::slug($data['username']).'.'.$image->getClientOriginalExtension();
        //         $path = 'uploads/users_images/'.$fileName;

        //         Image::make($image)->resize(300, 300, function ($constraint) {
        //             $constraint->aspectRatio();
        //         })->save($path,100);
        //         $user->user_image= $fileName;
        //         $user->save();
        //     }
        // }
        return    $user ;
    }

    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

}
