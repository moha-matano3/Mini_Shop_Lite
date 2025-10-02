<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100" x-data="{ open: true }">

    <div class="flex">
        {{-- Sidebar (shares same `open`) --}}
        @include('admin.layouts.sidebar')

        <div class="flex-1">
            {{-- Navbar --}}
            @include('admin.layouts.navbar')

            {{-- Searchbar --}}
            <div 
                class="bg-gray-100 px-6 py-3 fixed top-16 shadow z-0 transition-all duration-300"
                :class="open ? 'left-64 right-0' : 'left-20 right-0'">
                <input type="text" placeholder="🔍 Search..." 
                       class="w-full md:w-1/2 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Page Content --}}
            <main 
                class="mt-32 p-6 transition-all duration-300"
                :class="open ? 'ml-64' : 'ml-20'">
                <div class="bg-white p-6 rounded-lg shadow">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

</body>
</html>