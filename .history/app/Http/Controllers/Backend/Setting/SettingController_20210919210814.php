<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Valuestore\Valuestore;

class SettingController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:settings-read'])->only(['index']);
        $this->middleware(['permission:settings-update'])->only(['update']);

    }
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

       $settings = Valuestore::make(config_path('settings.json'));
       foreach ( $request->settings as $key => $value){

            if( isset($value)){

                $item = Setting::where('key'  ,$key)->get()->first();

                if(isset($item)){
                    $item->update([
                        'value'=>$value
                    ]);

                    $settings->put($key , $value);


                }

            }



       }

       return $this->sendResponse([], 'settings Updated Success fully');
       //end foreach

    }
    //end update


}
