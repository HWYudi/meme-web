<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

    <!-- page -->
    <main class="min-h-screen w-full bg-gray-100 text-gray-700">
        <!-- header page -->
        <header class="flex sticky top-0 w-full h-20 items-center justify-between border-b-2 border-gray-200 bg-[#A9DEF9] p-2">
            <!-- logo -->
            <div class="flex items-center space-x-2">
                <button type="button" class="text-3xl lg:hidden" onclick="Openbar()"><i
                        class="bx bx-menu"></i>close</button>
            </div>

            <div class="w-full flex items-center justify-center">
              <input type="text" class="w-full md:w-1/2 p-2 rounded-lg shadow-lg" placeholder="Search Something Cool Here">
            </div>

            <div>
                <button type="button" class="h-9 w-9 overflow-hidden rounded-full">
                    <img src="{{ auth()->user()->image }}" alt="plchldr.co" />
                </button>
            </div>
        </header>

        <div class="flex">
            <!-- aside -->
            <aside
                class="sidebar hidden lg:block fixed left-0 h-svh w-72 space-y-2 border-r-2 border-gray-200 bg-white p-2">
                <div class="flex flex-col items-center">
                    <img src="{{auth()->user()->image}}" alt="" class="w-1/2 h-1/2 rounded-lg border">
                    <h1 class="text-xl font-bold">{{auth()->user()->name}}</h1>
                </div>
                <a href="#"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-home"></i></span>
                    <span>Dashboard</span>
                </a>

                <a href="#"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-cart"></i></span>
                    <span>Cart</span>
                </a>

                <a href="#"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-shopping-bag"></i></span>
                    <span>Shopping</span>
                </a>

                <a href="#"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-heart"></i></span>
                    <span>My Favourite</span>
                </a>

                <a href="#"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-user"></i></span>
                    <span>Profile</span>
                </a>
            </aside>

            <!-- main content page -->
            <div class="w-full p-4 lg:ml-72">
                @yield('content')
            </div>

            <!-- aside recomend -->
            <aside class="hidden lg:flex w-72 flex-col space-y-2 border-r-2 border-gray-200 bg-white h-svh">
                <a href="#"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-home"></i></span>
                    <span>Dashboard</span>
                </a>

                <a href="#"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-cart"></i></span>
                    <span>Cart</span>
                </a>

                <a href="#"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-shopping-bag"></i></span>
                    <span>Shopping</span>
                </a>

                <a href="#"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-heart"></i></span>
                    <span>My Favourite</span>
                </a>

                <a href="#"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-user"></i></span>
                    <span>Profile</span>
                </a>
            </aside>
        </div>
    </main>

    <script>
        function Openbar() {
            document.querySelector('.sidebar').classList.toggle('hidden')
        }
    </script>
</body>

</html>
