@extends('template.index')
@section('title', 'MIM | Home')
@section('content')

    <div
        class="fixed top-0 z-10 flex justify-center items-center h-16 w-full border-b border-white border-opacity-20 bg-black">
        <div class="absolute left-3 lg:hidden" onclick="Openbar()">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
        </div>
        <div class="w-full lg:w-1/2 flex items-center justify-center  font-bold text-xl">
            <a href="/" class="border-b-2 border-[#2B7BC5] p-4">For You</a>
            <a href="/following" class="p-4">Following</a>
        </div>
    </div>

    @if (session('success'))
        <div class="notif fixed top-0 left-0 right-0 p-4 bg-green-500 text-white text-center z-30">
            {{ session('success') }}
            <div class="absolute right-4 top-0 bottom-0 flex items-center" onclick="closeNotif()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                </svg>
            </div>
        </div>
    @endif


    <div class="popup fixed z-40 inset-0 flex items-center hidden justify-center  bg-black bg-opacity-80">
        <div class="bg-black rounded-lg p-2 px-5 w-full max-w-md relative">
            <span onclick="togglePopup()" class="text-white cursor-pointer">&times;</span>
            <form method="POST" action="{{ route('posts.store') }}" class="space-y-4" enctype="multipart/form-data">
                @csrf
                <div class="flex">
                    @if (auth()->check())
                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt=""
                            class="w-12 h-12 object-cover rounded-full">
                    @else
                        <img src="{{ asset('storage/' . 'posts/f3dwhsH1LfICvGpLSQ3sxjkS9K4tWomYffWpUEuy.png') }}"
                            alt="" class="w-12 h-12 object-cover rounded-full">
                    @endif

                    <input type="text" name="title" placeholder="What You Want To Post?"
                        class="text-white w-full px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 bg-transparent">
                </div>
                <div>
                    <input id="body" name="body" type="file" placeholder="URL Gambar"
                        class=" w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
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
                {{-- @if ($post->user->id === auth()->user()->id)
                    <div class="popup fixed hidden z-40 inset-0 flex items-center justify-center bg-black bg-opacity-80"
                        id="edit-{{ $post->id }}">
                        <div class="bg-gray-800 rounded-lg p-4 w-full max-w-md">
                            <h2 class="text-lg font-semibold text-white mb-4">Update Post</h2>
                            <form method="POST" action="{{ url('/post', $post->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="mb-4">
                                    <label for="title" class="block text-gray-300 mb-1">Title</label>
                                    <input type="text" id="title" name="title" value="{{ $post->title }}"
                                        class="w-full px-3 py-2 text-gray-800 bg-gray-200 rounded-md focus:outline-none focus:bg-white"
                                        placeholder="Enter title" required>
                                </div>

                                <div class="flex justify-end">
                                    <button type="button" onclick="confirmEdit({{ $post->id }})"
                                        class="px-4 py-2 bg-gray-600 text-gray-200 rounded-lg mr-2 hover:bg-gray-700">Cancel</button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif --}}
                <div class="py-5 flex items-start gap-4">
                    <div>
                        <a href="{{ url('/profile', $post->user->name) }}">
                            <img src="{{ asset('storage/' . $post->user->image) }}" alt="{{ $post->user->name }}"
                                class="w-14 h-12 object-cover rounded-full border border-[#A9DEF9]">
                        </a>
                    </div>
                    <div class="w-full">
                        <div class="flex justify-between">
                            <div>
                                <div class="flex items-center">
                                    <h1 class="font-light text-base text-white text-opacity-50">{{ $post->user->name }}
                                    </h1>
                                    <svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                        <circle cx="2" cy="2" r="2" fill="white" fill-opacity="0.5" />
                                    </svg>
                                    <h1 class="font-light text-base text-white text-opacity-50">
                                        {{ $post->created_at->diffForHumans() }}</h1>
                                </div>
                                <p class="text-white text-break whitespace-normal">
                                    {{ $post->title }}
                                </p>
                            </div>
                            <div class="relative h-12">
                                <button onclick="toggleDropdown({{ $post->id }})"
                                    class="h-full rounded-full hover:bg-gray-400">
                                    <svg width="45" height="4" viewBox="0 0 20 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="4" height="4" rx="2" fill="white"
                                            fill-opacity="0.5" />
                                        <rect x="8" width="4" height="4" rx="2" fill="white"
                                            fill-opacity="0.5" />/
                                        <rect x="16" width="4" height="4" rx="2" fill="white"
                                            fill-opacity="0.5" />
                                    </svg>
                                </button>
                                <div class="absolute hidden right-0 mt-2 w-40 border rounded-md shadow-lg bg-black "
                                    id="dropdown-{{ $post->id }}">
                                    <div>
                                        @if (auth()->check() && $post->user->id === auth()->user()->id)
                                            {{-- Dropdown Menu Action --}}
                                            <button onclick="openUpdateModal('{{ $post->id  }}', '{{ $post->title }}')"
                                            id="buttonUpdate"
                                                class="block w-full px-4 py-2 text-sm font-bold text-green-600 hover:bg-gray-900 hover:text-green-800">Update</button>

                                            <button onclick="openDeleteModal('{{ url('/post', $post->id) }}')"
                                                class="block w-full px-4 py-2 text-sm font-bold text-red-600 hover:bg-gray-100 hover:text-red-800">Delete</button>
                                            {{-- Dropdown Menu Action --}}
                                        @else
                                            <button
                                                class="block w-full px-4 py-2 text-sm font-bold text-red-600 hover:bg-gray-900 hover:text-red-800 rounded-lg">Report</button>
                                        @endif

                                    </div>
                                </div>

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
                                <img src="{{ asset('storage/' . $post->body) }}" alt="Post Image"
                                    class="w-full h-full mt-4 rounded-lg">
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
                                <form action="{{ url('/posts/' . $post->id . '/like') }}" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M1.87187 9.59832C0.798865 6.24832 2.05287 2.41932 5.56987 1.28632C7.41987 0.689322 9.46187 1.04132 10.9999 2.19832C12.4549 1.07332 14.5719 0.693322 16.4199 1.28632C19.9369 2.41932 21.1989 6.24832 20.1269 9.59832C18.4569 14.9083 10.9999 18.9983 10.9999 18.9983C10.9999 18.9983 3.59787 14.9703 1.87187 9.59832Z"
                                                stroke="white" stroke-opacity="0.5" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M15 4.70001C16.07 5.04601 16.826 6.00101 16.917 7.12201"
                                                stroke="white" stroke-opacity="0.5" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
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

                <div id="comment-{{ $post->id }}"
                    class="fixed z-20 inset-0 translate-y-full  flex items-center justify-center transition-transform duration-500 bg-black bg-opacity-80">
                    <div
                        class="w-full lg:w-[45%] h-svh lg:h-[90vh] relative bg-black border-2 border-white border-opacity-50 rounded-lg flex flex-col">
                        <div
                            class="p-4 h-14 sticky top-0 bg-black border border-white border-opacity-20 w-full flex justify-between items-center rounded-t-lg">
                            <h1 class="text-center">Postingan {{ $post->user->username }}</h1>
                            <div onclick="toggleComment({{ $post->id }})">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6L6 18" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="h-full overflow-y-auto w-full relative">
                            <img src="{{ 'storage/' . $post->body }}" alt="" class="w-full h-fit object-cover">
                            <div class="flex justify-between p-2 border-y border-white border-opacity-60">
                                <div class="w-1/2 flex justify-between items-center gap-2">
                                    <div class="flex gap-1 items-center">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            onclick="toggleComment({{ $post->id }})">
                                            <path
                                                d="M19 9.50003C19.0034 10.8199 18.6951 12.1219 18.1 13.3C17.3944 14.7118 16.3098 15.8992 14.9674 16.7293C13.6251 17.5594 12.0782 17.9994 10.5 18C9.18013 18.0035 7.87812 17.6951 6.7 17.1L1 19L2.9 13.3C2.30493 12.1219 1.99656 10.8199 2 9.50003C2.00061 7.92179 2.44061 6.37488 3.27072 5.03258C4.10083 3.69028 5.28825 2.6056 6.7 1.90003C7.87812 1.30496 9.18013 0.996587 10.5 1.00003H11C13.0843 1.11502 15.053 1.99479 16.5291 3.47089C18.0052 4.94699 18.885 6.91568 19 9.00003V9.50003Z"
                                                stroke="white" stroke-opacity="0.5" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <h1>{{ $post->comment->count() }}</h1>
                                    </div>
                                    <div class="flex gap-1 items-center">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            onclick="toggleComment({{ $post->id }})">
                                            <path
                                                d="M19 9.50003C19.0034 10.8199 18.6951 12.1219 18.1 13.3C17.3944 14.7118 16.3098 15.8992 14.9674 16.7293C13.6251 17.5594 12.0782 17.9994 10.5 18C9.18013 18.0035 7.87812 17.6951 6.7 17.1L1 19L2.9 13.3C2.30493 12.1219 1.99656 10.8199 2 9.50003C2.00061 7.92179 2.44061 6.37488 3.27072 5.03258C4.10083 3.69028 5.28825 2.6056 6.7 1.90003C7.87812 1.30496 9.18013 0.996587 10.5 1.00003H11C13.0843 1.11502 15.053 1.99479 16.5291 3.47089C18.0052 4.94699 18.885 6.91568 19 9.00003V9.50003Z"
                                                stroke="white" stroke-opacity="0.5" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <h1>{{ $post->comment->count() }}</h1>
                                    </div>
                                    <div class="flex gap-1 items-center">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            onclick="toggleComment({{ $post->id }})">
                                            <path
                                                d="M19 9.50003C19.0034 10.8199 18.6951 12.1219 18.1 13.3C17.3944 14.7118 16.3098 15.8992 14.9674 16.7293C13.6251 17.5594 12.0782 17.9994 10.5 18C9.18013 18.0035 7.87812 17.6951 6.7 17.1L1 19L2.9 13.3C2.30493 12.1219 1.99656 10.8199 2 9.50003C2.00061 7.92179 2.44061 6.37488 3.27072 5.03258C4.10083 3.69028 5.28825 2.6056 6.7 1.90003C7.87812 1.30496 9.18013 0.996587 10.5 1.00003H11C13.0843 1.11502 15.053 1.99479 16.5291 3.47089C18.0052 4.94699 18.885 6.91568 19 9.00003V9.50003Z"
                                                stroke="white" stroke-opacity="0.5" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <h1>{{ $post->comment->count() }}</h1>
                                    </div>
                                </div>
                                <div class="w-1/2 flex gap-3 justify-end">
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
                            <div class="p-4">
                                @foreach ($post->comment as $comment)
                                    <div class="flex items-start mb-4">
                                        <img src="{{ $comment->user->image }}" alt="{{ $comment->user->name }}"
                                            class="w-12 h-12 rounded-full mr-3">
                                        <div class="rounded-lg w-full">
                                            <div class="flex gap-2 items-center font-normal text-white text-opacity-50">
                                                <p class="overflow-visible">{{ $comment->user->username }}</p>
                                                <svg width="4" height="5" viewBox="0 0 4 5" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="2" cy="2.5" r="2" fill="white"
                                                        fill-opacity="0.5" />
                                                </svg>
                                                <p class="text-xs">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                            <p class="text-white text-break whitespace-normal">{{ $comment->body }}</p>
                                            <div>

                                                <button class="text-[#2B7BC4] text-xs"
                                                    onclick="toggleReply({{ $comment->id }})">
                                                    <p>
                                                        Reply
                                                    </p>
                                                </button>
                                            </div>
                                            <div id="lihat-{{ $comment->id }}" class="block">
                                                <button onclick="toggleReplyComment({{ $comment->id }})">
                                                    <p>
                                                        {{ $comment->reply->count() ? $comment->reply->count() . ' Balasan' : '' }}
                                                    </p>
                                                </button>
                                            </div>

                                            <div class="hidden" id="replyComment-{{ $comment->id }}">
                                                @foreach ($comment->reply as $reply)
                                                    <div class="flex items-start my-4">
                                                        <img src="{{ $reply->user->image }}"
                                                            alt="{{ $reply->user->name }}"
                                                            class="w-12 h-12 rounded-full mr-3">
                                                        <div class="rounded-lg">
                                                            <div
                                                                class="flex gap-2 items-center font-normal text-white text-opacity-50">
                                                                <p>{{ $reply->user->username }}</p>
                                                                <svg width="4" height="5" viewBox="0 0 4 5"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <circle cx="2" cy="2.5" r="2"
                                                                        fill="white" fill-opacity="0.5" />
                                                                </svg>
                                                                <p class="text-xs overflow-x-hidden">
                                                                    {{ $reply->created_at->diffForHumans() }}</p>
                                                            </div>
                                                            <p class="text-white">{{ $reply->body }}</p>
                                                            <p class="text-[#2B7BC4] text-xs">reply</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="flex gap-4 hidden  transition-opacity"
                                                id="reply-{{ $comment->id }}">
                                                @if (auth()->check() && auth()->user()->image)
                                                    <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                                        alt="" class="w-12 h-12 object-cover rounded-full">
                                                @else
                                                    <img src="{{ asset('storage/' . 'posts/f3dwhsH1LfICvGpLSQ3sxjkS9K4tWomYffWpUEuy.png') }}"
                                                        alt="" class="w-12 h-12 object-cover rounded-full">
                                                @endif

                                                <div class="w-full">
                                                    <form action="{{ url('/reply') }}" method="POST"
                                                        class="w-full relative flex items-center">
                                                        @csrf
                                                        <input type="hidden" name="comment_id"
                                                            value="{{ $comment->id }}">
                                                        <input type="text"
                                                            placeholder="Reply To {{ $comment->user->username }}"
                                                            name="body"
                                                            class=" w-full h-16 p-1 px-3 rounded-lg bg-black border border-white border-opacity-50">
                                                        <button type="submit" class="absolute right-3">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M13.8325 6.17463L8.10904 11.9592L1.59944 7.88767C0.66675 7.30414 0.860765 5.88744 1.91572 5.57893L17.3712 1.05277C18.3373 0.769629 19.2326 1.67283 18.9456 2.642L14.3731 18.0868C14.0598 19.1432 12.6512 19.332 12.0732 18.3953L8.10601 11.9602"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>

                                                        </button>
                                                    </form>
                                                    <button onclick="toggleReply({{ $comment->id }})">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="border-t border-white border-opacity-50 w-full py-10 px-5 sticky bottom-0">
                            <div class="flex gap-4 h-full " id="form">
                                @if (auth()->check() && auth()->user()->image)
                                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt=""
                                        class="w-12 h-12 object-cover rounded-full">
                                @else
                                    <img src="{{ asset('storage/' . 'posts/f3dwhsH1LfICvGpLSQ3sxjkS9K4tWomYffWpUEuy.png') }}"
                                        alt="" class="w-12 h-12 object-cover rounded-full">
                                @endif

                                <form action="{{ url('/comment') }}" method="POST"
                                    class="w-full relative flex items-center">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="text" placeholder="add a comment" name="body"
                                        class="placeholder:text-white w-full h-full p-1 pl-3 pr-10 rounded-lg bg-black border border-white border-opacity-50">
                                    <button type="submit" class="absolute right-3">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.8325 6.17463L8.10904 11.9592L1.59944 7.88767C0.66675 7.30414 0.860765 5.88744 1.91572 5.57893L17.3712 1.05277C18.3373 0.769629 19.2326 1.67283 18.9456 2.642L14.3731 18.0868C14.0598 19.1432 12.6512 19.332 12.0732 18.3953L8.10601 11.9602"
                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach



            {{-- Update Modal Popup --}}
            <div class="popup fixed hidden z-40 inset-0 flex items-center justify-center bg-black bg-opacity-80"
                id="updateForm">
                <div class="bg-gray-800 rounded-lg p-4 w-full max-w-md">
                    <h2 class="text-lg font-semibold text-white mb-4">Update Post</h2>
                    <form method="POST" id="routeUpdate" action="{{ url('/post') }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="title" class="block text-gray-300 mb-1">Title</label>
                            <input type="text" id="title" name="title" value=""
                                class="w-full px-3 py-2 text-gray-800 bg-gray-200 rounded-md focus:outline-none focus:bg-white"
                                required>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" onclick="cancelUpdate()"
                                class="px-4 py-2 bg-gray-600 text-gray-200 rounded-lg mr-2 hover:bg-gray-700">Cancel</button>
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Update Modal Popup --}}



            {{-- Delete Notification Popup --}}
            <div class="popup fixed z-40 inset-0 flex items-center hidden justify-center bg-black bg-opacity-80"
                id="deleteForm">
                <div class="bg-gray-800 rounded-lg p-4 w-full max-w-md">
                    <h2 class="text-lg font-semibold text-white mb-4">Confirmation</h2>
                    <p class="text-gray-400 mb-4">Are you sure you want to delete this post?</p>
                    <form method="POST" id="routeDelete" action="">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-end">
                            <button type="button" onclick="cancelDelete()"
                                class="px-4 py-2 bg-gray-600 text-gray-200 rounded-lg mr-2 hover:bg-gray-700">Cancel</button>
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Delete Notification Popup --}}

        </div>
    </div>


@endsection
