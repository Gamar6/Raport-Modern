<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduDashboard - @yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="flex h-screen bg-gray-50 font-sans text-gray-800" x-data="{ sidebarCollapsed: false, darkMode: false }">

    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 z-40 h-screen bg-white border-r border-gray-200 transition-all duration-300"
           :class="sidebarCollapsed ? 'w-20' : 'w-64'">
        <div class="flex flex-col h-full">

            <!-- Header Sidebar -->
            <div class="flex items-center justify-between h-16 px-5 border-b border-gray-200 bg-white">
                <a href="{{ url('/') }}">
                    <div class="flex items-center gap-2 overflow-hidden transition-all duration-300"
                         :class="sidebarCollapsed ? 'opacity-0 w-0' : 'opacity-100'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/>
                            <path d="M22 10v6"/>
                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>
                        </svg>
                        <span class="text-base font-semibold text-gray-900 whitespace-nowrap">EduDashboard</span>
                    </div>
                </a>

                <!-- Tombol Toggle Sidebar -->
                <button class="p-1.5 rounded hover:bg-gray-100 flex-shrink-0"
                        @click="sidebarCollapsed = !sidebarCollapsed"
                        :class="sidebarCollapsed ? 'mx-auto' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
            </div>

            <!-- Navigasi Sidebar -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <!-- Beranda -->
                <a href="{{ url('/') }}"
                   class="flex items-center rounded-lg font-medium transition group relative
                   {{ Route::is('home') || request()->is('/') ? 'bg-blue-600 text-white hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
                   :class="sidebarCollapsed ? 'px-0 py-3 justify-center' : 'px-4 py-3 gap-3'"
                   x-data="{ showTooltip: false }"
                   @mouseenter="showTooltip = sidebarCollapsed"
                   @mouseleave="showTooltip = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <rect width="7" height="9" x="3" y="3" rx="1"></rect>
                        <rect width="7" height="5" x="14" y="3" rx="1"></rect>
                        <rect width="7" height="9" x="14" y="12" rx="1"></rect>
                        <rect width="7" height="5" x="3" y="16" rx="1"></rect>
                    </svg>
                    <span :class="sidebarCollapsed ? 'hidden' : 'block'">Beranda</span>
                </a>

                <!-- Dashboard Guru -->
                <a href="{{ route('guru') }}"
                   class="flex items-center rounded-lg font-medium transition group relative
                   {{ Route::is('guru') ? 'bg-blue-600 text-white hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
                   :class="sidebarCollapsed ? 'px-0 py-3 justify-center' : 'px-4 py-3 gap-3'"
                   x-data="{ showTooltip: false }"
                   @mouseenter="showTooltip = sidebarCollapsed"
                   @mouseleave="showTooltip = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                    <span :class="sidebarCollapsed ? 'hidden' : 'block'">Dashboard Guru</span>
                </a>

                <!-- Dashboard Pembina -->
                <a href="{{ route('pembina') }}"
                   class="flex items-center rounded-lg font-medium transition group relative
                   {{ Route::is('pembina') ? 'bg-blue-600 text-white hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
                   :class="sidebarCollapsed ? 'px-0 py-3 justify-center' : 'px-4 py-3 gap-3'"
                   x-data="{ showTooltip: false }"
                   @mouseenter="showTooltip = sidebarCollapsed"
                   @mouseleave="showTooltip = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/>
                        <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/>
                        <path d="M4 22h16"/>
                        <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/>
                        <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/>
                        <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/>
                    </svg>
                    <span :class="sidebarCollapsed ? 'hidden' : 'block'">Dashboard Pembina</span>
                </a>

                <!-- Dashboard Orang Tua -->
                <a href="{{ route('orangtua') }}"
                   class="flex items-center rounded-lg font-medium transition group relative
                   {{ Route::is('orangtua') ? 'bg-blue-600 text-white hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
                   :class="sidebarCollapsed ? 'px-0 py-3 justify-center' : 'px-4 py-3 gap-3'"
                   x-data="{ showTooltip: false }"
                   @mouseenter="showTooltip = sidebarCollapsed"
                   @mouseleave="showTooltip = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <span :class="sidebarCollapsed ? 'hidden' : 'block'">Dashboard OrangTua<br>dan siswa</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col transition-all duration-300"
         :class="sidebarCollapsed ? 'ml-20' : 'ml-64'">

        <!-- Header -->
        <header class="sticky top-0 z-30 flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200">
            <div class="flex items-center gap-3">
                <h1 class="text-xl font-semibold text-gray-900">@yield('title', 'Dashboard Guru')</h1>
            </div>

            <!-- Dark mode toggle -->
            <button class="relative inline-flex items-center justify-center h-10 w-10 rounded-full text-gray-600 hover:bg-gray-100 transition"
                    @click="darkMode = !darkMode" :class="{'bg-gray-800 text-white': darkMode}">
                <!-- Sun icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" :class="{'hidden': darkMode}" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round">
                    <circle cx="12" cy="12" r="4"/>
                    <path d="M12 2v2"/>
                    <path d="M12 20v2"/>
                    <path d="m4.93 4.93 1.41 1.41"/>
                    <path d="m17.66 17.66 1.41 1.41"/>
                    <path d="M2 12h2"/>
                    <path d="M20 12h2"/>
                    <path d="m6.34 17.66-1.41 1.41"/>
                    <path d="m19.07 4.93-1.41 1.41"/>
                </svg>
                <!-- Moon icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute" :class="{'hidden': !darkMode}" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
                </svg>
            </button>
        </header>

        <!-- Konten utama -->
        <main class="flex-1 overflow-auto p-6 bg-gray-50">
            @yield('content')
        </main>

    </div>
</body>
</html>
