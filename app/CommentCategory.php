<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommentCategory extends Model
{
    protected $fillable = ['category_id', 'author', 'content'];
    
    public function category() {
        return $this->hasOne(Category::class);
    }
    
    public static function add($attributes) 
    {
        $comment = new static;
        $comment->fill($attributes);
        $comment->category_id = $attributes['category'];
        if(Auth::check())
        {
            $comment->user_id = Auth::user()->id;
            $comment->author = Auth::user()->name;
        }
        $comment->save();
        
        return $comment;
    }
    
    public function getDate() {
        return $this->created_at->format('F d, Y H:i');
    }
}
