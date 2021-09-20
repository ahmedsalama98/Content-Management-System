<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:admins-read'])->only(['index']);
        $this->middleware(['permission:admins-create'])->only(['create','store']);
        $this->middleware(['permission:admins-update'])->only(['update','edit']);
        $this->middleware(['permission:admins-delete'])->only(['destroy']);

    }
    public function index(Request $request)
    {
        $search = $request->search?? null;
        $sorted_by = isset($request-> sorted_by )&& ( $request-> sorted_by=='created_at' ||$request-> sorted_by=='title' )?$request->sorted_by :'created_at';
        $order_by = isset($request->order_by )&& ( $request->order_by=='desc' ||$request->order_by=='asc' )?$request->order_by :'desc';
        $limit = isset($request->limit ) && filter_var($request->limit , FILTER_VALIDATE_INT)? $request->limit:5;
        if($limit> 500){
            $limit= 500;
        }


        $admins = User::whereRoleIs('admin')
                 ->where( function($q) use( $search){
                    return $q->when(  $search , function($q)use( $search){
                        return  $q->where('name' ,'like', '%'.$search .'%')
                                  ->orWhere('username' ,'like', '%'.$search .'%')
                                  ->orWhere('email' ,'like', '%'.$search .'%')
                                  ->orWhere('mobile' ,'like', '%'.$search .'%');
                    });
                 })
                 ->orderBy($sorted_by , $order_by)->paginate($limit);

        return view('backend.admin.index' , compact('admins'));
    }


    public function create()
    {
        return view('backend.admin.create' );

    }

    public function store(Request $request)

    {

        $validator = Validator::make($request->all(),[
            'name'=>['required', 'min:2'],
            'username'=>['required', 'min:4','unique:users'],
            'email'=>['required', 'email','unique:users'],
            'mobile'=>['nullable', 'min:4','unique:users'],
            'password'=>['required', 'min:4','same:password_confirmation'],
            'permissions'=>['required']

        ]);



        if( $validator->fails()){
            return  $this->sendErrors($validator->errors()->toArray(), 'please validate inputs');
        }

        $data =[
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'password'=>Hash::make($request->password),
            'status'=>1,
            'receive_email'=>Carbon::now(),
        ];

        $user = User::create($data);
        $user->attachRole('admin');
        $user->attachPermissions($request->permissions);
        return $this->sendResponse([],'Admin addedd successfully');
    }


    public function edit($id)
    {
        $admin =User::whereRoleIs('admin')->findOrFail($id);

        return view('backend.admin.edit' , compact('admin'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $user =User::whereRoleIs('admin')->findOrFail($id);


        $validator = Validator::make($request->all(),[
            'name'=>['required', 'min:2'],
            'username'=>['required', 'min:4', Rule::unique('users')->ignore($user->id)],
            'email'=>['required', 'email',Rule::unique('users')->ignore($user->id)],
            'mobile'=>['nullable', 'min:4',Rule::unique('users')->ignore($user->id)],
            'password'=>['nullable', 'min:4','same:password_confirmation'],
            'permissions'=>['required']

        ]);



        if( $validator->fails()){
            return  $this->sendErrors($validator->errors()->toArray(), 'please validate inputs');
        }

        $data =[
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
        ];
        if($request->input('password')){
            $data['password']= Hash::make($request->password);
        }

        $user->update($data);
        $user->syncPermissions($request->permissions);
        return $this->sendResponse([],'Admin updated successfully');
    }

    public function destroy( $id)
    {
        $user =User::whereRoleIs('admin')->findOrFail($id);

        if(!is_null($user->user_image)){

            if( File::exists(public_path('uploads/users_images/'. $user->user_image))){

                Storage::disk('public_uploads')->delete('users_images/'. $user->user_image);
            }
        }

        $user->delete();
        return $this->sendResponse([],'Admin Deleted successfully');
    }
}
