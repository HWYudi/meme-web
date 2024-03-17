@extends('template.index')

@section('content')
    <div class="w-full flex justify-center mt-8">
        <button
            class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors duration-300 ease-in-out"
            onclick="togglePopup()">Buat Postingan Baru</button>
    </div>
    <div class="popup fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
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
        {{-- <pre>{{ json_encode($posts, JSON_PRETTY_PRINT) }}</pre> --}}
        <div class="w-full md:w-1/2">
            @foreach ($posts as $post)
                <div class="mt-6 px-4">
                    <div class="bg-white border border-black rounded-lg shadow-md overflow-hidden">
                        <div class="flex justify-between items-center p-4">
                            <div class="flex gap-3 items-center">
                                <img src="{{ $post->user->image }}" alt="{{ $post->user->name }}"
                                    class="w-10 rounded-full border border-[#A9DEF9]">
                                <p class="text-sm font-semibold">{{ $post->user->name }}</p>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path
                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                </svg>
                                <div>

                                </div>
                            </div>
                        </div>
                        <div class="px-4">
                            <p class="text-sm font-semibold text-gray-600">Posted {{ $post->created_at->diffForHumans() }}</p>
                            <h2 class="text-xl font-semibold text-gray-800">{{ $post->title }}</h2>
                        </div>
                        <img src="{{ $post->body }}" alt="{{ $post->title }}" class="w-full object-cover">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function togglePopup() {
            document.querySelector('.popup').classList.toggle('hidden');
        }
    </script>
@endsection
