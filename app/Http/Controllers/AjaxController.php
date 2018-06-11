<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CommentCategory;
Use App\Comment;

class AjaxController extends Controller
{
    private $rules = [
        'author' => 'required|max:150|username',
        'content' => 'required|max:250'
    ];
    
    public function addCategoryComment(Request $request) {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->passes()) {
            $comment = CommentCategory::add($request->all());
            $count = CommentCategory::where('category_id', $request->get('category'))->count();
            
            return response()->json([
                    'success'=>view('pages._comment', ['comment' => $comment])->render(),
                    'count' => $count
                ]);
        }

    	return response()->json(['error'=>view('pages._errors', ['errors' => $validator->errors()])->render()]);
    }
    
    public function addComment(Request $request) {
        $validator = Validator::make($request->all(), $this->rules);
        
        if ($validator->passes()) {
            $comment = Comment::add($request->all());
            $count = Comment::where('post_id', $request->get('post'))->count();
            
            return response()->json([
                    'success'=>view('pages._comment', ['comment' => $comment])->render(),
                    'count' => $count
                ]);
        }

    	return response()->json(['error'=>view('pages._errors', ['errors' => $validator->errors()])->render()]);
    }
}
