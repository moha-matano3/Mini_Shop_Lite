<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .notify-container 
        {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999; /* Ensure it's above other elements */
        }
    </style>
</head>
<body class="bg-gray-100" x-data="{ open: true }">

    <div class="flex">
        {{-- Sidebar (shares same `open`) --}}
        @include('admin.layouts.sidebar')

        <div class="flex-1">
            {{-- Navbar --}}
            @include('admin.layouts.navbar')


            <div class="notify-container">
                <x-notify::notify />
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

    <x-notify::notify />
    @notifyJs
</body>
</html>