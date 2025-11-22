<!DOCTYPE html>
<html lang="en"
      class="scroll-smooth transition-all duration-300 ease-in-out"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" 
      :data-theme="darkMode ? 'dark' : 'light'"
      :class="{ 'dark': darkMode }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <title>EduTrack System</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body 
    class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex min-h-screen transition-all duration-300 ease-in-out"
    x-data="sidebarController()"
    x-init="init()"
>

    <div 
        class="fixed inset-0 backdrop-blur-sm bg-gray-900/50 z-30 lg:hidden"
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        x-transition.opacity
    ></div>

    <aside 
        class="fixed top-0 left-0 z-40 h-full bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out flex flex-col justify-between"
        :class="{
            '-translate-x-full': !sidebarOpen && window.innerWidth < 1024,
            'translate-x-0': sidebarOpen || window.innerWidth >= 1024,
            'w-20': sidebarCollapsed && window.innerWidth >= 1024,
            'w-64': !sidebarCollapsed && window.innerWidth >= 1024
        }"
    >
        <div>
            <div class="flex h-16 items-center border-b border-gray-200 dark:border-gray-700 px-4"
                 :class="sidebarCollapsed ? 'justify-center' : 'justify-between'">
                
                <a href="{{ url('/') }}" class="flex items-center gap-3 overflow-hidden group">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white shadow-md shadow-blue-600/20 transition-transform group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                            <path d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 001.402 10.06a.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                            <path d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 0110.94 15.473c.545.298 1.575.298 2.12 0z" />
                            <path d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
                        </svg>
                    </div>
                    <span class="whitespace-nowrap text-lg font-bold tracking-tight text-gray-900 dark:text-white transition-opacity duration-300"
                          :class="sidebarCollapsed ? 'opacity-0 w-0 hidden' : 'opacity-100'">
                        Edu<span class="text-blue-600">Track</span>
                    </span>
                </a>

                <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="mt-6 space-y-1 px-3">
                
                <a href="{{ route('admin.admin') }}"
                   class="group relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200
                   {{ request()->routeIs('admin.admin') 
                      ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' 
                      : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white' }}"
                   :class="sidebarCollapsed ? 'justify-center' : ''">
                    
                    <svg class="h-6 w-6 flex-shrink-0 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                        <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                    </svg>
                    
                    <span class="whitespace-nowrap transition-all duration-300"
                          :class="sidebarCollapsed ? 'opacity-0 w-0 hidden' : 'opacity-100'">
                        Dashboard Utama
                    </span>

                    <div x-show="sidebarCollapsed" x-cloak class="absolute left-14 z-50 rounded-md bg-gray-900 px-2 py-1 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity group-hover:opacity-100 pointer-events-none dark:bg-gray-700">
                        Dashboard
                    </div>
                </a>

                <a href="{{ route('admin.users') }}"
                   class="group relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200
                   {{ request()->routeIs('admin.users') 
                      ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' 
                      : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white' }}"
                   :class="sidebarCollapsed ? 'justify-center' : ''">
                    
                    <svg class="h-6 w-6 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                    </svg>
                    <span class="whitespace-nowrap transition-all duration-300" :class="sidebarCollapsed ? 'opacity-0 w-0 hidden' : 'opacity-100'">
                        Manajemen Pengguna
                    </span>
                    
                    <div x-show="sidebarCollapsed" x-cloak class="absolute left-14 z-50 rounded-md bg-gray-900 px-2 py-1 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity group-hover:opacity-100 pointer-events-none dark:bg-gray-700">
                        Pengguna
                    </div>
                </a>

                <a href="{{ route('admin.mapel') }}"
                   class="group relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200
                   {{ request()->routeIs('admin.mapel') 
                      ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' 
                      : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white' }}"
                   :class="sidebarCollapsed ? 'justify-center' : ''">
                    
                    <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M19 2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.805 5 19s.55-.988 1.012-1H21V4c0-1.103-.897-2-2-2m0 14H5V5c0-.806.55-.988 1-1h13z"/>
                      <path d="M7 7h8v2H7zm0 4h8v2H7z"/>
                    </svg>
                  
                    <span class="whitespace-nowrap transition-all duration-300" :class="sidebarCollapsed ? 'opacity-0 w-0 hidden' : 'opacity-100'">
                        Mata Pelajaran
                    </span>
                  
                    <div x-show="sidebarCollapsed" x-cloak class="absolute left-14 z-50 rounded-md bg-gray-900 px-2 py-1 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity group-hover:opacity-100 pointer-events-none dark:bg-gray-700">
                        Mapel
                    </div>
                </a>

                <a href="{{ route('admin.ekskul') }}"
                   class="group relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200
                   {{ request()->routeIs('admin.ekskul') 
                      ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' 
                      : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white' }}"
                   :class="sidebarCollapsed ? 'justify-center' : ''">
                    
                    <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M12 2a5 5 0 1 0 5 5a5 5 0 0 0-5-5m0 8a3 3 0 1 1 3-3a3 3 0 0 1-3 3m9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"/>
                      <path d="M20.5 14.5a2 2 0 1 0 2 2a2 2 0 0 0-2-2m0 2.5a.5.5 0 1 1 .5-.5a.5.5 0 0 1-.5.5m-17-2.5a2 2 0 1 0 2 2a2 2 0 0 0-2-2m0 2.5a.5.5 0 1 1 .5-.5a.5.5 0 0 1-.5.5"/>
                    </svg>
                    <span class="whitespace-nowrap transition-all duration-300" :class="sidebarCollapsed ? 'opacity-0 w-0 hidden' : 'opacity-100'">
                        Ekstrakurikuler
                    </span>

                    <div x-show="sidebarCollapsed" x-cloak class="absolute left-14 z-50 rounded-md bg-gray-900 px-2 py-1 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity group-hover:opacity-100 pointer-events-none dark:bg-gray-700">
                        Ekskul
                    </div>
                </a>

                <a href="{{ route('admin.laporan') }}"
                   class="group relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200
                   {{ request()->routeIs('admin.laporan') 
                      ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' 
                      : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white' }}"
                   :class="sidebarCollapsed ? 'justify-center' : ''">
                    
                    <svg class="h-6 w-6 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z" clip-rule="evenodd" />
                    </svg>
                    <span class="whitespace-nowrap transition-all duration-300" :class="sidebarCollapsed ? 'opacity-0 w-0 hidden' : 'opacity-100'">
                        Laporan & Statistik
                    </span>

                    <div x-show="sidebarCollapsed" x-cloak class="absolute left-14 z-50 rounded-md bg-gray-900 px-2 py-1 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity group-hover:opacity-100 pointer-events-none dark:bg-gray-700">
                        Laporan
                    </div>
                </a>

            </nav>
        </div>

        <div class="border-t border-gray-200 p-4 dark:border-gray-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="group flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20 transition-colors"
                        :class="sidebarCollapsed ? 'justify-center' : ''">
                    
                    <svg class="h-6 w-6 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                    
                    <span class="whitespace-nowrap transition-all duration-300"
                          :class="sidebarCollapsed ? 'opacity-0 w-0 hidden' : 'opacity-100'">
                        Keluar
                    </span>

                    <div x-show="sidebarCollapsed" x-cloak class="absolute left-14 z-50 rounded-md bg-gray-900 px-2 py-1 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity group-hover:opacity-100 pointer-events-none dark:bg-gray-700">
                        Keluar
                    </div>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex flex-col flex-1 transition-all duration-300 ease-in-out bg-[#f8f5ff] dark:bg-gray-900"
         :class="sidebarCollapsed && window.innerWidth >= 1024 ? 'lg:ml-20' : 'lg:ml-64'">

        <header class="sticky top-0 z-20 flex items-center justify-between h-16 px-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out">
            <div class="flex items-center gap-2">
                <button class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition text-gray-600 dark:text-gray-200"
                        @click="sidebarOpen = !sidebarOpen">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>

                <button class="hidden lg:flex p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition text-gray-600 dark:text-gray-200"
                        @click="toggleCollapse()">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
            </div>

            <button @click="darkMode = !darkMode" 
                    class="bg-white dark:bg-gray-800 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white p-2 rounded-full transition">
                <span x-show="!darkMode">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </span>
                <span x-show="darkMode" x-cloak>
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                </span>
            </button>
        </header>

        <main class="flex-1 p-6">
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
                
                // Auto-close sidebar on mobile resize
                window.addEventListener('resize', () => {
                    if(window.innerWidth >= 1024) {
                        this.sidebarOpen = false;
                    }
                });
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