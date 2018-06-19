<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private $categoryService;
    
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    public function index()
    {
        $categories = Category::all();
        $nullableCategory = Post::whereNull('category_id')->count();
        $postsCount = Post::count();
        
        return view('pages.category.index', ['categories' => $categories, 'nullableCategory' => $nullableCategory, 'postsCount' => $postsCount]);
    }
    
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(5);
        
        return view('pages.category.show', ['category' => $category, 'posts' => $posts]);
    }

    public function create()
    {
        return view('pages.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->create($request);
        
        return redirect()->route('category.index');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        if ($category->user_id == Auth::user()->id) {
            return view('pages.category.edit', ['category' => $category]);
        }
        
        return redirect()->back();
    }

    public function update(CategoryRequest $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        if ($category->user_id == Auth::user()->id) {
            $category->update($request->all());
        
            return redirect()->route('category.index');
        }
        
        return redirect()->back();
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        if ($category->user_id == Auth::user()->id) {
            $category->posts()->update(['category_id' => null]);
            $category->comments()->delete();
            $category->delete();
        
            return redirect()->route('category.index');
        }
        
        return redirect()->back();
    }
}
