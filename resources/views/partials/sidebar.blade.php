<aside x-show="sidebarOpen"
       x-transition:enter="transition transform duration-200"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition transform duration-200"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       class="fixed top-0 left-0 w-64 h-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 border-r border-gray-300 dark:border-gray-700 z-30 overflow-y-auto transition-transform"
       x-cloak>
    <div class="flex justify-between items-center p-6">
        <span class="font-bold text-xl tracking-wide">Anugrah Teknik</span>
        <button @click="sidebarOpen = false"
                class="md:hidden text-gray-600 dark:text-gray-300 hover:text-red-500 dark:hover:text-red-400">
            ✖
        </button>
    </div>


    <nav role="navigation" aria-label="Main Sidebar" class="p-4 space-y-1">
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
            🏠 Dashboard
        </a>
        <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
            🧾 Pemesanan
        </a>
        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
            🧍 Pengguna
        </a>
        <a href="{{ route('admin.services.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
            🛠️ Layanan
        </a>
        <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
            📂 Kategori
        </a>
        <a href="{{ route('admin.faqs.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
            💬 FAQ
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
            🧾 Testimoni
        </a>
        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
            ⚙️ Pengaturan
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full text-left px-4 py-2 rounded hover:bg-red-100 dark:hover:bg-red-800 text-red-600 dark:text-red-400">
                🚪 Logout
            </button>
        </form>
    </nav>
</aside>
