<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-black text-white">
    <div class="min-h-svh flex justify-center items-center">
        <form action="{{ route('login') }}" method="POST" class="w-full max-w-sm mx-auto">
            {{session()->has('success') ? session('success') : ''}}
            {{session()->has('error') ? session('error') : ''}}
            @csrf
            <div class="pb-5 relative">
                <label for="email" class="block">Email</label>
                <input type="text" name="email" placeholder="Email" id="email" value="{{ old('email') }}"
                    class="w-full p-2 bg-slate-400 border @error('email') border-red-500 @enderror rounded-lg shadow-lg">
                @error('email')
                    <p class="absolute bottom-0 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="pb-5 relative">
                <label for="password" class="block">Password</label>
                <input type="password" name="password" placeholder="Password" id="password"
                    class="w-full p-2 bg-slate-400 border @error('username') border-red-500 @enderror rounded-lg shadow-lg">
                @error('password')
                    <p class="absolute bottom-0 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full p-2 bg-slate-800 rounded-lg shadow-lg">Register</button>
        </form>
    </div>
</body>

</html>
