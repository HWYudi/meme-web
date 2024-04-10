<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Notif;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //

    public function index()
    {
        // Get the authenticated user's ID
        $userId = auth()->user()->id;

        // Fetch all chat messages where the authenticated user either sent or received a message
        $chats = User::with(['sender' , 'receiver' ])->find($userId);

        return view('allchat', compact('chats'));
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

            $user = User::where('name' , $name)->first();
        return view('chat', compact(['chats' , 'user'] ));
    }

    public function store(Request $request){

        $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'message' => 'required',
        ]);
        Chat::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        Notif::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'body' => auth()->user()->name . ' sent you a message',
        ]);

        return back()->with('success', 'Message Sent');
    }
}
