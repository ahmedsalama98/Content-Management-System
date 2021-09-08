<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function dashboard(Request $request){


        $posts = Auth::user()->posts()->with(['category', 'media'])->latest()->paginate(5);
        return view('frontend.user.dashboard', compact('posts'));
    }

}
