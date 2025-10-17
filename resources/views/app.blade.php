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

<body 
    class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex min-h-screen"
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
            '-translate-x-full': !sidebarOpen && window.innerWidth < 1024,
            'translate-x-0': sidebarOpen || window.innerWidth >= 1024,
            'w-20': sidebarCollapsed && window.innerWidth >= 1024,
            'w-64': !sidebarCollapsed && window.innerWidth >= 1024
        }"
    >
        <div class="flex flex-col h-full overflow-hidden">
            
            <!-- Header Sidebar -->
            <div class="flex items-center justify-between ps-7 h-16 px-5 border-b border-gray-200 dark:border-gray-700">
                <a href="{{ url('/') }}" class="flex items-center gap-2 overflow-hidden transition-all duration-300">
                    <svg class="h-6 w-6 text-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/>
                        <path d="M22 10v6"/>
                        <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>
                    </svg>
                    <span class="text-base font-semibold text-gray-900 dark:text-gray-100 whitespace-nowrap"
                          :class="sidebarCollapsed ? 'opacity-0 w-0' : 'opacity-100 w-auto'">
                          EduDashboard
                    </span>
                </a>
            </div>

            <!-- Navigasi Sidebar -->
            <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto overflow-x-hidden text-sm">
                @php
                    $menuItems = [
                        ['route' => 'home', 'url' => '/', 'label' => 'Beranda', 'icon' => '<rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect>'],
                        ['route' => 'pages.guru', 'url' => null, 'label' => 'Dashboard Guru', 'icon' => '<path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>'],
                        ['route' => 'pembina.dashboard', 'url' => null, 'label' => 'Dashboard Pembina', 'icon' => '<path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/>'],
                        ['route' => 'pages.siswa', 'url' => null, 'label' => 'Dashboard Orang Tua', 'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
                    ];
                @endphp

                @foreach($menuItems as $item)
                    <a href="{{ $item['url'] ? url($item['url']) : route($item['route']) }}"
                       :title="sidebarCollapsed ? '{{ $item['label'] }}' : ''"
                       :class="[ 
                           'flex items-center rounded-lg font-medium transition px-4 py-3 gap-3',
                           sidebarCollapsed ? 'justify-center' : 'justify-start',
                           '{{ Route::is($item['route']) || ($item['route'] === 'home' && request()->is('/')) 
                                ? 'bg-blue-600 text-white hover:bg-blue-700' 
                                : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}'
                       ]">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            {!! $item['icon'] !!}
                        </svg>
                        <span x-show="!sidebarCollapsed" class="whitespace-nowrap min-w-0 transition-all duration-300 overflow-hidden">
                            {{ $item['label'] }}
                        </span>
                    </a>
                @endforeach
            </nav>
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center bg-red-600 text-white px-4 py-2 rounded-md font-medium hover:bg-red-700 transition" :class="sidebarCollapsed ? 'opacity-0 w-0' : 'opacity-100 w-auto'">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Konten Utama -->
    <div class="flex flex-col flex-1 transition-all duration-300 bg-[#f8f5ff] dark:bg-gray-900"
         :class="sidebarCollapsed && window.innerWidth >= 1024 ? 'lg:ml-20' : 'lg:ml-64'">

        <!-- Header -->
        <header class="sticky top-0 z-20 flex items-center justify-between h-16 px-4 pe-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

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
                <span x-show="!darkMode"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2h.1A6.98 6.98 0 0 0 10 7m-6 5a8 8 0 0 0 15.062 3.762A9 9 0 0 1 8.238 4.938A8 8 0 0 0 4 12"/></svg></span>
                <span x-show="darkMode"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18a6 6 0 1 0 0-12a6 6 0 0 0 0 12m10-6h1M12 2V1m0 22v-1m8-2l-1-1m1-15l-1 1M4 20l1-1M4 4l1 1m-4 7h1"/></svg></span>
            </button>
        </header>

        <!-- Konten -->
        <main class="flex-1 overflow-auto p-4 sm:p-6 text-gray-900 dark:text-gray-100">
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
