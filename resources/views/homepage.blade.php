@extends('template.index')

@section('content')
    <div class="fixed top-0 flex justify-center items-center h-16 w-full border-b">
        <div class="w-full lg:w-1/2 flex items-center justify-evenly">
            <h1>Tes</h1>
            <h1>Tes</h1>
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
                                <p class="text-white text-break whitespace-normal">{{ $post->title }}</p>
                            </div>
                            <div>
                                <svg width="20" height="4" viewBox="0 0 20 4" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="4" height="4" rx="2" fill="white" fill-opacity="0.5" />
                                    <rect x="8" width="4" height="4" rx="2" fill="white"
                                        fill-opacity="0.5" />/
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
                        <div class="flex p-2">
                            <div class="w-1/3 flex gap-2 items-center justify-start">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" onclick="toggleComment({{ $post->id }})">
                                    <path
                                        d="M19 9.50003C19.0034 10.8199 18.6951 12.1219 18.1 13.3C17.3944 14.7118 16.3098 15.8992 14.9674 16.7293C13.6251 17.5594 12.0782 17.9994 10.5 18C9.18013 18.0035 7.87812 17.6951 6.7 17.1L1 19L2.9 13.3C2.30493 12.1219 1.99656 10.8199 2 9.50003C2.00061 7.92179 2.44061 6.37488 3.27072 5.03258C4.10083 3.69028 5.28825 2.6056 6.7 1.90003C7.87812 1.30496 9.18013 0.996587 10.5 1.00003H11C13.0843 1.11502 15.053 1.99479 16.5291 3.47089C18.0052 4.94699 18.885 6.91568 19 9.00003V9.50003Z"
                                        stroke="white" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <h1>{{ $post->comment->count() }}</h1>
                            </div>
                            <div class="w-1/3 flex gap-2 items-center justify-center">
                                <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M1.87187 9.59832C0.798865 6.24832 2.05287 2.41932 5.56987 1.28632C7.41987 0.689322 9.46187 1.04132 10.9999 2.19832C12.4549 1.07332 14.5719 0.693322 16.4199 1.28632C19.9369 2.41932 21.1989 6.24832 20.1269 9.59832C18.4569 14.9083 10.9999 18.9983 10.9999 18.9983C10.9999 18.9983 3.59787 14.9703 1.87187 9.59832Z"
                                        stroke="white" stroke-opacity="0.5" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M15 4.70001C16.07 5.04601 16.826 6.00101 16.917 7.12201" stroke="white"
                                        stroke-opacity="0.5" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <h1>{{ $post->like->count() }}</h1>
                            </div>
                            <div class="w-1/3 flex gap-3 justify-end">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19 21L12 16L5 21V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H17C17.5304 3 18.0391 3.21071 18.4142 3.58579C18.7893 3.96086 19 4.46957 19 5V21Z"
                                        stroke="white" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 12V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V12"
                                        stroke="white" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M16 6L12 2L8 6" stroke="white" stroke-opacity="0.5" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 2V15" stroke="white" stroke-opacity="0.5" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="comment-{{$post->id}}" class="hidden fixed inset-0 flex items-center justify-center">
                    <div class="w-full lg:w-[45%] h-[80vh] relative bg-black">
                        <h1>komen</h1>
                        <div class="absolute top-0 right-0" onclick="toggleComment({{$post->id}})">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 6L6 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="h-full overflow-y-auto">
                        <div class="flex items-center gap-3 p-4">
                            <img src="{{$post->user->image}}" alt="" class="w-12 h-12 rounded-full">
                            <div>
                                <h1>{{$post->user->username}}</h1>
                                <h1>{{$post->title}}</h1>
                            </div>
                        </div>

                        <img src="{{$post->body}}" alt="" class="w-full h-[50%]">
                        <div class="bg-black border">
                            @foreach ($post->comment as $comment)
                                <p>{{$comment->body}}</p>
                                <p>{{$comment->body}}</p>
                                <p>{{$comment->body}}</p>
                            @endforeach
                        </div>
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
