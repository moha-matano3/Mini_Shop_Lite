<div 
    :class="open ? 'w-64' : 'w-20'"
    class="bg-gray-900 text-gray-100 h-screen fixed left-0 top-0 flex flex-col transition-all duration-300">

    <!-- Logo + Toggle -->
    <div class="p-4 flex items-center justify-between border-b border-gray-700">
        <span x-show="open" class="text-xl font-bold">Mini Shop</span>
        <button @click="open = !open" class="text-gray-300 hover:text-white focus:outline-none">
            <!-- icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Nav Links -->
    <ul class="mt-6 space-y-2 flex-1">

        <!-- Dashboard -->
        <li>
            <a href="{{ route('admin.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700 rounded">
                <span class="text-lg">🏠</span>
                <span x-show="open">Dashboard</span>
            </a>
        </li>

        <!-- Categories Dropdown -->
        <li x-data="{ catOpen: false }">
            <button @click="catOpen = !catOpen" 
                    class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded">
                <div class="flex items-center gap-3">
                    <span class="text-lg">📂</span>
                    <span x-show="open">Categories</span>
                </div>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" 
                     :class="catOpen ? 'rotate-90' : ''"
                     class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <ul x-show="catOpen && open" x-transition class="ml-10 mt-1 space-y-1">
                <li><a href="{{ url('/display_category') }}" class="block px-4 py-2 text-sm hover:bg-gray-700 rounded">Display Categories</a></li>
                <li><a href="{{ url('/category_page') }}" class="block px-4 py-2 text-sm hover:bg-gray-700 rounded">Add Category</a></li>
            </ul>
        </li>

        <!-- Products Dropdown -->
        <li x-data="{ prodOpen: false }">
            <button @click="prodOpen = !prodOpen" 
                    class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded">
                <div class="flex items-center gap-3">
                    <span class="text-lg">🛒</span>
                    <span x-show="open">Products</span>
                </div>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" 
                     :class="prodOpen ? 'rotate-90' : ''"
                     class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <ul x-show="prodOpen && open" x-transition class="ml-10 mt-1 space-y-1">
                <li><a href="{{ url('/display_product') }}" class="block px-4 py-2 text-sm hover:bg-gray-700 rounded">Display Products</a></li>
                <li><a href="{{ url('/add_product') }}" class="block px-4 py-2 text-sm hover:bg-gray-700 rounded">Add Product</a></li>
            </ul>
        </li>

        <!-- Orders -->
        <li>
            <a href="{{route('admin.layouts.order')}}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700 rounded">
                <span class="text-lg">📦</span>
                <span x-show="open">Orders</span>
            </a>
        </li>
    </ul>
</div>