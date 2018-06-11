<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $fillable = ['post_id', 'author', 'content'];
    
    public function post() {
        return $this->hasOne(Post::class);
    }
    
    public function author() {
        return $this->hasOne(User::class);
    }
    
    public static function add($attributes) 
    {
        $comment = new static;
        $comment->fill($attributes);
        $comment->post_id = $attributes['post'];
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
