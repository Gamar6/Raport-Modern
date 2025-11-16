<!DOCTYPE html>
<html lang="en"
      class="scroll-smooth transition-all duration-300 ease-in-out"
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
    class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex min-h-screen transition-all duration-300 ease-in-out"
    x-data="sidebarController()"
    x-init="init()"
>

    <!-- Overlay untuk mobile -->
    <div 
        class="fixed inset-0 backdrop-blur-sm bg-black/20 z-30 lg:hidden"
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        x-transition.opacity
    ></div>

    <!-- Sidebar -->
    <aside 
        class="fixed top-0 left-0 z-40 h-full bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out"
        :class="{
            '-translate-x-full': !sidebarOpen && window.innerWidth < 1005,
            'translate-x-0': sidebarOpen || window.innerWidth >= 1024,
            'w-20': sidebarCollapsed && window.innerWidth >= 1024,
            'w-68': !sidebarCollapsed && window.innerWidth >= 1024
        }"
    >
        <div class="flex flex-col h-full overflow-hidden justify-between">
            <div>
              <!-- Header Sidebar -->
              <div class="flex items-center justify-between ps-7 h-16 px-5 border-b border-gray-200 dark:border-gray-700">
                  <a href="{{ url('/') }}" class="flex items-center gap-2 overflow-hidden transition-all duration-300">
                      <svg class="h-6 w-6 text-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/>
                          <path d="M22 10v6"/>
                          <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>
                      </svg>
                      <span class="text-base font-semibold text-gray-900 dark:text-gray-100 whitespace-nowrap transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 w-0' : 'opacity-100 w-auto'">
                            EduDashboard
                      </span>
                  </a>
              </div>

              <!-- Navigasi Sidebar -->
              <nav class="space-y-2 px-3 py-4">
                <!-- Dashboard Utama -->
                <a href="{{ route('admin.admin') }}"
                  class="{{ request()->routeIs('admin.admin') ? 'bg-purple-500 text-white' : 'text-gray-700 dark:text-gray-300' }} flex items-center gap-3 rounded px-4 py-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600 transition-colors duration-200">
                  <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20"/>
                  </svg>
                  <span class="whitespace-nowrap transition-all duration-300" :class="sidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                    Dashboard Utama
                  </span>
                </a>

                <!-- Manajemen Pengguna -->
                <a href="{{ route('admin.users') }}"
                  class="{{ request()->routeIs('admin.users') ? 'bg-purple-500 text-white' : 'text-gray-700 dark:text-gray-300' }} flex items-center gap-3 rounded px-4 py-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600 transition-colors duration-200">
                  <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.4 3.4 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.4 3.4 0 0 0 15 11a3.5 3.5 0 0 0 0-7"/>
                  </svg>
                  <span class="whitespace-nowrap transition-all duration-300" :class="sidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                    Manajemen Pengguna
                  </span>
                </a>

                <!-- Manajemen Mata Pelajaran -->
                <a href="{{ route('admin.mapel') }}"
                  class="{{ request()->routeIs('admin.mapel') ? 'bg-purple-500 text-white' : 'text-gray-700 dark:text-gray-300' }} flex items-center gap-3 rounded px-4 py-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600 transition-colors duration-200">
                  <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.805 5 19s.55-.988 1.012-1H21V4c0-1.103-.897-2-2-2m0 14H5V5c0-.806.55-.988 1-1h13z"/>
                    <path d="M7 7h8v2H7zm0 4h8v2H7z"/>
                  </svg>
                  <span class="whitespace-nowrap transition-all duration-300" :class="sidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                    Manajemen Mata Pelajaran
                  </span>
                </a>

                <!-- Manajemen Ekstrakurikuler -->
                <a href="{{ route('admin.ekskul') }}"
                  class="{{ request()->routeIs('admin.ekskul') ? 'bg-purple-500 text-white' : 'text-gray-700 dark:text-gray-300' }} flex items-center gap-3 rounded px-4 py-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600 transition-colors duration-200">
                  <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2a5 5 0 1 0 5 5a5 5 0 0 0-5-5m0 8a3 3 0 1 1 3-3a3 3 0 0 1-3 3m9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"/>
                    <path d="M20.5 14.5a2 2 0 1 0 2 2a2 2 0 0 0-2-2m0 2.5a.5.5 0 1 1 .5-.5a.5.5 0 0 1-.5.5m-17-2.5a2 2 0 1 0 2 2a2 2 0 0 0-2-2m0 2.5a.5.5 0 1 1 .5-.5a.5.5 0 0 1-.5.5"/>
                  </svg>
                  <span class="whitespace-nowrap transition-all duration-300" :class="sidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                    Manajemen Ekstrakurikuler
                  </span>
                </a>

                <!-- Laporan dan Statistik -->
                <a href="{{ route('admin.laporan') }}"
                  class="{{ request()->routeIs('admin.laporan') ? 'bg-purple-500 text-white' : 'text-gray-700 dark:text-gray-300' }} flex items-center gap-3 rounded px-4 py-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600 transition-colors duration-200">
                  <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 3v16a2 2 0 0 0 2 2h16v-2H5V3zm16 6v10h2V9zm-4 8h2V5h-2zm-4 0h2v-6h-2zm-4 0h2v-4H7z"/>
                  </svg>
                  <span class="whitespace-nowrap transition-all duration-300" :class="sidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                    Laporan dan Statistik
                  </span>
                </a>
              </nav>
            </div>  
            
            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 px-3 py-4">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center lg:justify-start gap-2 bg-red-600 text-white px-4 py-2 rounded-md font-medium hover:bg-red-700 transition-colors duration-200">
                        <!-- Icon Logout -->
                        <svg class="w-6 h-6 flex-shrink-0 mx-auto lg:mx-0 transition-all duration-300"
                             :class="sidebarCollapsed ? 'mx-auto' : 'mx-0'"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/>
                        </svg>
                        <!-- Logout Text -->
                        <span 
                            class="whitespace-nowrap transition-all duration-300"
                            :class="sidebarCollapsed 
                                ? 'opacity-0 w-0 overflow-hidden' 
                                : 'opacity-100 w-auto'">
                            Logout
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Konten Utama -->
    <div class="flex flex-col flex-1 transition-all duration-300 ease-in-out bg-[#f8f5ff] dark:bg-gray-900"
      :class="sidebarCollapsed && window.innerWidth >= 1024 ? 'lg:ml-20' : 'lg:ml-67'">

        <!-- Header -->
        <header class="sticky top-0 z-20 flex items-center justify-between h-16 px-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out">
            <div class="flex items-center gap-2">
                <!-- Tombol hamburger untuk mobile -->
                <button 
                    class="lg:hidden p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                    @click="sidebarOpen = !sidebarOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 text-gray-600 dark:text-gray-200">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Tombol collapse sidebar untuk desktop -->
                <button 
                    class="hidden lg:flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                    @click="toggleCollapse()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 text-gray-600 dark:text-gray-200">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Tombol dark mode -->
            <button 
                @click="darkMode = !darkMode" 
                class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 px-3 py-1 rounded-full focus:outline-none transition"
                aria-label="Toggle Dark Mode"
            >
                <span x-show="!darkMode">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2h.1A6.98 6.98 0 0 0 10 7m-6 5a8 8 0 0 0 15.062 3.762A9 9 0 0 1 8.238 4.938A8 8 0 0 0 4 12"/>
                  </svg>
                </span>
                <span x-show="darkMode">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a6 6 0 1 0 0-12a6 6 0 0 0 0 12m10-6h1M12 2V1m0 22v-1m8-2l-1-1m1-15l-1 1M4 20l1-1M4 4l1 1m-4 7h1"/>
                  </svg>
                </span>
            </button>
        </header>

        <!-- Konten -->
        <main class="flex flex-col flex-1 transition-all duration-300 ease-in-out bg-[#f8f5ff] dark:bg-gray-900">
            @yield('content')
        </main>
    </div>

<script>
function sidebarController() {
    return {
        sidebarOpen: false,
        sidebarCollapsed: false,
        init() {
            const saved = localStorage.getItem('sidebarCollapsed');
            if (saved !== null) {
                this.sidebarCollapsed = JSON.parse(saved);
            }
        },
        toggleCollapse() {
            this.sidebarCollapsed = !this.sidebarCollapsed;
            localStorage.setItem('sidebarCollapsed', JSON.stringify(this.sidebarCollapsed));
        }
    }
}
</script>
</body>
</html>