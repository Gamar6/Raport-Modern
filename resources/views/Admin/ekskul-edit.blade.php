@extends('Admin.admin-layout')

@section('title', 'Edit Data Pembina')

@section('content')
<div class="container mx-auto max-w-3xl px-4 py-8">

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between animate-fade-in-up">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Penugasan Pembina</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Atur ekstrakurikuler untuk <span class="font-semibold text-orange-600 dark:text-orange-400">{{ $pembina->nama }}</span>.
            </p>
        </div>

        <a href="{{ route('admin.ekskul') }}" 
           class="group inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 hover:text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-100">
        
        <div class="border-b border-gray-100 bg-orange-50/50 px-6 py-4 dark:border-gray-700 dark:bg-orange-900/10">
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-100 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" /></svg>
                </div>
                <h2 class="text-sm font-bold text-gray-900 dark:text-white">Form Edit Data</h2>
            </div>
        </div>

        <form action="{{ route('admin.ekskul.update', $pembina->id) }}" method="POST" class="p-6 md:p-8" x-data="{ mode: 'select' }">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                
                <div class="col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nama Pembina</label>
                    <input type="text" name="nama" value="{{ $pembina->nama }}" required
                        class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 px-4 text-sm font-medium text-gray-900 focus:border-orange-500 focus:ring-orange-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white transition-all">
                </div>

                <div class="col-span-2">
                    <div class="mb-2 flex items-center justify-between">
                        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Tugaskan ke Ekskul</label>
                        <button type="button" @click="mode = (mode === 'select' ? 'create' : 'select')" class="text-xs font-bold text-orange-600 hover:underline dark:text-orange-400 transition-colors">
                            <span x-show="mode === 'select'">+ Buat Ekskul Baru</span>
                            <span x-show="mode === 'create'">Kembali ke Daftar</span>
                        </button>
                    </div>

                    <div x-show="mode === 'select'" x-transition.opacity>
                        <div class="relative">
                            <select name="ekskul_id" class="w-full appearance-none rounded-xl border-gray-200 bg-gray-50 p-3 pl-10 text-sm font-medium text-gray-900 focus:border-orange-500 focus:ring-orange-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white transition-all">
                                
                                <option value="" {{ is_null($pembina->ekskul_id) ? 'selected' : '' }}>-- Tidak Mengampu (Kosongkan) --</option>
                                
                                @foreach ($ekskuls as $ekskulItem)
                                    @php
                                        // Cek apakah ekskul ini punya pembina?
                                        // Dan pembinanya BUKAN pembina yang sedang diedit
                                        $currentOwner = $ekskulItem->pembina;
                                        $isTaken = $currentOwner && $currentOwner->id != $pembina->id;
                                    @endphp
                                    
                                    <option value="{{ $ekskulItem->id }}" 
                                        {{-- Jika pembina ini sudah punya ekskul ini, select it --}}
                                        {{ $pembina->ekskul_id == $ekskulItem->id ? 'selected' : '' }}
                                        class="{{ $isTaken ? 'text-red-600 font-bold' : '' }}">
                                        
                                        {{ $ekskulItem->nama }} 
                                        {{-- Tampilkan info jika ekskul ini milik orang lain --}}
                                        {{ $isTaken ? '(Milik: ' . $currentOwner->nama . ' - Akan Dipindah)' : '' }}
                                    </option>
                                @endforeach

                            </select>
                            
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h14.25a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.312-3.139h-.004c.03-5.427-4.239-9.613-9.927-9.781zM20.5 14a.75.75 0 00.75-1.359c-1.035-.148-2.059-.33-3.071-.543a6.753 6.753 0 00-6.138-5.6 6.73 6.73 0 00-2.743-1.346A6.707 6.707 0 0114.721 9h.739c5.689.168 9.957 4.354 9.927 9.781z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                        <p class="mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                            *Memilih ekskul yang sudah punya pembina akan otomatis memindahkannya ke pembina ini.
                        </p>
                    </div>

                    <div x-show="mode === 'create'" x-transition.opacity style="display: none;">
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                            </div>
                            <input type="text" name="new_ekskul_nama" 
                                class="w-full rounded-xl border-orange-300 bg-orange-50 py-3 pl-10 pr-3 text-sm font-medium text-gray-900 placeholder-gray-400 focus:border-orange-500 focus:ring-orange-500 dark:border-orange-700 dark:bg-gray-800 dark:text-white transition-all"
                                placeholder="Nama Ekskul Baru (Contoh: Robotik)">
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-3 border-t border-gray-100 pt-6 dark:border-gray-700">
                <a href="{{ route('admin.ekskul') }}" class="rounded-xl px-6 py-2.5 text-sm font-bold text-gray-600 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Batal</a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-orange-500 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-orange-500/20 transition-all hover:bg-orange-600 hover:shadow-orange-600/30 active:scale-[0.98]">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection