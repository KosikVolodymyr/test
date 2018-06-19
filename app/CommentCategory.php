<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentCategory extends Model
{
    protected $fillable = ['category_id', 'author', 'content'];
    
    public function category()
    {
        return $this->hasOne(Category::class);
    }
    
    public function getDate() {
        return $this->created_at->format('F d, Y H:i');
    }
}
