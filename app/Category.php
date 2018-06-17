<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Post;

class Category extends Model
{
    use Sluggable;
    
    protected $fillable = ['name', 'description'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function comments()
    {
        return $this->hasMany(CommentCategory::class)->orderBy('created_at', 'DESC');
    }
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getDate()
    {
        return $this->created_at->format('F d, Y');
    }
}
