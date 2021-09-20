<?php

namespace App\Http\Controllers\Backend\IndexPage;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminIndexPageController extends Controller
{



    public function __construct()
    {
    }
    public function index()
    {


        $all_users = User::whereRoleIs('user')->get()->count();
        $active_posts = Post::whereStatus(1)->get()->count();
        $inactive_posts = Post::whereStatus(0)->get()->count();
        $active_comments = Comment::whereStatus(1)->get()->count();
        return view('backend.indexpage.index' ,compact('all_users','active_posts','inactive_posts','active_comments') );
    }

}
