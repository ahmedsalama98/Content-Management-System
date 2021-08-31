<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->whereStatus(1);
    }
    public function media()
    {
        return $this->hasMany(Post_Media::class, 'post_id', 'id');
    }


}
