<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $rules = [
        'name' => 'required|max:150',
        'category' => 'required',
        'description' => 'required',
        'content' => 'required',
        'upload_file' => 'nullable|file|max:2048'
    ];
    
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'noneCategory', 'show', 'download']]);
    }

    public function index()
    {
        $posts = Post::paginate(5);
        
        return view('pages.post.index', ['posts' => $posts]);
    }
    
    public function noneCategory() {
        $posts = Post::whereNull('category_id')->paginate(5);
        
        return view('pages.post.index', ['posts' => $posts]);
    }
    
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        
        return view('pages.post.show', ['post'=>$post]);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        
        return view('pages.post.create', ['categories' => $categories, 'category' => null]);
    }

    public function createWithCategory($category)
    {
        $categories = Category::pluck('name', 'id')->all();
        
        return view('pages.post.create', ['categories' => $categories, 'category' => $category]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        
        $post = Post::add($request->all());
        $post->uploadFile($request->file('upload_file'));
        
        return redirect()->route('category.show', ['slug' => $post->category->slug]);
    }
    
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        if($post->user_id == Auth::user()->id)
        {
            $categories = Category::pluck('name', 'id')->all();
            return view('pages.post.edit', ['post' => $post, 'categories' => $categories]);
        }
        return redirect()->back();
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, $this->rules);
        
        $post = Post::where('slug', $slug)->firstOrFail();
        if($post->user_id == Auth::user()->id)
        {
            $post->update($request->all());
            $post->uploadFile($request->file('upload_file'));
        
            return redirect()->route('category.show', ['slug' => $post->category->slug]);
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        if($post->user_id == Auth::user()->id)
        {
            if($post->category)
            {
                $back = redirect()->route('category.show', ['slug' => $post->category->slug]);
                
            }
            else
            {
               $back = redirect()->route('category.index');
            }
            $post->comments()->delete();
            $post->remove();
            
            return $back;
        }
        
        return redirect()->back();
    }
    
    public function download($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $path = storage_path('app')."/uploads/".$post->file;
        
        return response()->download($path, $post->old_file_name);
    }
}
