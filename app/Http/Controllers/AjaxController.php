<?php

namespace App\Http\Controllers;

use App\CommentCategory;
Use App\Comment;
use App\Http\Requests\AjaxComment;

class AjaxController extends Controller
{
    public function addCategoryComment(AjaxComment $request)
    {
        $comment = CommentCategory::add($request->all());
        $count = CommentCategory::where('category_id', $request->get('category'))->count();

        return response()->json([
            'success'=>view('pages._comment', ['comment' => $comment])->render(),
            'count' => $count
        ]);
    }
    
    public function addComment(AjaxComment $request)
    {
        $comment = Comment::add($request->all());
        $count = Comment::where('post_id', $request->get('post'))->count();

        return response()->json([
            'success'=>view('pages._comment', ['comment' => $comment])->render(),
            'count' => $count
        ]);
    }
}
