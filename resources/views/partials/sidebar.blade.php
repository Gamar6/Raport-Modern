<aside class="w-64 bg-white border-r border-gray-200 shadow-sm">
    <div class="p-6 flex items-center gap-2 border-b">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
        </svg>
        <span class="font-bold text-lg text-gray-800">EduDashboard</span>
    </div>

    <nav class="p-4 space-y-2">
        <a href="{{ route('guru.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">
           <x-lucide-layout-dashboard class="w-5 h-5"/> Dashboard
        </a>

        <a href="{{ route('siswa.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">
           <x-lucide-user class="w-5 h-5"/> Siswa
        </a>

        <a href="{{ route('akademik.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">
           <x-lucide-book class="w-5 h-5"/> Akademik
        </a>

        <a href="{{ route('ekskul.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">
           <x-lucide-trophy class="w-5 h-5"/> Ekstrakurikuler
        </a>
    </nav>
</aside>
