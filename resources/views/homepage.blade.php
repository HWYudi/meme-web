@extends('template.index')

@section('content')
    <div class="w-full flex justify-center mt-8">
        <button
            class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors duration-300 ease-in-out"
            onclick="togglePopup()">Buat Postingan Baru</button>
    </div>
    <div class="popup fixed z-10 inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md relative">
            <span onclick="togglePopup()" class="absolute top-0 right-0 p-2 cursor-pointer">&times;</span>
            <form method="POST" action="{{ route('posts.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block text-gray-700 font-bold">Judul</label>
                    <input id="title" name="title" type="text" placeholder="Judul Postingan"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label for="body" class="block text-gray-700 font-bold">Isi</label>
                    <input id="body" name="body" type="text" placeholder="URL Gambar"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <button type="submit"
                        class="w-full px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md transition-colors duration-300 ease-in-out">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-8 flex justify-center">
        <div class="w-full  lg:w-1/2 lg:px-10">
            @foreach ($posts as $post)
                <div class="py-5 flex items-start gap-4">
                    <div>
                        <img src="{{ $post->user->image }}" alt="{{ $post->user->name }}"
                            class="w-14 h-12 object-cover rounded-full border border-[#A9DEF9]">
                    </div>
                    <div class="w-full">
                        <div class="h-12 flex justify-between items-center">
                            <div>
                                <div class="flex items-center">
                                    <h1 class="font-light text-base text-white text-opacity-50">{{ $post->user->name }}</h1>
                                    <svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                        <circle cx="2" cy="2" r="2" fill="white" fill-opacity="0.5" />
                                    </svg>
                                    <h1 class="font-light text-base text-white text-opacity-50">
                                        {{ $post->created_at->diffForHumans() }}</h1>
                                </div>
                                <p>{{ $post->title }}</p>
                            </div>
                            <div>
                                <svg width="20" height="4" viewBox="0 0 20 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="4" height="4" rx="2" fill="white" fill-opacity="0.5"/>
                                    <rect x="8" width="4" height="4" rx="2" fill="white" fill-opacity="0.5"/>
                                    <rect x="16" width="4" height="4" rx="2" fill="white" fill-opacity="0.5"/>
                                    </svg>

                            </div>
                        </div>
                        <div>
                            @if (strpos($post->body, '.mp4') !== false ||
                                    strpos($post->body, '.avi') !== false ||
                                    strpos($post->body, '.mov') !== false)
                                <video controls>
                                    <source src="{{ $post->body }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ $post->body }}" alt="Post Image" class="w-full mt-4 rounded-lg">
                            @endif
                        </div>
                    </div>
                </div>
                <div id="comment-{{ $post->id }}"
                    class="comment fixed z-10 inset-0 hidden flex items-center justify-center  bg-gray-900 bg-opacity-50">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md relative">
                        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 focus:outline-none"
                            onclick="toggleComment({{ $post->id }})">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <h1 class="pb-2">isi komen</h1>
                        @foreach ($post->comment as $comment)
                            <div class="flex items-start space-x-2">
                                <img src="{{ $comment->user->image }}" alt=""
                                    class="w-8 h-8 rounded-full border border-black">
                                <div>
                                    <div class="bg-gray-100 rounded-lg pt-0 p-2">
                                        <h1 class="text-gray-800 font-bold">{{ $comment->user->name }}</h1>
                                        <p class="text-gray-800">{{ $comment->body }}</p>
                                    </div>
                                    <p class="text-xs font-semibold text-gray-600">
                                        {{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function togglePopup() {
            document.querySelector('.popup').classList.toggle('hidden');
        }

        function toggleDropdown(id) {
            const dropdown = document.getElementById('dropdown-' + id);
            dropdown.classList.toggle('hidden');
        }

        function toggleComment(id) {
            const comment = document.getElementById('comment-' + id);
            comment.classList.toggle('hidden');
        }

        window.addEventListener('scroll', function() {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(function(dropdown) {
                dropdown.classList.add('hidden');
            });
        });
    </script>
@endsection
