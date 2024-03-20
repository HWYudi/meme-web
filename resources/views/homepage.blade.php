@extends('template.index')

@section('content')
    <div
        class="fixed w-full top-0 bg-black z-10 flex justify-center items-center border-b border-white border-opacity-20 text-white h-16">
        <div class="w-full  lg:w-1/2 flex justify-center gap-10 text-xl">
            <h1 class="font-bold border-b-2 border-[#2B7BC5] p-1">For You</h1>
            <h1 class="p-1">Following</h1>
        </div>
    </div>
    <div class="popup fixed z-10 inset-0 flex items-center hidden justify-center  bg-black bg-opacity-80">
        <div class="bg-black rounded-lg p-2 px-5 w-full max-w-md relative">
            <span onclick="togglePopup()" class="text-white cursor-pointer">&times;</span>
            <form method="POST" action="{{ route('posts.store') }}" class="space-y-4">
                @csrf
                <div class="flex">
                    <img src="{{ auth()->user()->image }}" alt="" class="w-12 h-12 rounded-full">
                    <input type="text" name="title" placeholder="What You Want To Post?"
                        class="text-white w-full px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 bg-transparent">
                </div>
                <div>
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

    <div class="flex justify-center">
        <div class="w-full mt-16 lg:w-1/2 lg:px-10">
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
                                <p class="text-white">{{ $post->title }}</p>
                            </div>
                            <div>
                                <svg width="20" height="4" viewBox="0 0 20 4" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="4" height="4" rx="2" fill="white" fill-opacity="0.5" />
                                    <rect x="8" width="4" height="4" rx="2" fill="white"
                                        fill-opacity="0.5" />
                                    <rect x="16" width="4" height="4" rx="2" fill="white"
                                        fill-opacity="0.5" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            @if (strpos($post->body, '.mp4') !== false ||
                                    strpos($post->body, '.avi') !== false ||
                                    strpos($post->body, '.mov') !== false)
                                <video controls loop class="w-full h-72 mt-4 rounded-lg">
                                    <source src="{{ $post->body }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ $post->body }}" alt="Post Image" class="w-full h-72 mt-4 rounded-lg">
                            @endif
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                viewBox="0 0 16 16" id="comment" onclick="toggleComment({{ $post->id }})">
                                <path fill="#212121"
                                    d="M1 4.5C1 3.11929 2.11929 2 3.5 2H12.5C13.8807 2 15 3.11929 15 4.5V9.5C15 10.8807 13.8807 12 12.5 12H8.68787L5.62533 14.6797C4.99168 15.2342 4 14.7842 4 13.9422V12H3.5C2.11929 12 1 10.8807 1 9.5V4.5ZM3.5 3C2.67157 3 2 3.67157 2 4.5V9.5C2 10.3284 2.67157 11 3.5 11H5V13.8981L8.31213 11H12.5C13.3284 11 14 10.3284 14 9.5V4.5C14 3.67157 13.3284 3 12.5 3H3.5Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div id="comment-{{ $post->id }}" class="fixed z-10 inset-0 flex justify-center items-center">
                    <div class="text-white w-full lg:w-1/3">
                        <div class="w-full flex justify-between p-3 border-b bg-white">
                            <h1 class="font-bold text-black text-center">Comments</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-x-lg" viewBox="0 0 16 16" onclick="toggleComment({{ $post->id }})">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                              </svg>
                        </div>
                        <div class="bg-white text-black break-words whitespace-normal h-96  p-2 px-5 overflow-y-auto relative">
                            @foreach ($post->comment as $comment)
                            <div class="w-full whitespace-normal break-words flex my-4">
                                <img src="{{ $comment->user->image }}" alt="" class="w-12 h-12 rounded-full">
                                <div class="bg-slate-50 border px-2">
                                    <h1 class="font-bold text-lg ">{{ $comment->user->name }}</h1>
                                    <p class="text-gray-500">{{ $comment->body }}</p>
                                    <h1 class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</h1>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="sticky bottom-0 left-4 right-4 flex">
                            <img src="{{ auth()->user()->image }}" alt="" class="w-12 h-12 rounded-full border">
                            <form action="{{ route('comments.store') }}" method="POST"
                                class="bg-slate-50 w-full flex gap-2 items-center">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="text" name="body" placeholder="Create a comment" class="w-full p-2 px-5">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-send" viewBox="0 0 16 16">
                                        <path
                                            d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
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
