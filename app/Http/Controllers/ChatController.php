<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Notif;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class ChatController extends Controller
{
    //

    public function index()
    {
        // Fetch all chat messages where the authenticated user either sent or received a message
        $user = auth()->user();
        $user_id = auth()->user()->id;

        $chats = Chat::with(['sender', 'receiver'])
            ->select('sender_id', 'receiver_id', 'message', 'created_at')
            ->whereIn('id', function($query) use ($user_id) {
                // Subquery to get the latest message ID for each sender-receiver pair
                $query->select(DB::raw('MAX(id)'))
                    ->from('chats')
                    ->where(function($q) use ($user_id) {
                        // Filter by messages involving the authenticated user
                        $q->where('sender_id', $user_id)
                          ->orWhere('receiver_id', $user_id);
                    })
                    ->groupBy(DB::raw('LEAST(sender_id, receiver_id)'), DB::raw('GREATEST(sender_id, receiver_id)')); // Group by both sender and receiver to treat (sender, receiver) and (receiver, sender) as the same pair
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('allChat', compact('chats' ,'user'));
    }


    public function chat($name)
    {
        $user = auth()->user();
        $receiver = User::where('name', $name)->first();
        $user_id = auth()->user()->id;

        // $chats = Chat::with(['sender', 'receiver'])
        //     ->select('sender_id', 'receiver_id', 'message', 'created_at')
        //     ->whereIn('id', function($query) use ($user_id) {
        //         // Subquery to get the latest message ID for each sender-receiver pair
        //         $query->select(DB::raw('MAX(id)'))
        //             ->from('chats')
        //             ->where(function($q) use ($user_id) {
        //                 // Filter by messages involving the authenticated user
        //                 $q->where('sender_id', $user_id)
        //                   ->orWhere('receiver_id', $user_id);
        //             })
        //             ->groupBy(DB::raw('LEAST(sender_id, receiver_id)'), DB::raw('GREATEST(sender_id, receiver_id)')); // Group by both sender and receiver to treat (sender, receiver) and (receiver, sender) as the same pair
        //     })
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        $messages = Chat::where('sender_id', $user_id)->where('receiver_id', $receiver->id)->first();
        return inertia::render('singleChat' , compact('user' , 'receiver' , 'messages'));
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
