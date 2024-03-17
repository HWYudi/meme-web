<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('homepage', compact('posts'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Post created successfully');
    }
}
