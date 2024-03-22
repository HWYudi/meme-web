<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-black text-white">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

    <!-- page -->
    <main class="min-h-screen w-full">
        <!-- header page -->
        <div class="flex">
            <!-- aside -->
            <aside
                class="sidebar hidden overflow-y-auto bg-black text-white lg:block fixed z-20 left-0 h-svh w-full lg:w-1/4 border-r border-white
                border-opacity-20">
                <div class="absolute right-4 block lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-x-lg" viewBox="0 0 16 16" onclick="Openbar()">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                      </svg>
                </div>
                <div class="w-full h-16 gap-3 flex items-center justify-start lg:justify-center border-b border-white border-opacity-20">
                    <img src="https://ichef.bbci.co.uk/news/976/cpsprodpb/16620/production/_91408619_55df76d5-2245-41c1-8031-07a4da3f313f.jpg" alt="" class="w-10 h-10 rounded-full">
                    <h1 class="text-xl font-bold">MIM</h1>
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

                    <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 35 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.1168 27.2337C21.3611 27.2337 27.2337 21.3611 27.2337 14.1168C27.2337 6.87261 21.3611 1 14.1168 1C6.87261 1 1 6.87261 1 14.1168C1 21.3611 6.87261 27.2337 14.1168 27.2337Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M25.0193 23.3257L33.0193 31.3257" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <h1>Explore</h1>
                    </a>
                    <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 28 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9999 23.6099C21.9888 23.6099 25.6847 22.585 26.0416 18.4714C26.0416 14.3607 23.4649 14.625 23.4649 9.5813C23.4649 5.64159 19.7307 1.15906 13.9999 1.15906C8.26918 1.15906 4.53495 5.64159 4.53495 9.5813C4.53495 14.625 1.95825 14.3607 1.95825 18.4714C2.3166 22.6006 6.01243 23.6099 13.9999 23.6099Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.3841 27.8735C15.4515 30.0193 12.4369 30.0448 10.4858 27.8735" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        <h1>Notification</h1>
                    </a>
                    <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 32 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.362 9.86487L18.0673 14.9833C16.878 15.9268 15.2048 15.9268 14.0155 14.9833L7.66772 9.86487" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M22.9541 27.0757C27.2627 27.0876 30.1666 23.5476 30.1666 19.1968V9.4666C30.1666 5.11575 27.2627 1.57574 22.9541 1.57574H9.0457C4.73712 1.57574 1.83325 5.11575 1.83325 9.4666V19.1968C1.83325 23.5476 4.73712 27.0876 9.0457 27.0757H22.9541Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>


                        <h1>Messages</h1>
                    </a>
                    <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25.3408 15.7627C27.3171 15.4851 28.8386 13.7907 28.8428 11.738C28.8428 9.71497 27.3681 8.03764 25.4343 7.72031" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M27.9487 20.5137C29.8626 20.7998 31.1986 21.4699 31.1986 22.8512C31.1986 23.8018 30.5696 24.4194 29.5524 24.8076" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8394 21.0995C12.2862 21.0995 8.39746 21.7894 8.39746 24.5448C8.39746 27.2988 12.2621 28.0085 16.8394 28.0085C21.3925 28.0085 25.2799 27.3257 25.2799 24.5689C25.2799 21.812 21.4166 21.0995 16.8394 21.0995Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8395 17.1669C19.8273 17.1669 22.2498 14.7459 22.2498 11.7567C22.2498 8.76894 19.8273 6.34644 16.8395 6.34644C13.8518 6.34644 11.4292 8.76894 11.4292 11.7567C11.4179 14.7345 13.822 17.157 16.7999 17.1669H16.8395Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.33672 15.7627C6.35905 15.4851 4.83897 13.7907 4.83472 11.738C4.83472 9.71497 6.30947 8.03764 8.24322 7.72031" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.72884 20.5137C3.81492 20.7998 2.479 21.4699 2.479 22.8512C2.479 23.8018 3.108 24.4194 4.12517 24.8076" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        <h1>Communities</h1>
                    </a>
                    <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.9785 22.0662C11.4994 22.0662 6.82031 22.8946 6.82031 26.2123C6.82031 29.53 11.4697 30.3881 16.9785 30.3881C22.4576 30.3881 27.1353 29.5583 27.1353 26.242C27.1353 22.9256 22.4873 22.0662 16.9785 22.0662Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.9784 17.3341C20.574 17.3341 23.4883 14.4185 23.4883 10.8228C23.4883 7.22721 20.574 4.31293 16.9784 4.31293C13.3828 4.31293 10.4671 7.22721 10.4671 10.8228C10.455 14.4063 13.3504 17.322 16.9325 17.3341H16.9784Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        <h1>Profile</h1>
                    </a>
                    <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                        <svg width="34" height="33" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0002 1.22171C22.2365 1.22171 28.1043 7.08813 28.1043 14.3259C28.1043 21.5622 22.2365 27.43 15.0002 27.43C7.76241 27.43 1.896 21.5622 1.896 14.3259C1.896 7.08954 7.76383 1.22171 15.0002 1.22171Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.5808 14.3441H20.5936" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.9014 14.3441H14.9141" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.22192 14.3441H9.23467" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <h1>More</h1>
                    </a>
                    <div class="w-full h-fit cursor-pointer bg-white rounded-full my-3" onclick="Openbar()">
                        <h1 class="text-center w-full text-xl text-black py-3 font-medium" onclick="togglePopup()">Post</h1>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex items-end">
                            <img src="{{ auth()->user()->image }}" alt="" class="w-12 h-full object-cover rounded-full">
                        </div>
                        <div>
                            <p class="font-semibold text-base">{{ auth()->user()->username }}</p>
                            <p class="text-sm font-thin">@ {{ auth()->user()->name }}</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- main content page -->
            <div class="w-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-list" viewBox="0 0 16 16" onclick="Openbar()">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                  </svg>
                @yield('content')
            </div>

            <aside
            class="sidebar hidden z-20 lg:block fixed right-0 min-h-svh w-full lg:w-1/4 border-l border-white border-opacity-20  p-2 px-5 overflow-y-auto">
            <div>
                <input type="text" placeholder="Search" class="w-full p-4 mb-3 rounded-full">
            </div>
            <div class="w-full h-fit bg-white text-white bg-opacity-10 rounded-lg my-3 p-4">
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
        </aside>
        </div>
    </main>

    <script>
        function Openbar() {
            document.querySelector('.sidebar').classList.toggle('hidden')
        }

        function profile() {
            document.querySelector('.profile').classList.toggle('hidden')
        }
    </script>
</body>

</html>
