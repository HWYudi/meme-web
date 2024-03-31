@extends('template.index')
@section('content')
    <div class="flex justify-end">
        <div class="w-full lg:w-3/4 lg:px-10">
            <div class="flex gap-10 mb-20 mt-5">
                <div class="flex flex-col gap-5 items-center">
                    <img src="{{ asset('storage/' . $user->image) }}" alt=""
                        class="w-32 h-28 lg:w-48 lg:h-48 rounded-full object-cover">
                    @if (auth()->user()->id == $user->id)
                        <button class="bg-[#565656] px-4 py-2 rounded-lg mb-3 hover:bg-gray-700 transition duration-300">Edit
                            Profile</button>
                            <form action="{{ url('/profile/' . $user->name) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="file" name="image">
                                <button type="submit">change</button>
                            </form>

                    @else
                        <button>Follow</button>
                    @endif
                </div>
                <div>
                    <div class="flex items-center gap-5">
                        <h1 class="font-semibold text-xl">{{ $user->username }}</h1>
                        <svg width="30" height="31" viewBox="0 0 30 31" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.6888 11.3977V8.71395C20.6888 5.5727 18.1413 3.02514 15.0001 3.02514C11.8588 3.01145 9.30131 5.54645 9.28756 8.68895V8.71395V11.3977"
                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M19.604 27.062H10.0527C7.43524 27.062 5.31274 24.9408 5.31274 22.322V16.9608C5.31274 14.342 7.43524 12.2208 10.0527 12.2208H19.604C22.2215 12.2208 24.344 14.342 24.344 16.9608V22.322C24.344 24.9408 22.2215 27.062 19.604 27.062Z"
                                fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M14.8286 18.2534V21.0297" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h1 class="text-opacity-50 text-white">{{ $user->name }}</h1>
                    <div class="mt-5">
                        <div class="flex items-center gap-3">
                            <h1>{{ $user->post->count() }} Post</h1>
                        </div>
                        <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, asperiores?</h1>
                    </div>
                </div>
            </div>
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 border-t pt-5">
                @foreach ($user->post as $post)
                    <a href="{{ url("/profile/{$user->name}/{$post->id}") }}"
                        class="hover:opacity-80 transition duration-300">
                        <img src="{{ asset('storage/' . $post->body) }}" alt=""
                            class="w-full h-44 sm:h-64 lg:h-72 object-cover rounded-lg">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
