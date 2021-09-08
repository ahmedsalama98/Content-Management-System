<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    protected function sendResponse( array $data ,string $message ='Done' , int $status =200){
        $response =[
            'success'=> true,
            'message'=>$message,
            'data'=> $data
        ];
        return response()->json($response , $status);
    }

    protected function sendErrors(  array $errors ,string $message = 'Error' , int $status =404){
        $response =[
            'success'=> false,
            'message'=>$message,
            'errors'=> $errors
        ];
        return response()->json($response , $status);
    }


}
