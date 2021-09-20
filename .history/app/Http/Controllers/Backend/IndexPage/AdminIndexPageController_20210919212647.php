<?php

namespace App\Http\Controllers\Backend\IndexPage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminIndexPageController extends Controller
{



    public function __construct()
    {
    }
    public function index()
    {


        $all_users = User::whereRoleIs('user')->get();
        return view('backend.indexpage.index');
    }

}
