<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();


        $comments =[];
        $users = collect(User::whereRoleIs('user')->whereStatus(1)->get());
        $posts= collect(Post::where('status', 1)->whereStatus(1)->whereCommentAble(1)->wherePostType('post')->get());

        for($i = 0 ; $i  <20000 ;$i++){
            $user =$users->random();
            $post =$posts->random();
            $parent_post_date = $post->created_at->timestamp;
            $now = Carbon::now()->timestamp;
            $comment_date = date('Y-m-d H:i:s', rand($parent_post_date, $now));
           $comments[]=[
            'comment'=>$faker->paragraph(2,true),
            'name'=>$faker->name,
            'email'=>$faker->email,
            'url'=>$faker->url,
            'ip_address'=>$faker->ipv4,
            'status'=>rand(0,1),
            'user_id'=>$user->id,
            'post_id'=>$post->id,
            'created_at'=>$comment_date,
            'updated_at'=>$comment_date,
           ];
        }


        $chunks = array_chunk($comments , 500);
        foreach($chunks as $chunk){
            Comment::insert($chunk);
        }
    }
}
