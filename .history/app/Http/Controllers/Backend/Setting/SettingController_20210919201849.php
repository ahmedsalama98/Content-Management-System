<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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

        return $request->all();

        if( )

    }


}
