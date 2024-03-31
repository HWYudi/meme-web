<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @notifyCss
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body class="bg-black text-white">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

    <!-- page -->
    <main class="min-h-screen w-full">
        <x-notify::notify />
        @notifyJs
        <!-- header page -->
        <div class="flex">
            <!-- aside -->
            <aside
                class="sidebar hidden overflow-y-auto bg-black text-white lg:block fixed z-20 left-0 h-svh w-full lg:w-1/4 border-r border-white
                border-opacity-20">
                <div
                    class="w-full px-4 relative h-16 gap-3 flex items-center justify-start lg:justify-center border-b border-white border-opacity-20">
                    <img src="https://ichef.bbci.co.uk/news/976/cpsprodpb/16620/production/_91408619_55df76d5-2245-41c1-8031-07a4da3f313f.jpg"
                        alt="" class="w-10 h-10 rounded-full">
                    <h1 class="text-xl font-bold">MIM</h1>
                    <div class="absolute right-4 top-0 bottom-0 lg:hidden flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white"
                            class="bi bi-x-lg" viewBox="0 0 16 16" onclick="Openbar()">
                            <path
                                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col gap-3 p-4">
                    <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 30 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.9728 28.4261V24.0816C10.9728 22.9766 11.8737 22.0787 12.9898 22.0712H17.0785C18.2 22.0712 19.1091 22.9713 19.1091 24.0816V28.4396C19.1089 29.3778 19.8653 30.1447 20.8127 30.1666H23.5385C26.2557 30.1666 28.4584 27.9859 28.4584 25.2959V12.9369C28.4439 11.8787 27.942 10.8849 27.0955 10.2384L17.7735 2.80416C16.1404 1.5097 13.8189 1.5097 12.1858 2.80416L2.90462 10.2519C2.05495 10.8958 1.55221 11.8912 1.54175 12.9504V25.2959C1.54175 27.9859 3.74449 30.1666 6.46171 30.1666H9.18744C10.1584 30.1666 10.9455 29.3874 10.9455 28.4261"
                                fill="white" />
                            <path
                                d="M10.9728 28.4261V24.0816C10.9728 22.9766 11.8737 22.0787 12.9898 22.0712H17.0785C18.2 22.0712 19.1091 22.9713 19.1091 24.0816V28.4396C19.1089 29.3778 19.8653 30.1447 20.8127 30.1666H23.5385C26.2557 30.1666 28.4584 27.9859 28.4584 25.2959V12.9369C28.4439 11.8787 27.942 10.8849 27.0955 10.2384L17.7735 2.80416C16.1404 1.5097 13.8189 1.5097 12.1858 2.80416L2.90462 10.2519C2.05495 10.8958 1.55221 11.8912 1.54175 12.9504V25.2959C1.54175 27.9859 3.74449 30.1666 6.46171 30.1666H9.18744C10.1584 30.1666 10.9455 29.3874 10.9455 28.4261"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <h1>Home</h1>
                    </a>

                    <button class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2 lg:hidden"
                        onclick="searchbar()">
                        <svg width="34" height="33" viewBox="0 0 35 33" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.1168 27.2337C21.3611 27.2337 27.2337 21.3611 27.2337 14.1168C27.2337 6.87261 21.3611 1 14.1168 1C6.87261 1 1 6.87261 1 14.1168C1 21.3611 6.87261 27.2337 14.1168 27.2337Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M25.0193 23.3257L33.0193 31.3257" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <h1>Explore</h1>
                    </button>
                    <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 28 31" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.9999 23.6099C21.9888 23.6099 25.6847 22.585 26.0416 18.4714C26.0416 14.3607 23.4649 14.625 23.4649 9.5813C23.4649 5.64159 19.7307 1.15906 13.9999 1.15906C8.26918 1.15906 4.53495 5.64159 4.53495 9.5813C4.53495 14.625 1.95825 14.3607 1.95825 18.4714C2.3166 22.6006 6.01243 23.6099 13.9999 23.6099Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17.3841 27.8735C15.4515 30.0193 12.4369 30.0448 10.4858 27.8735" stroke="white"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <h1>Notification</h1>
                    </a>
                    <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 32 29" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M24.362 9.86487L18.0673 14.9833C16.878 15.9268 15.2048 15.9268 14.0155 14.9833L7.66772 9.86487"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M22.9541 27.0757C27.2627 27.0876 30.1666 23.5476 30.1666 19.1968V9.4666C30.1666 5.11575 27.2627 1.57574 22.9541 1.57574H9.0457C4.73712 1.57574 1.83325 5.11575 1.83325 9.4666V19.1968C1.83325 23.5476 4.73712 27.0876 9.0457 27.0757H22.9541Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>


                        <h1>Messages</h1>
                    </a>
                    <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 34 35" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M25.3408 15.7627C27.3171 15.4851 28.8386 13.7907 28.8428 11.738C28.8428 9.71497 27.3681 8.03764 25.4343 7.72031"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M27.9487 20.5137C29.8626 20.7998 31.1986 21.4699 31.1986 22.8512C31.1986 23.8018 30.5696 24.4194 29.5524 24.8076"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.8394 21.0995C12.2862 21.0995 8.39746 21.7894 8.39746 24.5448C8.39746 27.2988 12.2621 28.0085 16.8394 28.0085C21.3925 28.0085 25.2799 27.3257 25.2799 24.5689C25.2799 21.812 21.4166 21.0995 16.8394 21.0995Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.8395 17.1669C19.8273 17.1669 22.2498 14.7459 22.2498 11.7567C22.2498 8.76894 19.8273 6.34644 16.8395 6.34644C13.8518 6.34644 11.4292 8.76894 11.4292 11.7567C11.4179 14.7345 13.822 17.157 16.7999 17.1669H16.8395Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M8.33672 15.7627C6.35905 15.4851 4.83897 13.7907 4.83472 11.738C4.83472 9.71497 6.30947 8.03764 8.24322 7.72031"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M5.72884 20.5137C3.81492 20.7998 2.479 21.4699 2.479 22.8512C2.479 23.8018 3.108 24.4194 4.12517 24.8076"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <h1>Communities</h1>
                    </a>
                    <a href="#"
                        class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 34 35" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.9785 22.0662C11.4994 22.0662 6.82031 22.8946 6.82031 26.2123C6.82031 29.53 11.4697 30.3881 16.9785 30.3881C22.4576 30.3881 27.1353 29.5583 27.1353 26.242C27.1353 22.9256 22.4873 22.0662 16.9785 22.0662Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.9784 17.3341C20.574 17.3341 23.4883 14.4185 23.4883 10.8228C23.4883 7.22721 20.574 4.31293 16.9784 4.31293C13.3828 4.31293 10.4671 7.22721 10.4671 10.8228C10.455 14.4063 13.3504 17.322 16.9325 17.3341H16.9784Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <h1>Profile</h1>
                    </a>
                    <a href="#"
                        class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 30 29" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.0002 1.22171C22.2365 1.22171 28.1043 7.08813 28.1043 14.3259C28.1043 21.5622 22.2365 27.43 15.0002 27.43C7.76241 27.43 1.896 21.5622 1.896 14.3259C1.896 7.08954 7.76383 1.22171 15.0002 1.22171Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M20.5808 14.3441H20.5936" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M14.9014 14.3441H14.9141" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M9.22192 14.3441H9.23467" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <h1>More</h1>
                    </a>
                    <div class="w-full h-fit cursor-pointer bg-white rounded-full my-3" onclick="Openbar()">
                        <h1 class="text-center w-full text-xl text-black py-3 font-medium" onclick="togglePopup()">
                            Post</h1>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex items-end">
                            <img src="{{ asset('storage/' . auth()->user()->image )}}" alt=""
                                class="w-12 h-12 object-cover rounded-full">
                        </div>
                        <div>
                            <p class="font-semibold text-base">{{ auth()->user()->username }}</p>
                            <p class="text-sm font-thin">@ {{ auth()->user()->name }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 12C4 12.2652 4.10536 12.5196 4.29289 12.7071C4.48043 12.8946 4.73478 13 5 13H12.59L10.29 15.29C10.1963 15.383 10.1219 15.4936 10.0711 15.6154C10.0203 15.7373 9.9942 15.868 9.9942 16C9.9942 16.132 10.0203 16.2627 10.0711 16.3846C10.1219 16.5064 10.1963 16.617 10.29 16.71C10.383 16.8037 10.4936 16.8781 10.6154 16.9289C10.7373 16.9797 10.868 17.0058 11 17.0058C11.132 17.0058 11.2627 16.9797 11.3846 16.9289C11.5064 16.8781 11.617 16.8037 11.71 16.71L15.71 12.71C15.801 12.6149 15.8724 12.5028 15.92 12.38C16.02 12.1365 16.02 11.8635 15.92 11.62C15.8724 11.4972 15.801 11.3851 15.71 11.29L11.71 7.29C11.6168 7.19676 11.5061 7.1228 11.3842 7.07234C11.2624 7.02188 11.1319 6.99591 11 6.99591C10.8681 6.99591 10.7376 7.02188 10.6158 7.07234C10.4939 7.1228 10.3832 7.19676 10.29 7.29C10.1968 7.38324 10.1228 7.49393 10.0723 7.61575C10.0219 7.73757 9.99591 7.86814 9.99591 8C9.99591 8.13186 10.0219 8.26243 10.0723 8.38425C10.1228 8.50607 10.1968 8.61676 10.29 8.71L12.59 11H5C4.73478 11 4.48043 11.1054 4.29289 11.2929C4.10536 11.4804 4 11.7348 4 12V12ZM17 2H7C6.20435 2 5.44129 2.31607 4.87868 2.87868C4.31607 3.44129 4 4.20435 4 5V8C4 8.26522 4.10536 8.51957 4.29289 8.70711C4.48043 8.89464 4.73478 9 5 9C5.26522 9 5.51957 8.89464 5.70711 8.70711C5.89464 8.51957 6 8.26522 6 8V5C6 4.73478 6.10536 4.48043 6.29289 4.29289C6.48043 4.10536 6.73478 4 7 4H17C17.2652 4 17.5196 4.10536 17.7071 4.29289C17.8946 4.48043 18 4.73478 18 5V19C18 19.2652 17.8946 19.5196 17.7071 19.7071C17.5196 19.8946 17.2652 20 17 20H7C6.73478 20 6.48043 19.8946 6.29289 19.7071C6.10536 19.5196 6 19.2652 6 19V16C6 15.7348 5.89464 15.4804 5.70711 15.2929C5.51957 15.1054 5.26522 15 5 15C4.73478 15 4.48043 15.1054 4.29289 15.2929C4.10536 15.4804 4 15.7348 4 16V19C4 19.7956 4.31607 20.5587 4.87868 21.1213C5.44129 21.6839 6.20435 22 7 22H17C17.7956 22 18.5587 21.6839 19.1213 21.1213C19.6839 20.5587 20 19.7956 20 19V5C20 4.20435 19.6839 3.44129 19.1213 2.87868C18.5587 2.31607 17.7956 2 17 2Z" fill="white"/>
                                </svg>
                            Logout
                        </button>
                    </form>

                </div>
            </aside>

            <!-- main content page -->
            <div class="w-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white"
                    class="bi bi-list" viewBox="0 0 16 16" onclick="Openbar()">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
                @yield('content')
            </div>

            {{-- <aside
                class="searchbar hidden z-30 bg-black lg:block fixed right-0 min-h-svh w-full lg:w-1/4 border-l border-white border-opacity-20  overflow-y-auto">
                <div class="h-16 w-full flex-1 border-b border-white border-opacity-25 px-4 py-2 items-center">
                    <form action="{{ route('posts.search') }}" method="GET">
                        <div class="flex items-center">
                            <div class="flex items-center border w-full border-gray-300 py-1 rounded-lg">
                                <button type="submit" class="w-20 flex items-center justify-center">
                                    <svg width="35" height="33" viewBox="0 0 35 33" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.1168 27.2337C21.3611 27.2337 27.2337 21.3611 27.2337 14.1168C27.2337 6.87261 21.3611 1 14.1168 1C6.87261 1 1 6.87261 1 14.1168C1 21.3611 6.87261 27.2337 14.1168 27.2337Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M25.0194 23.3258L33.0194 31.3258" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <input type="text" name="q"
                                    class="bg-black text-white py-2 pr-3 w-full rounded-lg focus:outline-none"
                                    placeholder="Search posts...">
                            </div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="lg:hidden"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 6L6 18" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                    </form>
                </div>

                <div class="bg-white bg-opacity-10 rounded-lg p-4">
                    <h1 class="font-bold text-xl">Trend For You</h1>
                    <div class="flex text-sm font-thin gap-4">
                        <p>Entertainment</p>
                        <p>Trending</p>
                    </div>
                    <div>
                        <h1>Bitcoin</h1>
                        <p>1 post</p>
                    </div>
                </div>
            </aside> --}}
        </div>
    </main>


</body>
    <script>
        function Openbar() {
            document.querySelector('.sidebar').classList.toggle('hidden')
        }

        function searchbar() {
            document.querySelector('.sidebar').classList.toggle('hidden')
            document.querySelector('.searchbar').classList.toggle('hidden')
        }
    </script>

</html>
