@extends('Admin.admin-layout')

@section('title', 'Manajemen Mata Pelajaran')

@section('content')
<div class="min-h-screen space-y-8 bg-gray-50/50 p-6 transition-colors duration-300 dark:bg-gray-900"
     x-data="{ 
        search: '', 
        isVisible(nama, mapel, nip) {
            const lowerSearch = this.search.toLowerCase();
            return nama.toLowerCase().includes(lowerSearch) || 
                   mapel.toLowerCase().includes(lowerSearch) ||
                   (nip && nip.toLowerCase().includes(lowerSearch));
        }
     }">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between animate-fade-in-up">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Mata Pelajaran</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola mata pelajaran dan guru pengampu.</p>
        </div>
        
        <div class="relative w-full md:w-72">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" x-model="search" placeholder="Cari guru, mapel, atau NIP..." 
                   class="w-full rounded-xl border-gray-200 bg-white py-2.5 pl-10 text-sm font-medium text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white transition-all shadow-sm">
        </div>
    </div>

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity 
             class="flex items-center justify-between rounded-xl border border-emerald-100 bg-emerald-50 p-4 text-emerald-800 shadow-sm dark:border-emerald-900/50 dark:bg-emerald-900/20 dark:text-emerald-400 animate-fade-in-up delay-100">
            <div class="flex items-center gap-3">
                <svg class="h-5 w-5 flex-shrink-0 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 dark:hover:text-emerald-300">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:bg-gray-700/50 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Nama Guru</th>
                        <th class="px-6 py-4">NIP</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($gurus as $guru)
                        <tr x-show="isVisible('{{ $guru->namaGuru }}', '{{ $guru->mapel }}', '{{ $guru->nip ?? '' }}')" 
                            x-transition.opacity.duration.300ms
                            class="group hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors">
                            
                            <td class="px-6 py-4 text-center text-gray-400 font-medium">{{ $loop->iteration }}</td>
                            
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 text-sm font-bold ring-2 ring-white dark:ring-gray-800 dark:bg-indigo-900 dark:text-indigo-300">
                                        {{ strtoupper(substr($guru->namaGuru, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="block font-semibold text-gray-900 dark:text-white">{{ $guru->namaGuru }}</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $guru->id }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="font-mono text-xs text-gray-600 dark:text-gray-400 bg-gray-100 px-2 py-1 rounded dark:bg-gray-700">
                                    {{ $guru->nip ?? '-' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @if($guru->mapel && $guru->mapel !== '-')
                                    <span class="inline-flex items-center gap-1.5 rounded-md bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-900/30 dark:text-blue-300">
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M11.25 4.533A9.707 9.707 0 0 0 6 3.75a9.706 9.706 0 0 0-6 2.033m11.25 0v11.25c0-.621.504-1.125 1.125-1.125h9.75c.621 0 1.125.504 1.125 1.125V9.375c0-.621-.504-1.125-1.125-1.125H13.125A2.25 2.25 0 0 0 11.25 6V4.533Z" />
                                            <path d="M2.25 6v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V6a2.25 2.25 0 0 0-2.25-2.25H3.375A1.125 1.125 0 0 0 2.25 6Z" />
                                        </svg>
                                        {{ $guru->mapel }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic text-xs">Belum ada mapel</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.mapel.edit', $guru->id) }}" 
                                   class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-600 ring-1 ring-inset ring-amber-600/20 transition-all hover:bg-amber-100 hover:text-amber-700 dark:bg-amber-900/20 dark:text-amber-400 dark:hover:bg-amber-900/40">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                    </svg>
                                    Edit Mapel
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 mb-3">
                                        <svg class="h-6 w-6 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625Z" />
                                            <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                        </svg>
                                    </div>
                                    <p class="text-base font-medium">Belum ada data guru.</p>
                                    <p class="text-xs mt-1">Pastikan Anda sudah menambahkan user dengan role Guru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="flex items-center justify-between border-t border-gray-100 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/30">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Menampilkan <span class="font-bold text-gray-900 dark:text-white">{{ $gurus->count() }}</span> data guru
            </p>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
</style>
@endsection