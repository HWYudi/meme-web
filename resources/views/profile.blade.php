{{-- {{ json_encode($user) }}

@foreach ($user->followers as $pengikut)
{{ $pengikut->follower->image }}
{{ $pengikut->follower->name }}
@endforeach --}}

@extends('template.index')
@section('title', $user->name . ' - MIM')
@section('content')
    <div class="flex justify-end">
        <div class="w-full lg:w-3/4 px-3 lg:px-10">
            <div class="flex gap-10">
                <div class="flex items-center gap-10">
                    <img src="{{ asset('storage/' . $user->image) }}" alt=""
                        class="w-24 h-24 object-cover rounded-full">
                    <div class="flex flex-col items-center">
                        <h1 class="text-3xl font-bold">{{ $user->post->count() }}</h1>
                        <p>Posts</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <h1 class="text-3xl font-bold">{{ $user->followers->count() }}</h1>
                        <p>Follower</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <h1 class="text-3xl font-bold">{{ $user->following->count() }}</h1>
                        <p>Following</p>
                    </div>
                </div>
            </div>
            <div class="flex w-fit flex-col">
                <h1 class="ml-3 font-bold text-white text-opacity-50">@ {{ $user->name }}</h1>
                <h1>{{ $user->username }}</h1>
                {{-- @if (auth()->check() && $user->id === auth()->user()->id)
                    <button class="px-4 py-2 bg-gray-600 text-gray-200 rounded-lg hover:bg-gray-700">Edit Profile</button>
                @elseif(auth()->check() && $user->follow->contains('following_id', auth()->user()->id))
                    <button class="px-4 py-2 bg-gray-600 text-gray-200 rounded-lg hover:bg-gray-700">Friend</button>
                @elseif(auth()->check() &&
                        auth()->user()->follow->contains('following_id', $user->id))
                    <form action="{{ url('/profile', $user->name) }}" method="POST">
                        @csrf
                        <button type="submit" name="following_id" value="{{ $user->id }}"
                            class="px-4 py-2 bg-gray-600 text-gray-200 rounded-lg hover:bg-gray-700">Unfollow</button>
                    </form>
                @else
                    <form action="{{ url('/profile', $user->name) }}" method="POST">
                        @csrf
                        <button type="submit" name="following_id" value="{{ $user->id }}"
                            class="px-4 py-2 bg-gray-600 text-gray-200 rounded-lg hover:bg-gray-700">Follow</button>
                    </form>
                @endif --}}


            </div>

            <div class="w-full grid grid-cols-3 gap-3 border-t border-gray-600 pt-5 mt-10">
                @foreach ($user->post as $post)
                    <a href="{{ url("/profile/{$user->name}/{$post->id}") }}"
                        class="hover:opacity-60 transition duration-300">
                        <img src="{{ asset('storage/' . $post->body) }}" alt=""
                            class="w-full aspect-square object-cover border border-black">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
