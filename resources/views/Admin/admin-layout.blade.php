<!DOCTYPE html>
<html lang="en" class="scroll-smooth" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :data-theme="darkMode ? 'dark' : 'light'"
  x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge"> @vite('resources/css/app.css') <title>Edu Track</title>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="flex min-h-screen bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
  <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
      class="fixed inset-y-0 left-0 z-30 flex w-64 transform flex-col justify-between overflow-y-auto border-r bg-white shadow-lg transition duration-300 lg:static lg:inset-0 lg:translate-x-0 dark:bg-gray-800">
      <div>
        <!-- Bagian atas: Logo + tombol dark mode -->
        <div class="flex items-center space-x-3 px-6 py-4 lg:justify-center">
          <!-- Tombol dark mode di kiri -->
          <button @click="darkMode = !darkMode"
            class="rounded-full bg-white px-3 py-1 text-gray-800 transition dark:bg-gray-800 dark:text-gray-200">
            <span x-show="!darkMode">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                <path fill="currentColor"
                  d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2h.1A6.98 6.98 0 0 0 10 7" />
              </svg>
            </span>
            <span x-show="darkMode">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                <path fill="none" stroke="currentColor" stroke-width="1.5"
                  d="M12 18a6 6 0 1 0 0-12a6 6 0 0 0 0 12m10-6h1M12 2V1m0 22v-1m8-2l-1-1m1-15l-1 1M4 20l1-1M4 4l1 1m-4 7h1" />
              </svg>
            </span>
          </button>

          <!-- Teks Admin Panel -->
          <span class="text-lg font-bold text-gray-800 dark:text-gray-200">Admin Panel</span>

          <!-- Tombol close untuk mobile -->
          <button @click="sidebarOpen = false" class="ml-auto text-gray-700 lg:hidden dark:text-gray-300">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Navigasi utama -->
        <nav class="space-y-2 px-6 py-4">
          <a href="{{ route('admin.admin') }}"
            class="{{ request()->routeIs('admin.admin') ? 'bg-purple-500 text-white' : 'text-gray-700 dark:text-gray-300' }} block rounded px-4 py-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600">
            Dashboard Utama
          </a>
          
          <a href="{{ route('admin.users') }}"
            class="{{ request()->routeIs('admin.users') ? 'bg-purple-500 text-white' : 'text-gray-700 dark:text-gray-300' }} block rounded px-4 py-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600">
            Manajemen Pengguna
          </a>
          <a href="{{ route('admin.mapel') }}"
            class="{{ request()->routeIs('admin.mapel') ? 'bg-purple-500 text-white' : 'text-gray-700 dark:text-gray-300' }} block rounded px-4 py-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600">
            Manajemen Mata Pelajaran
          </a>
          <a href="{{ route('admin.ekskul') }}"
            class="{{ request()->routeIs('admin.ekskul') ? 'bg-purple-500 text-white' : 'text-gray-700 dark:text-gray-300' }} block rounded px-4 py-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600">
            Manajemen Ekstrakurikuler
          </a>
          <a href="{{ route('admin.laporan') }}"
            class="{{ request()->routeIs('admin.laporan') ? 'bg-purple-500 text-white' : 'text-gray-700 dark:text-gray-300' }} block rounded px-4 py-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600">
            Laporan dan Statistik
          </a>
        </nav>
      </div>

      <!-- Bagian bawah: Logout -->
      <div class="px-6 py-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
            class="w-full rounded px-4 py-2 text-left text-red-500 hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-700">
            Logout
          </button>
        </form>
      </div>
    </aside>
  </div>
  <main class="flex-1 overflow-auto p-4 text-gray-900 sm:p-6 dark:text-gray-100"> @yield('content') </main>
</body>

</html>
