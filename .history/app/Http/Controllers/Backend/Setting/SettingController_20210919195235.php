<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {



        return view('backend.setting.index');

    }




    public function update(Request $request)
    {
        //
    }


}
