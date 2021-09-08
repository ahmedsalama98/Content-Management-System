<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post_Media extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table ='post_media';

    protected $appends=['image_path'];


    public function getImagePathAttribute(){

        $path ='uploads/posts_media/';
        return  $path . $this->file_name;
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id','id');
    }




}
