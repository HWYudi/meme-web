<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>User Management</h1>

    <!-- Form untuk menambah pengguna baru -->
    <form id="addUserForm">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <button type="submit">Add User</button>
    </form>

    <!-- Daftar pengguna -->
    <ul id="userList">
        @foreach($ajax as $user)
            <li>{{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>

    <!-- Script Ajax -->
    <script>
        $(document).ready(function() {
            // Fungsi untuk memuat ulang data pengguna
            function reloadUserList() {
                $.ajax({
                    url: '/ajax', // Ubah URL sesuai dengan endpoint yang Anda gunakan
                    type: 'GET',
                    success: function(response) {
                        // Mengosongkan daftar pengguna sebelum memuat data terbaru
                        $('#userList').empty();
                        // Menambahkan data pengguna terbaru ke dalam daftar pengguna di halaman HTML
                        $.each(response, function(index, user) {
                            $('#userList').append('<li>' + user.name + ' - ' + user.email + '</li>');
                        });
                    }
                });
            }

            // Memanggil fungsi reloadUserList saat halaman dimuat
            reloadUserList();

            $('#addUserForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '/ajax',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Memuat ulang data pengguna setelah menambahkan pengguna baru
                        // Mengosongkan form setelah menambahkan pengguna
                        $('#addUserForm')[0].reset();
                    }
                });
            });
        });
    </script>
</body>
</html>
