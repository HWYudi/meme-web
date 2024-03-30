<?php

namespace App\Http\Controllers;

use App\Models\Ajax;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function index()
    {
        $ajax = Ajax::all();
        return view('ajax', compact('ajax'));
    }
    public function store(Request $request)
    {
        $ajax = Ajax::create([
            'name' => $request->name,
        ]);

        return response()->json($ajax);
    }
}
