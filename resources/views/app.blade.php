<!DOCTYPE html>
<html lang="en"
      class="scroll-smooth"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      :data-theme="darkMode ? 'dark' : 'light'"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Edu Track</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body 
    class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex min-h-screen"
>

    <!-- Konten Utama -->
    <div class="flex flex-col flex-1 bg-[#f8f5ff] dark:bg-gray-900">

        <!-- Header -->
        <header class="sticky top-0 z-20 flex items-center justify-between h-16 px-4 pe-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

            <div class="flex items-center gap-2">
                <!-- Tombol hamburger (tidak berguna lagi, jadi boleh dihapus kalau mau) -->
                <button 
                    class="lg:hidden p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                    disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST" class="me-auto ms-4">
                @csrf
                <button type="submit"
                    class="flex items-center justify-left bg-red-600 text-white px-4 py-2 rounded-md font-medium hover:bg-red-700 transition">
                    Logout
                </button>
            </form>

            <!-- Tombol dark mode -->
            <button 
                @click="darkMode = !darkMode" 
                class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 px-3 py-1 rounded-full transition"
            >
                <span x-show="!darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path fill="currentColor" d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2h.1A6.98 6.98 0 0 0 10 7"/></svg>
                </span>
                <span x-show="darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path fill="none" stroke="currentColor" stroke-width="1.5" d="M12 18a6 6 0 1 0 0-12a6 6 0 0 0 0 12m10-6h1M12 2V1m0 22v-1m8-2l-1-1m1-15l-1 1M4 20l1-1M4 4l1 1m-4 7h1"/></svg>
                </span>
            </button>
        </header>

        <!-- Konten -->
        <main class="flex-1 overflow-auto p-4 sm:p-6 text-gray-900 dark:text-gray-100">
            @yield('content')
        </main>

    </div>

</body>
</html>
