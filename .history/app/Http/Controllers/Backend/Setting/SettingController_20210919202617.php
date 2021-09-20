<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

    public function index()
    {


        $general = Setting::whereSection('general')->get();
        $social_accounts = Setting::whereSection('social_accounts')->get();


        // return $general;
        return view('backend.setting.index' , compact('social_accounts','general'));

    }




    public function update(Request $request)
    {



       $validator =Validator::make($request->all(),[
           'settings'=>['required', 'array']
       ]);


       if($validator->fails()){
           return $this->sendErrors([], 'something wrong');
       }

       foreach ( $request->settings as $key => $value){

            if( isset($value)){

                $item = Setting::whereKey($key)->get();

                return $item;

            }


       }

    }


}
