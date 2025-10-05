<div 
    class="bg-gray-100 px-6 py-3 fixed top-16 shadow z-10 transition-all duration-300"
    :class="open ? 'left-64 right-0' : 'left-20 right-0'">
    <form method="GET" action="{{ url()->current() }}" class="flex items-center gap-3">
        <input 
            type="text" 
            name="search"
            value="{{ request('search') }}"
            placeholder="🔍 Search..." 
            class="w-full md:w-1/2 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
        <button 
            type="submit" 
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
            Search
        </button>
    </form>
</div>