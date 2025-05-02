<!DOCTYPE html>
<html lang="id"
      x-data="{
          darkMode: localStorage.getItem('theme') === 'dark',
          sidebarOpen: window.innerWidth >= 768,
          toggleTheme() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
              document.documentElement.classList.toggle('dark', this.darkMode);
          },
          toggleSidebar() {
              this.sidebarOpen = !this.sidebarOpen;
          }
      }"
      x-init="document.documentElement.classList.toggle('dark', darkMode)"
      x-cloak class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    @stack('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex min-h-screen transition-colors duration-300">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Main Content --}}
    <div :class="sidebarOpen ? 'ml-64' : 'ml-0'" class="flex-1 flex flex-col transition-all duration-300 ease-in-out">

        {{-- Header --}}
        <header class="bg-gray-100 dark:bg-gray-800 shadow p-4 sticky top-0 z-20 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                {{-- Hamburger --}}
                <button @click="toggleSidebar"
                        class="inline-flex items-center px-2 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring">
                    <template x-if="!sidebarOpen">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </template>
                    <template x-if="sidebarOpen">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </template>
                </button>
                <h1 class="text-xl font-semibold">@yield('title', 'Dashboard')</h1>
            </div>

            {{-- Toggle Dark Mode --}}
            <button @click="toggleTheme"
                    class="px-4 py-2 text-sm rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center space-x-2">
                <template x-if="darkMode">
                    <span>🌙 <span class="hidden md:inline">Gelap</span></span>
                </template>
                <template x-if="!darkMode">
                    <span>☀️ <span class="hidden md:inline">Terang</span></span>
                </template>
            </button>
        </header>

        {{-- Konten --}}
        <main class="flex-1 p-6 bg-gray-50 dark:bg-gray-950 overflow-y-auto">
            @yield('content')
        </main>
    </div>
</body>
</html>
