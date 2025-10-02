<nav 
    class="bg-white shadow-md fixed top-0 h-16 flex items-center justify-between px-6 z-10 transition-all duration-300"
    :class="open ? 'left-64 right-0' : 'left-20 right-0'">
    <div class="text-xl font-semibold">Admin Dashboard</div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
            Logout
        </button>
    </form>
</nav>