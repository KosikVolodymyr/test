<?php

namespace App\Services;

use App\Comment;
use App\CommentCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AjaxComment;

class AjaxService
{
    public function createComment(AjaxComment $request)
    {
        $comment = new Comment();
        $comment->fill($request->all());
        $comment->post_id = $request->get('post');
        if (Auth::check()) {
            $comment->user_id = Auth::user()->id;
            $comment->author = Auth::user()->name;
        }
        $comment->save();
        
        return $comment; 
    }
    
    public function createCategoryComment(AjaxComment $request)
    {
        $comment = new CommentCategory();
        $comment->fill($request->all());
        $comment->category_id = $request->get('category');
        if (Auth::check()) {
            $comment->user_id = Auth::user()->id;
            $comment->author = Auth::user()->name;
        }
        $comment->save();
        
        return $comment; 
    }
}
