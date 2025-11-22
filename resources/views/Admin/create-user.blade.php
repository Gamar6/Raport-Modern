@extends('Admin.admin-layout')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="container mx-auto max-w-3xl px-4 py-8">

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between animate-fade-in-up">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Tambah Pengguna Baru</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Isi formulir di bawah untuk mendaftarkan akun baru.</p>
        </div>

        <a href="{{ route('admin.users') }}" 
           class="group inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 hover:text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-100">
        
        <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/20">
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                </div>
                <h2 class="text-sm font-bold text-gray-900 dark:text-white">Informasi Akun</h2>
            </div>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 md:p-8">
            @csrf
            
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                
                <div class="col-span-2 md:col-span-1">
                    <label for="username" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        Username
                    </label>
                    <input type="text" name="username" id="username" required
                        class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 transition-all"
                        placeholder="Masukkan username">
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label for="role" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        Role / Peran
                    </label>
                    <div class="relative">
                        <select name="role" id="role" required
                            class="w-full appearance-none rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white transition-all">
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="guru">Guru</option>
                            <option value="siswa">Siswa</option>
                            <option value="pembina">Pembina</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <div class="col-span-2">
                    <label for="email" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <input type="email" name="email" id="email" required
                            class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 pl-10 pr-3 text-sm font-medium text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 transition-all"
                            placeholder="contoh@sekolah.sch.id">
                    </div>
                </div>

                <div class="col-span-2">
                    <label for="password" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        Password
                    </label>
                    <div class="relative" x-data="{ show: false }">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input :type="show ? 'text' : 'password'" name="password" id="password" required
                            class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 pl-10 pr-10 text-sm font-medium text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 transition-all"
                            placeholder="••••••••">
                        
                        <button type="button" @click="show = !show" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none">
                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" /></svg>
                        </button>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimal 8 karakter kombinasi huruf dan angka.</p>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-3 border-t border-gray-100 pt-6 dark:border-gray-700">
                <a href="{{ route('admin.users') }}" 
                   class="rounded-xl px-4 py-2.5 text-sm font-bold text-gray-600 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition-all hover:bg-blue-700 hover:shadow-blue-600/30 active:scale-[0.98]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    Simpan Pengguna
                </button>
            </div>

        </form>
    </div>

</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }
    .delay-100 { animation-delay: 0.1s; }
</style>
@endsection