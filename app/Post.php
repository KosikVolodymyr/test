<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    
    protected $fillable = ['category_id', 'name', 'description', 'content', 'file'];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
    public function remove()
    {
        if ($this->file) {
            Storage::delete('uploads/'.$this->file);
        }
        $this->delete();
    }
    
    public function uploadFile($file)
    {
        if ($file == null) {
            return;
        }
        if ($this->file) {
            Storage::delete('uploads/'.$this->file);
        }
        $filename = str_random(10).'.'.$file->getClientOriginalExtension();
        $file->storeAs('uploads', $filename);
        $this->file = $filename;
        $this->old_file_name = $file->getClientOriginalName();
        $this->save();
    }

    public function getDate()
    {
        return $this->created_at->format('F d, Y');
    }
}
