<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'body' => 'required',
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id,
            'body' => $request->body
        ]);

        return back();
    }
}
