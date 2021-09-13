<?php

namespace App\Http\Controllers\Backend\IndexPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminIndexPageController extends Controller
{



    public function __construct()
    {
    }
    public function index()
    {

        return view('backend.indexpage.index');
    }

}
