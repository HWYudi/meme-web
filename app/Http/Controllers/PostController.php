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
            'body' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'title.required' => 'Judul harus diisi.',
            'body.required' => 'Gambar harus diisi.',
        ]);

        $imagePath = $request->file('body')->store('posts');

        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'body' => $imagePath,
        ]);
        flash()->addSuccess('Your account has been re-verified.');
        return back();
    }

    public function like($id)
    {
        $post = Post::findOrFail($id);
        $post->like()->create(['user_id' => auth()->id()]);

        return response()->json(['likes_count' => $post->like->count()]);
    }



    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id != auth()->user()->id) {
            return abort(403);
        }
        $post->delete();
        toastr()->addSuccess('Postingan Berhasil Di Hapus', 'Deleted');
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
        ->orwhere
        ->get();

        return view('search', compact('posts'));
    }

}
