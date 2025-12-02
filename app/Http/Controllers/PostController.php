<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function index(){
        
       
       $posts = Post::with('tags')->get();
        return view('posts.index', compact('posts'));
        
    }
    
    public function create(){
         $tags  = Tag::all();
        
        return view('posts.create', [
            
            'tags' => $tags,
            
            ]);
        
    }
    public function store(Request $request){
        
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags'        => 'nullable|array',          // ["laravel", "php", "vue"]
            'tags.*'      => 'string|distinct|max:50',  // each tag max 50 chars
            
            ]);
            
        $post = Post::create($validated);
            
        $post->tags()->sync($validated['tags'] ?? []); // one line
        
        return redirect()->back()->with('success', 'Post created.');
        
    }
    
    public function show(Post $post){
        
        // $post = Post::with('tags')->find($post);
        $post->load('tags');
        return view('posts.show', compact('post'));
        
    }
}
