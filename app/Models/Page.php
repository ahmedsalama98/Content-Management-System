<?php

namespace App\Models;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Scopes\PageScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];
    protected $table ='posts';

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





    protected static function booted()
    {
        static::addGlobalScope(new PageScope);

    }
}
