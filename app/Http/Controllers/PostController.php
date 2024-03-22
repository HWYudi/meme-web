<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with(['like', 'user', 'comment.reply'])->latest()->get();
        return view('homepage', compact('posts'));
    }


    public function following()
    {
        $posts = Post::with(['like', 'user', 'comment.reply'])->latest()->get();
        return view('following', compact('posts'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // contoh validasi gambar dengan ekstensi jpeg, png, jpg, gif dan ukuran maksimal 2MB
        ]);

        // Simpan gambar ke dalam storage
        $imagePath = $request->file('body')->store('posts');

        // Simpan path gambar ke dalam database
        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'body' => $imagePath,
        ]);

        return back()->with('success', 'Post created successfully');
    }

    public function like($id)
    {
        $post = Post::findOrFail($id);
        $post->like()->create(['user_id' => auth()->id()]);

        return back();
    }
}
