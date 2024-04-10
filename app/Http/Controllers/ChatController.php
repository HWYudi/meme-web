<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //

    public function index()
    {
    }

    public function chat($name)
{
    $chats = Chat::with('sender')
        ->where(function ($query) use ($name) {
            $query->whereHas('sender', function ($query) use ($name) {
                $query->where('name', $name);
            })->orWhereHas('receiver', function ($query) use ($name) {
                $query->where('name', $name);
            });
        })
        ->where(function ($query) {
            $query->where('receiver_id', auth()->user()->id)
                ->orWhere('sender_id', auth()->user()->id);
        })
        ->get();

    return view('chat', compact('chats'));
}

}
