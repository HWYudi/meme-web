<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    //
    public function index(){
        $notif = Notif::with('sender')->where('receiver_id', auth()->user()->id)->get();
        return view('notif' , compact('notif'));
    }
}
