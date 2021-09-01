<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    protected function sendRespone( array $data ,string $message ='Done'){
        $response =[
            'success'=> true,
            'message'=>$message,
            'data'=> $data
        ];
        return response()->json($response);
    }

    protected function sendErrors(  array $errors ,string $message = 'Error'){
        $response =[
            'success'=> false,
            'message'=>$message,
            'errors'=> $errors
        ];
        return response()->json($response);
    }


}
