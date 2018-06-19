<?php

namespace App\Services;

use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryRequest;

class CategoryService
{
    public function create(CategoryRequest $request)
    {
        $category = new Category();
        $category->fill($request->all());
        $category->user_id = Auth::user()->id;
        $category->save();
        
        return $category; 
    }
}
