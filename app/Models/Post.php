<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Scopes\PostScope;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use  HasFactory ,Sluggable , SearchableTrait;

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
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function approved_comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->whereStatus(1);
    }
    public function media()
    {
        return $this->hasMany(Post_Media::class, 'post_id', 'id');
    }


    protected static function booted(){
        static::addGlobalScope(new PostScope);
    }



    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'posts.title' => 10,
            'posts.body' => 9,
        ],

    ];


}
