<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(){
        
        return view('tags.index');
        
    }
    
    public function create(){
        
        return view('tags.create');
        
    }
    
     public function store(Request $request){
        
       $validated = $request->validate([
           
           'name' => 'required'
           
           ]);
           
        Tag::create($validated);   
        
        return redirect()->back()->with('success', 'Tag create successfully');
        
    }
}
