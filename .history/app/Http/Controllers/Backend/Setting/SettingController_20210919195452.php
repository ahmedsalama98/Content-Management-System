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
        $social_media = Setting::whereSection('general')->get();


        return view('backend.setting.index');

    }




    public function update(Request $request)
    {
        //
    }


}
