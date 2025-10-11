<!DOCTYPE html>
<html lang="en" class="scroll-smooth" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" 
    :class="{ 'dark': darkMode }" 
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
>
<head>
    <meta charset="UTF-8" />
    <title>Potensi Siswa</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">

    <nav class="bg-blue-600 dark:bg-gray-800 text-white px-6 py-4 flex justify-between items-center max-w-6xl mx-auto">
        <h1 class="text-xl font-semibold">🎓 Analisis Potensi Siswa</h1>
        
        <!-- Dark mode toggle -->
        <button 
            @click="darkMode = !darkMode" 
            class="bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-3 py-1 rounded focus:outline-none"
            aria-label="Toggle Dark Mode"
        >
            <span x-show="!darkMode">🌙</span>
            <span x-show="darkMode">☀️</span>
        </button>

    </nav>

    <main class="py-10 px-6 max-w-6xl mx-auto">
        @yield('content')
    </main>

</body>
</html>
