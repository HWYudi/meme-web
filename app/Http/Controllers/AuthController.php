<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

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
        $remember = $request->has('remember') ? true : false;
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->with('error', 'The Provided credentials do not match our records.');
    }

    public function profile($name)
    {
        $auth_user = Auth::user();
        $user = User::with(['post.user', 'followers.follower', 'following.following'])->where('name', $name)->firstOrFail();
        return Inertia::render('Profile', [
            'user' => $user,
            'auth_user' => $auth_user
        ]);
    }

    public function edit()
    {
        $user = auth()->user();
        return Inertia::render('editProfile', [
            'user' => $user
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
        return view('/post', [
            "post" => $post,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::find(auth()->user()->id);

        // Validasi input
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => 'required|string|min:3|max:24',
            'bio' => 'nullable|string|max:150',
        ]);

        // Proses gambar jika ada yang diunggah
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts');
        } else {
            $imagePath = $user->image; // gunakan gambar yang sudah ada jika tidak ada yang baru diunggah
        }


        // Perbarui data pengguna
        $user->update([
            'image' => $imagePath,
            'username' => $request->username,
            'bio' => $request->bio,
        ]);

        return redirect()->route('profile', ['name' => $user->name])->with('success', 'Profil berhasil diperbarui');
    }


    public function user()
    {
        $users = user::all();
        return view('user', compact('users'));
    }

    public function follow($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        Follow::create([
            'follower_id' => auth()->id(),
            'following_id' => $user->id
        ]);
        return back();
    }

    public function unfollow($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        Follow::where('follower_id', auth()->id())->where('following_id', $user->id)->delete();
        return back();
    }
}
