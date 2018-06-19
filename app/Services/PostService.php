<?php

namespace App\Services;

use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

class PostService
{
    public function create(PostRequest $request)
    {
        $post = new Post();
        $post->fill($request->all());
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->get('category');
        $post->save();
        
        return $post; 
    }
}
