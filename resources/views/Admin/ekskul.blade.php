@extends('Admin.admin-layout')

@section('title', 'Manajemen Ekstrakurikuler')

@section('content')
<div class="min-h-screen space-y-8 bg-gray-50/50 p-6 transition-colors duration-300 dark:bg-gray-900"
     x-data="{ 
        search: '', 
        isVisible(pembina, ekskul) {
            const lowerSearch = this.search.toLowerCase();
            return pembina.toLowerCase().includes(lowerSearch) || 
                   ekskul.toLowerCase().includes(lowerSearch);
        }
     }">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between animate-fade-in-up">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Data Pembina & Ekskul</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola penugasan pembina untuk setiap kegiatan ekstrakurikuler.</p>
        </div>
        
        <div class="relative w-full md:w-72">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" x-model="search" placeholder="Cari pembina atau ekskul..." 
                   class="w-full rounded-xl border-gray-200 bg-white py-2.5 pl-10 text-sm font-medium text-gray-900 focus:border-orange-500 focus:ring-orange-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white transition-all shadow-sm">
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
                        <th class="px-6 py-4">Nama Pembina</th>
                        <th class="px-6 py-4">Ekstrakurikuler Diampu</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($pembinas as $pembina)
                        <tr x-show="isVisible('{{ $pembina->nama }}', '{{ $pembina->ekskul->nama ?? '' }}')" 
                            x-transition.opacity.duration.300ms
                            class="group hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors">
                            
                            <td class="px-6 py-4 text-center text-gray-400 font-medium">{{ $loop->iteration }}</td>
                            
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-100 text-orange-600 text-sm font-bold ring-2 ring-white dark:ring-gray-800 dark:bg-orange-900 dark:text-orange-300">
                                        {{ strtoupper(substr($pembina->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="block font-semibold text-gray-900 dark:text-white">{{ $pembina->nama }}</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $pembina->id }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @if($pembina->ekskul)
                                    <span class="inline-flex items-center gap-1.5 rounded-md bg-purple-50 px-3 py-1 text-xs font-bold text-purple-700 ring-1 ring-inset ring-purple-700/10 dark:bg-purple-900/30 dark:text-purple-300">
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h14.25a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.312-3.139h-.004c.03-5.427-4.239-9.613-9.927-9.781zM20.5 14a.75.75 0 00.75-1.359c-1.035-.148-2.059-.33-3.071-.543a6.753 6.753 0 00-6.138-5.6 6.73 6.73 0 00-2.743-1.346A6.707 6.707 0 0114.721 9h.739c5.689.168 9.957 4.354 9.927 9.781z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $pembina->ekskul->nama }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                        Belum ada ekskul
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.ekskul.edit', $pembina->id) }}" 
                                   class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-600 ring-1 ring-inset ring-amber-600/20 transition-all hover:bg-amber-100 hover:text-amber-700 dark:bg-amber-900/20 dark:text-amber-400 dark:hover:bg-amber-900/40">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                    </svg>
                                    Atur Ekskul
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 mb-3">
                                        <svg class="h-6 w-6 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="text-base font-medium">Belum ada data pembina.</p>
                                    <p class="text-xs mt-1">Pastikan Anda sudah menambahkan user dengan role Pembina.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="flex items-center justify-between border-t border-gray-100 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/30">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Menampilkan <span class="font-bold text-gray-900 dark:text-white">{{ $pembinas->count() }}</span> pembina
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