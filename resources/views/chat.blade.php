@extends('template.index')
@section('title', 'MIM | Chat')
@section('content')
    <div class="flex justify-end">
        <div class="w-full lg:w-3/4">
            <div class="h-16 border border-white border-opacity-20 flex items-center">
                <div class="flex items-center gap-2 px-4">
                    <img src="{{ asset('storage/' . $user->image) }}" alt="" class="w-12 h-12 object-cover rounded-full">
                    <h1 class="font-bold">{{ $user->name }}</h1>
                </div>
            </div>
            <div class="rounded-lg p-4">
                @foreach ($chats as $chat)
                    <div class="flex items-start mb-4 @if($chat->sender_id == auth()->id()) justify-end @endif">
                        @if($chat->sender_id != auth()->id())
                            <img src="{{ asset('storage/' . $chat->sender->image) }}" alt="{{ $chat->sender->name }}" class="w-10 h-10 object-cover rounded-full mr-4">
                        @endif
                        <div>
                            <div class="@if($chat->sender_id == auth()->id()) bg-[#3797F0] @else bg-[#262626] @endif rounded-lg shadow p-2">
                                <p>{{ $chat->message }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="fixed bottom-0 w-full lg:w-3/4 border-t border-white border-opacity-20 py-4 px-6 gap-4">
                <form action="{{ url('/chat') }}" class="flex items-center gap-4" method="POST">
                    @csrf
                    <input type="hidden" name="sender_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                    <input type="text" placeholder="Type your message..." name="message" class="w-full px-4 py-2 rounded-lg border text-black border-gray-300 focus:outline-none focus:border-blue-500">
                    <button type="submit" class="w-fit px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
