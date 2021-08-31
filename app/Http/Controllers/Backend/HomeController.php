<?php

namespace App\Http\Controllers\Backend;


use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {

        // $test = Category::with(['posts'=>function($q){
        //     return $q->with(['comments','user']);
        // }])->get();
        // return $test;
        return view('home');
    }
}
