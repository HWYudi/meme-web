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
        <div class="w-full lg:w-1/2">
            @foreach ($posts as $post)
                <div class="mt-6 px-4">
                    <div class="bg-white border border-black rounded-lg shadow-md overflow-hidden">
                        <div class="flex justify-between items-center p-4">
                            <div class="flex gap-3 items-center">
                                <img src="{{ $post->user->image }}" alt="{{ $post->user->name }}"
                                    class="w-10 rounded-full border border-[#A9DEF9]">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="text-base font-semibold">{{ $post->user->name }}</p>
                                        <p
                                            class="text-xs font-semibold {{ $post->user->id !== auth()->user()->id ? 'text-blue-500' : '' }}">
                                            {{ $post->user->id !== auth()->user()->id ? 'Follow' : 'You' }}
                                        </p>
                                    </div>
                                    <p class="text-xs font-semibold text-gray-600">Posted
                                        {{ $post->created_at->diffForHumans() }}
                                </div>
                                </p>
                            </div>
                            @if (auth()->user()->id === $post->user_id)
                                <div class="relative z-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-three-dots-vertical cursor-pointer"
                                        viewBox="0 0 16 16" onclick="toggleDropdown('{{ $post->id }}')">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg>
                                    <div id="dropdown-{{ $post->id }}"
                                        class="dropdown hidden absolute right-0 mt-2 min-w-fit bg-white rounded-md shadow-lg">
                                        <div class="py-1" role="menu" aria-orientation="vertical"
                                            aria-labelledby="options-menu">
                                            <a href="/edit/{{ $post->id }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                role="menuitem">Edit</a>
                                            <a href="#"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                role="menuitem">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="pb-4 px-4">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $post->title }}</h2>
                        </div>
                        @if (strpos($post->body, '.mp4') !== false ||
                                strpos($post->body, '.avi') !== false ||
                                strpos($post->body, '.mov') !== false)
                            <video controls>
                                <source src="{{ $post->body }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <img src="{{ $post->body }}" alt="Post Image" class="w-full">
                        @endif
                        <div class="w-full flex justify-between items-center p-4">
                            <div class="w-1/3 flex items-center justify-start">
                                <form action="{{ route('posts.like', $post->id) }}" method="POST"
                                    class="flex items-center">
                                    @csrf
                                    <button type="submit">
                                        <svg width="24" height="25" viewBox="0 0 24 25"
                                            fill="{{ $post->like->contains('user_id', auth()->id()) ? 'red' : '' }}"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <mask id="path-1-inside-1_6_357" fill="white">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12.0582 18.505C12.0485 18.5126 12.0344 18.5138 12.0235 18.5055L6.72256 14.4927C3.96177 12.4028 4.63721 8.01172 7.90809 6.78536C9.43086 6.21442 10.9507 6.54142 12.0585 7.40003C13.1662 6.54156 14.686 6.21466 16.2086 6.78558C19.4795 8.01198 20.1549 12.4031 17.3941 14.493L12.0931 18.5057C12.0821 18.514 12.0679 18.5128 12.0582 18.505Z" />
                                            </mask>
                                            <path
                                                d="M12.0235 18.5055L12.9289 17.3096L12.9289 17.3096L12.0235 18.5055ZM12.0582 18.505L12.9971 17.3352L12.0677 16.5892L11.1309 17.326L12.0582 18.505ZM6.72256 14.4927L7.6279 13.2968L6.72256 14.4927ZM7.90809 6.78536L8.43469 8.18988L7.90809 6.78536ZM12.0585 7.40003L11.1396 8.58561L12.0584 9.29778L12.9773 8.58568L12.0585 7.40003ZM16.2086 6.78558L15.682 8.1901L16.2086 6.78558ZM17.3941 14.493L16.4888 13.297L17.3941 14.493ZM12.0931 18.5057L12.9984 19.7017L12.9984 19.7017L12.0931 18.5057ZM11.1182 19.7015C11.7232 20.1595 12.4912 20.0728 12.9855 19.684L11.1309 17.326C11.6058 16.9525 12.3455 16.868 12.9289 17.3096L11.1182 19.7015ZM5.81721 15.6887L11.1182 19.7015L12.9289 17.3096L7.6279 13.2968L5.81721 15.6887ZM7.38149 5.38083C3.03507 7.01045 2.08772 12.8655 5.81721 15.6887L7.6279 13.2968C5.83583 11.9402 6.23934 9.01299 8.43469 8.18988L7.38149 5.38083ZM12.9774 6.21445C11.4845 5.05733 9.42162 4.61592 7.38149 5.38083L8.43469 8.18988C9.4401 7.81292 10.4169 8.0255 11.1396 8.58561L12.9774 6.21445ZM12.9773 8.58568C13.6999 8.02567 14.6767 7.81315 15.682 8.1901L16.7352 5.38106C14.6953 4.61618 12.6325 5.05746 11.1396 6.21438L12.9773 8.58568ZM15.682 8.1901C17.8774 9.01323 18.2808 11.9404 16.4888 13.297L18.2994 15.6889C22.0289 12.8658 21.0816 7.01072 16.7352 5.38106L15.682 8.1901ZM16.4888 13.297L11.1877 17.3097L12.9984 19.7017L18.2994 15.6889L16.4888 13.297ZM11.1878 17.3097C11.7759 16.8645 12.5222 16.954 12.9971 17.3352L11.1193 19.6748C11.6136 20.0716 12.3884 20.1635 12.9984 19.7017L11.1878 17.3097Z"
                                                fill="red" mask="url(#path-1-inside-1_6_357)" />
                                        </svg>
                                    </button>
                                </form>

                                <p class="text-sm font-semibold text-gray-600">{{ $post->like->count() }}</p>
                            </div>
                            <div class="w-1/3 flex items-center justify-center">
                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" onclick="toggleComment({{ $post->id }})">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.5 9.5C4.5 7.567 6.067 6 8 6H16C17.933 6 19.5 7.567 19.5 9.5V12.5C19.5 14.433 17.933 16 16 16H8.3222C7.97066 16 7.62534 16.0927 7.32102 16.2686L4.5 17.8999V12.5V9.5ZM3 18.7686V18.7673V12.5V9.5C3 6.73858 5.23858 4.5 8 4.5H16C18.7614 4.5 21 6.73858 21 9.5V12.5C21 15.2614 18.7614 17.5 16 17.5H8.3222C8.23431 17.5 8.14798 17.5232 8.0719 17.5672L4.5 19.6326L4.49883 19.6333L3.75029 20.0661C3.41696 20.2589 3 20.0183 3 19.6333V18.7686ZM7 10C6.17157 10 5.5 10.6716 5.5 11.5C5.5 12.3284 6.17157 13 7 13C7.82843 13 8.5 12.3284 8.5 11.5C8.5 10.6716 7.82843 10 7 10ZM12 10C11.1716 10 10.5 10.6716 10.5 11.5C10.5 12.3284 11.1716 13 12 13C12.8284 13 13.5 12.3284 13.5 11.5C13.5 10.6716 12.8284 10 12 10ZM15.5 11.5C15.5 10.6716 16.1716 10 17 10C17.8284 10 18.5 10.6716 18.5 11.5C18.5 12.3284 17.8284 13 17 13C16.1716 13 15.5 12.3284 15.5 11.5Z"
                                        fill="#063A5A" />
                                </svg>
                                <p class="text-sm font-semibold text-gray-600">{{ $post->comment->count() }}</p>
                            </div>
                            <div class="w-1/3 flex items-center justify-end">
                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14.75 8.99988C14.3358 8.99988 14 8.6641 14 8.24988C14 7.83567 14.3358 7.49988 14.75 7.49988H16C18.7615 7.49988 21 9.73846 21 12.4999C21 15.2613 18.7615 17.4999 16 17.4999L14.75 17.4999C14.3358 17.4999 14 17.1641 14 16.7499C14 16.3357 14.3358 15.9999 14.75 15.9999L16 15.9999C17.933 15.9999 19.5 14.4329 19.5 12.4999C19.5 10.5669 17.933 8.99988 16 8.99988L14.75 8.99988ZM10 8.24988C10 8.6641 9.66423 8.99988 9.25002 8.99988L8.00004 8.99988C6.06704 8.99988 4.50004 10.5669 4.50004 12.4999C4.50004 14.4329 6.06704 15.9999 8.00004 15.9999L9.25001 15.9999C9.66423 15.9999 10 16.3357 10 16.7499C10 17.1641 9.66423 17.4999 9.25001 17.4999L8.00004 17.4999C5.23861 17.4999 3.00004 15.2613 3.00004 12.4999C3.00004 9.73846 5.23861 7.49988 8.00004 7.49988L9.25002 7.49988C9.66423 7.49988 10 7.83567 10 8.24988ZM8.00001 11.7499C7.5858 11.7499 7.25001 12.0857 7.25001 12.4999C7.25001 12.9141 7.5858 13.2499 8.00001 13.2499H16C16.4142 13.2499 16.75 12.9141 16.75 12.4999C16.75 12.0857 16.4142 11.7499 16 11.7499H8.00001Z"
                                        fill="#063A5A" />
                                </svg>
                            </div>
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
