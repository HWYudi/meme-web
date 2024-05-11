<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with(['like', 'user', 'comment.reply'])->latest()->get();
        return view('homepage', compact('posts'));
    }

    public function inertia()
    {
        $posts = Post::with(['like', 'user', 'comment.reply'])->latest()->get();
        $user = auth()->user();
        return Inertia::render('Inertia', ['posts' => $posts, 'user' => $user]);
    }

    public function detailpost($name, $id)
    {
        $post = Post::with(['like', 'user', 'comment.reply.user' , 'comment.user'])->where('id', $id)->whereHas('user', function ($query) use ($name) {
            $query->where('name', $name);
        })->firstOrFail();
        $user = auth()->user();

        return Inertia::render('detailPost', ['post' => $post , 'user' => $user]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Judul harus diisi.',
            'body.required' => 'Gambar harus diisi.',
        ]);

        $imagePath = $request->file('body')->store('posts');

        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'body' => $imagePath,
        ]);

        return to_route('posts.store')->with('message', 'Postingan Berhasil Di Tambahkan');
    }

    public function like($id)
    {
        $post = Post::findOrFail($id);
        $post->like()->create(['user_id' => auth()->id()]);

        return back()->with('success', 'Postingan Berhasil Di Like');
        // return response()->json(['likes_count' => $post->like->count()]);
    }

    public function unlike($id)
    {
        $post = Post::findOrFail($id);
        $post->like()->where('user_id', auth()->id())->delete();
        // return response()->json(['likes_count' => $post->like->count()]);
        return back()->with('success', 'Postingan Berhasil Di UnLike');
    }


    public function destroy($name, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user->id != auth()->user()->id) {
            return abort(403);
        }
        $post->delete();

        return to_route('profile', $name)->with('success', 'Postingan Berhasil Di Hapus');
    }

    public function update(Request $request, $name, $id)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|max:255',
        ]);
        $post = Post::findOrFail($id);
        if ($post->user->id != auth()->user()->id) {
            return abort(403);
        }
        $post->update($request->all());
        return back()->with('success', 'Postingan Berhasil Di Update');
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        $posts = Post::with(['like', 'user', 'comment.reply'])
            ->where('title', 'like', '%' . $search . '%')
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        return Inertia::render('Inertia', ['posts' => $posts]);
    }


}
