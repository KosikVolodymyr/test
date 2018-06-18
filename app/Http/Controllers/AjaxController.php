<?php

namespace App\Http\Controllers;

use App\CommentCategory;
Use App\Comment;
use App\Http\Requests\AjaxComment;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function addCategoryComment(AjaxComment $request)
    {
        $comment = new CommentCategory();
        $comment->fill($request->all());
        $comment->category_id = $request->get('category');
        if (Auth::check()) {
            $comment->user_id = Auth::user()->id;
            $comment->author = Auth::user()->name;
        }
        $comment->save();
        
        $count = CommentCategory::where('category_id', $request->get('category'))->count();

        return response()->json([
            'success'=>view('pages._comment', ['comment' => $comment])->render(),
            'count' => $count
        ]);
    }
    
    public function addComment(AjaxComment $request)
    {
        $comment = new Comment();
        $comment->fill($request->all());
        $comment->post_id = $request->get('post');
        if (Auth::check()) {
            $comment->user_id = Auth::user()->id;
            $comment->author = Auth::user()->name;
        }
        $comment->save();
        
        $count = Comment::where('post_id', $request->get('post'))->count();

        return response()->json([
            'success'=>view('pages._comment', ['comment' => $comment])->render(),
            'count' => $count
        ]);
    }
}
