<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Chat</h1>
        <div class="bg-gray-100 rounded-lg p-4">
            @foreach ($chats as $chat)
                <div class="flex items-start mb-4 @if($chat->sender_id == auth()->id()) justify-end @endif">
                    @if($chat->sender_id != auth()->id())
                        <img src="{{ asset('storage/' . $chat->sender->image) }}" alt="{{ $chat->sender->name }}" class="w-10 h-10 object-cover rounded-full mr-4">
                    @endif
                    <div>
                        <div class="flex items-center mb-1">
                            <div class="text-gray-800 font-semibold">{{ $chat->sender->name }}</div>
                        </div>
                        <div class="bg-white rounded-lg shadow p-4">
                            <p class="text-gray-800">{{ $chat->message }}</p>
                        </div>
                    </div>
                    @if($chat->sender_id == auth()->id())
                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="w-10 h-10 object-cover rounded-full ml-4">
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>

