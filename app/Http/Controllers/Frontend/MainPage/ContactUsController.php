<?php

namespace App\Http\Controllers\Frontend\MainPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function index(){


        return view('frontend.page.contact-us');


    }

    public function store(Request $request){


        $validata = Validator::make($request->all(),[
            'name'=>['required', 'string', 'min:2'],
            'email'=>['required', 'email'],
            'mobile'=>['nullable',],
            'subject'=>['required', 'string', 'min:4'],
            'message'=>['required', 'string', 'min:8'],
        ]);

        if($validata->fails()){
            $errors= $validata->errors()->toArray();
            $message = 'please send valid message';
            return $this->sendErrors($errors, $message);
        }


        $mobile= $request->input('mobile')? $request->mobile : null;
        $data =[
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$mobile,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'ip'=>$request->ip(),
        ];
        Contact::create($data);


        return $this->sendResponse([], 'Messge Send SuccessFully');
    }
}
