<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {   $users = User::paginate(5);
        return view('admin.dashboard' , compact('users'));
    }

    public function search(Request $request){
        $search = $request->input('search');
        $users = User::where('name' , 'like' , '%' . $search . '%')->get();
        return view('admin.dashboard' , compact('users'));
    }
}
