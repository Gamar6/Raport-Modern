<!DOCTYPE html>
<html lang="en"
      class="scroll-smooth"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      :class="{ 'dark': darkMode }"
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

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex min-h-screen">

    <!-- Konten Utama -->
    <div class="flex flex-col flex-1 bg-[#f8f5ff] dark:bg-gray-900">

        <!-- Header -->
        <header class="sticky top-0 z-20 flex items-center justify-between h-16 px-4 pe-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

            <div class="flex items-center gap-2">
                <!-- Tombol hamburger dihapus karena tidak ada sidebar -->
            </div>

            <!-- Tombol dark mode -->
            <button 
                @click="darkMode = !darkMode" 
                class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 px-3 py-1 rounded-full focus:outline-none transition"
                aria-label="Toggle Dark Mode"
            >
                <span x-show="!darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2h.1A6.98 6.98 0 0 0 10 7m-6 5a8 8 0 0 0 15.062 3.762A9 9 0 0 1 8.238 4.938A8 8 0 0 0 4 12"/>
                    </svg>
                </span>

                <span x-show="darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18a6 6 0 1 0 0-12a6 6 0 0 0 0 12m10-6h1M12 2V1m0 22v-1m8-2l-1-1m1-15l-1 1M4 20l1-1M4 4l1 1m-4 7h1"/>
                    </svg>
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
