@extends('Admin.admin-layout')

@section('title', 'Edit Mata Pelajaran & Kelas')

@section('content')
<div class="container mx-auto max-w-4xl px-4 py-8">

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between animate-fade-in-up">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Edit Pengampu</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Atur detail mata pelajaran dan kelas ajar untuk <span class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $guru->namaGuru }}</span>.
            </p>
        </div>

        <a href="{{ route('admin.mapel') }}" 
           class="group inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 hover:text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.mapel.update', $guru->id) }}" method="POST" class="space-y-8 animate-fade-in-up delay-100">
        @csrf
        @method('PUT')
        
        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-100 bg-indigo-50/50 px-6 py-4 dark:border-gray-700 dark:bg-indigo-900/10">
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M11.25 4.533A9.707 9.707 0 0 0 6 3.75a9.706 9.706 0 0 0-6 2.033m11.25 0v11.25c0-.621.504-1.125 1.125-1.125h9.75c.621 0 1.125.504 1.125 1.125V9.375c0-.621-.504-1.125-1.125-1.125H13.125A2.25 2.25 0 0 0 11.25 6V4.533Z" /><path d="M2.25 6v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V6a2.25 2.25 0 0 0-2.25-2.25H3.375A1.125 1.125 0 0 0 2.25 6Z" /></svg>
                    </div>
                    <h2 class="text-sm font-bold text-gray-900 dark:text-white">Informasi Dasar</h2>
                </div>
            </div>

            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2 md:col-span-1">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nama Guru</label>
                    <input type="text" name="namaGuru" value="{{ $guru->namaGuru }}" required
                        class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 px-4 text-sm font-medium text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white transition-all">
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">NIP</label>
                    <input type="text" name="nip" value="{{ $guru->nip }}" required
                        class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 px-4 text-sm font-medium text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white transition-all">
                </div>

                <div class="col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Mata Pelajaran</label>
                    <input type="text" name="mapel" value="{{ $guru->mapel }}" required
                        class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 px-4 text-sm font-medium text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white transition-all"
                        placeholder="Contoh: Matematika">
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-100 bg-blue-50/50 px-6 py-4 dark:border-gray-700 dark:bg-blue-900/10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 7C3 5.89543 3.89543 5 5 5H19C20.1046 5 21 5.89543 21 7V15C21 16.1046 20.1046 17 19 17H5C3.89543 17 3 16.1046 3 15V7Z"/><path d="M7 17V21M17 17V21M12 17V19" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-gray-900 dark:text-white">Kelas yang Diampu</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Centang kelas yang diajar oleh guru ini.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8">
                @if($semuaKelas->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        Belum ada data kelas. Silakan tambahkan kelas di database terlebih dahulu.
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach ($semuaKelas as $kelas)
                            <label class="group relative flex cursor-pointer items-center justify-center rounded-xl border-2 p-4 transition-all hover:shadow-md
                                {{ $guru->kelas->contains($kelas->id) 
                                    ? 'border-indigo-600 bg-indigo-50/50 dark:border-indigo-500 dark:bg-indigo-900/20' 
                                    : 'border-gray-100 bg-white hover:border-indigo-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:border-indigo-500/50' 
                                }}">
                                
                                <input type="checkbox" name="kelas[]" value="{{ $kelas->id }}" 
                                    class="peer sr-only"
                                    {{ $guru->kelas->contains($kelas->id) ? 'checked' : '' }}>
                                
                                <div class="text-center">
                                    <span class="block text-lg font-bold transition-colors
                                        {{ $guru->kelas->contains($kelas->id) 
                                            ? 'text-indigo-700 dark:text-indigo-300' 
                                            : 'text-gray-600 group-hover:text-indigo-600 dark:text-gray-400 dark:group-hover:text-indigo-400' 
                                        }}">
                                        {{ $kelas->namaKelas }}
                                    </span>
                                </div>

                                <div class="absolute top-2 right-2 opacity-0 transition-opacity peer-checked:opacity-100">
                                    <div class="flex h-5 w-5 items-center justify-center rounded-full bg-indigo-600 text-white">
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4">
            <a href="{{ route('admin.mapel') }}" 
               class="rounded-xl px-6 py-3 text-sm font-bold text-gray-600 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Batal
            </a>
            <button type="submit" 
                    class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-8 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition-all hover:bg-indigo-700 hover:shadow-indigo-600/30 active:scale-[0.98]">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 0 1 1.04-.208Z" clip-rule="evenodd" /></svg>
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.1s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="kelas[]"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const parent = this.closest('label');
            const textSpan = parent.querySelector('span.block');
            
            if (this.checked) {
                // Style saat Terpilih (Active)
                parent.classList.remove('border-gray-100', 'bg-white', 'dark:border-gray-700', 'dark:bg-gray-800');
                parent.classList.add('border-indigo-600', 'bg-indigo-50/50', 'dark:border-indigo-500', 'dark:bg-indigo-900/20');
                
                textSpan.classList.remove('text-gray-600', 'dark:text-gray-400');
                textSpan.classList.add('text-indigo-700', 'dark:text-indigo-300');
            } else {
                // Style saat Tidak Terpilih (Inactive)
                parent.classList.add('border-gray-100', 'bg-white', 'dark:border-gray-700', 'dark:bg-gray-800');
                parent.classList.remove('border-indigo-600', 'bg-indigo-50/50', 'dark:border-indigo-500', 'dark:bg-indigo-900/20');
                
                textSpan.classList.add('text-gray-600', 'dark:text-gray-400');
                textSpan.classList.remove('text-indigo-700', 'dark:text-indigo-300');
            }
        });
    });
});
</script>
@endsection