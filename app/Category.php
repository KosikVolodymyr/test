<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Post;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use Sluggable;
    
    protected $fillable = ['name', 'description'];

    public function posts() {
        return $this->hasMany(Post::class);
    }
    
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function comments() {
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
    
    public static function add($attributes) 
    {
        $category = new static;
        $category->fill($attributes);
        $category->user_id = Auth::user()->id;
        $category->save();
        
        return $category;
    }

    public function getDate() {
        return $this->created_at->format('F d, Y');
    }
}
