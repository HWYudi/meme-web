@extends('admin.template')
@section('content')
    <!-- Container for demo purpose -->
    <div class="container my-12 py-12 mx-auto px-4 md:px-6 lg:px-12">

        <!--Section: Design Block-->
        <section class="mb-20 text-gray-800">
            <div class="w-full flex justify-end items-center mb-4">
                <form method="GET" class="flex items-center">
                    <input type="text" placeholder="Search..."
                        class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:border-blue-500">
                    <button type="submit"
                        class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Search</button>
                </form>
            </div>
            <div class="block rounded-lg shadow-lg bg-white">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead class="border-b rounded-t-lg text-left">
                                        <tr>
                                            <th scope="col" class="rounded-tl-lg text-sm font-medium px-6 py-4">NAME</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">USERNAME</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">EMAIL</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">ROLE</th>
                                            <th scope="col" class="rounded-tr-lg text-sm font-medium px-6 py-4"></th>
                                        </tr>
                                    </thead>
                                    @foreach ($users as $user)
                                        <tbody>
                                            <tr class="border-b even:bg-gray-100 odd:bg-white"">
                                                <th class="text-sm flex items-center gap-2 font-medium px-6 py-4 whitespace-nowrap text-left"
                                                    scope="row">
                                                    <img src="{{ asset('storage/' . $user->image) }}" alt=""
                                                        class="w-12 h-12 object-cover rounded-full">
                                                    <p class="font-bold">
                                                        {{ $user->name }}
                                                    </p>
                                                </th>
                                                <td
                                                    class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                    {{ $user->username }}</td>
                                                <td
                                                    class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                    {{ $user->email }} </td>
                                                <td
                                                    class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                                    <h1 class="font-bold capitalize">
                                                        {{ $user->role->name }}
                                                    </h1>
                                                    </td>
                                                <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-right">
                                                    <a href="#!"
                                                        class="font-medium text-blue-600 hover:text-blue-700 focus:text-blue-700 active:text-blue-800 transition duration-300 ease-in-out">Edit</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!--Section: Design Block-->

    </div>
    <!-- Container for demo purpose -->
@endsection
