<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'author', 'content'];
    
    public function post()
    {
        return $this->hasOne(Post::class);
    }
    
    public function author()
    {
        return $this->hasOne(User::class);
    }
    
    public function getDate()
    {
        return $this->created_at->format('F d, Y H:i');
    }
}
