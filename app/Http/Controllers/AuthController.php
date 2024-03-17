<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|unique:users|min:3|max:24',
            'username' => 'required|string|min:3|max:24',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|max:24',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.unique' => 'Nama sudah digunakan.',
            'name.min' => 'Nama minimal 3 karakter.',
            'name.max' => 'Nama maksimal 24 karakter.',
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 24 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.max' => 'Password maksimal 24 karakter.',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi Berhasil');
    }

    public function login(request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->with('error', 'The Provided credentials do not match our records.');
    }
}
