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

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id != auth()->user()->id) {
            return abort(403);
        }
        $post->delete();
        return back();
    }

    public function update(Request $request, $id){
        $post = Post::findOrFail($id);
        if ($post->user_id != auth()->user()->id) {
            return abort(403);
        }
        $post->update($request->all());
        return back();
    }

    public function search (Request $request){
        $search = $request->input('q');
        $posts = Post::with(['like', 'user', 'comment.reply'])
        ->where('title', 'like', '%' . $search . '%')
        ->orWhereHas('user', function($query) use ($search) {
            $query->where('username', 'like', '%' . $search . '%');
        })
        ->orWhereHas('comment', function($query) use ($search) {
            $query->where('body', 'like', '%' . $search . '%');
        })
        ->get();

        return view('search', compact('posts'));
    }
}
