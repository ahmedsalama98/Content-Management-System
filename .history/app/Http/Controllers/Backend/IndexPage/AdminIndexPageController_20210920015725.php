<?php

namespace App\Http\Controllers\Backend\IndexPage;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

        $last_posts =Post::whereHas('user')->whereHas('category')
        ->with('user')
        ->withCount('comments')
        ->latest()
        ->limit(5)->get();


        $last_comments =Comment::whereHas('post')
        ->with(['post'])
        ->limit(5)
        ->latest()
        ->get();


        $posts_chart = Post::select(DB::raw('COUNT(*) AS count'),DB::raw('MONTHNAME(created_at) AS month'), DB::raw('YEAR(created_at) AS year'),)
                            ->groupBy('month')->get();


        $posts_chart_labels =[];
        $posts_chart_data =[];

        foreach($posts_chart as $chart){

            $item =  $chart->month .' ' . $chart->year;
            $posts_chart_labels[]=$item;
            $posts_chart_data[]=$chart->count;

        }

                            return $posts_chart_data;

        return view('backend.indexpage.index' ,compact('all_users','active_posts','inactive_posts','active_comments','last_posts','last_comments') );
    }

}
