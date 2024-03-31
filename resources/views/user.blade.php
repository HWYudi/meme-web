<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200">
                        <button
                            onclick="openEditModal('{{ $user->id }}')"
                            class="text-indigo-600 hover:text-indigo-900"
                        >
                            Edit
                        </button>
                        <!-- Tambahkan tombol aksi lainnya di sini jika diperlukan -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Edit -->
    <div
        id="editModal"
        class="fixed z-10 inset-0 overflow-y-auto hidden"
    >
        <div class="flex items-center justify-center min-h-screen">
            <div
                class="bg-white w-1/3 p-6 rounded-lg shadow-lg"
                @click="editModalOpen = false"
            >
                <!-- Form Edit -->
                <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input fields -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="field_name">Field Name</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="field_name" type="text" placeholder="Field Value" name="field_name" value="">
                    </div>

                    <!-- Add more input fields as needed -->

                    <!-- Submit button -->
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function openEditModal(userId) {
            // Ubah value dari input field berdasarkan data yang akan diedit
            document.getElementById('field_name').value = userId;

            // Tampilkan modal
            document.getElementById('editModal').classList.remove('hidden');
        }
    </script>
</body>
</html>
