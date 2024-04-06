<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
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

    public function login(request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->with('error', 'The Provided credentials do not match our records.');
    }

    public function profile($name)
    {
        $user = User::with(['post', 'follow'])->where('name', $name)->first();
        $follower = Follow::where('following_id', $user->id)->get();
        return view('/profile', [
            "user" => $user, "follower" => $follower,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function post($name, $id)
    {
        $user = user::where('name', $name)->firstOrFail();

        $post = Post::with(["user", "comment.reply", "like"])->where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();
        return $post;
    }

    public function update(Request $request, $name)
    {
        $user = User::where('name', $name)->firstOrFail(); // Menggunakan where() untuk mencari user dengan nama yang sesuai
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('posts');

        $user->update([
            'image' => $imagePath
        ]);
        return back();
    }

    public function user()
    {
        $users = user::all();
        return view('user', compact('users'));
    }
}
