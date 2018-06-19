<?php

namespace App\Http\Controllers;

use App\CommentCategory;
Use App\Comment;
use App\Http\Requests\AjaxComment;
use App\Services\AjaxService;

class AjaxController extends Controller
{
    private $ajaxService;

    public function __construct(AjaxService $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }
    
    public function addCategoryComment(AjaxComment $request)
    {
        $comment = $this->ajaxService->createCategoryComment($request);
        
        $count = CommentCategory::where('category_id', $request->get('category'))->count();

        return response()->json([
            'success'=>view('pages._comment', ['comment' => $comment])->render(),
            'count' => $count
        ]);
    }
    
    public function addComment(AjaxComment $request)
    {
        $comment = $this->ajaxService->createComment($request);
        
        $count = Comment::where('post_id', $request->get('post'))->count();

        return response()->json([
            'success'=>view('pages._comment', ['comment' => $comment])->render(),
            'count' => $count
        ]);
    }
}
