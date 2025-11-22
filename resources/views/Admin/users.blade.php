@extends('Admin.admin-layout')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="min-h-screen space-y-8 bg-gray-50/50 p-6 transition-colors duration-300 dark:bg-gray-900"
     x-data="{ 
        search: '', 
        selectedRole: 'Semua',
        
        // Logika filter data real-time
        isVisible(username, email, role) {
            const lowerSearch = this.search.toLowerCase();
            const matchSearch = username.toLowerCase().includes(lowerSearch) || 
                                email.toLowerCase().includes(lowerSearch);
            
            const matchRole = this.selectedRole === 'Semua' || role.toLowerCase() === this.selectedRole.toLowerCase();
            
            return matchSearch && matchRole;
        }
     }">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between animate-fade-in-up">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Manajemen Pengguna</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola akun siswa, guru, dan staf dalam satu tempat.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" 
           class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition-all hover:bg-blue-700 hover:shadow-blue-600/30 active:scale-[0.98]">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Pengguna
        </a>
    </div>

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity
             class="flex items-center justify-between rounded-xl border border-emerald-100 bg-emerald-50 p-4 text-emerald-800 shadow-sm dark:border-emerald-900/50 dark:bg-emerald-900/20 dark:text-emerald-400 animate-fade-in-up delay-100">
            <div class="flex items-center gap-3">
                <svg class="h-5 w-5 flex-shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 dark:hover:text-emerald-300"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
        </div>
    @endif

    <div class="flex flex-col gap-4 rounded-3xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:flex-row md:items-center md:justify-between animate-fade-in-up delay-200">
        
        <div class="relative w-full md:w-72">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <input type="text" x-model="search" placeholder="Cari nama atau email..." class="w-full rounded-xl border-gray-200 bg-gray-50 py-2.5 pl-10 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-all">
        </div>

        <div class="flex gap-2 overflow-x-auto pb-1 md:pb-0">
            @foreach(['Semua', 'Admin', 'Guru', 'Siswa', 'Pembina'] as $role)
                <button @click="selectedRole = '{{ $role }}'"
                        :class="selectedRole === '{{ $role }}' 
                            ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' 
                            : 'bg-gray-50 text-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'"
                        class="rounded-lg px-4 py-2 text-xs font-bold transition-all duration-200 whitespace-nowrap">
                    {{ $role }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-300">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:bg-gray-700/50 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-4 text-center w-16">No</th>
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($users as $index => $user)
                        <tr x-show="isVisible('{{ $user->username }}', '{{ $user->email }}', '{{ $user->role }}')"
                            x-transition.opacity.duration.300ms
                            class="group hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors">
                            
                            <td class="px-6 py-4 text-center font-medium text-gray-400">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full text-sm font-bold ring-2 ring-white dark:ring-gray-800
                                        {{ strtolower($user->role) === 'admin' ? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300' : 
                                           (strtolower($user->role) === 'guru' ? 'bg-indigo-100 text-indigo-600 dark:bg-indigo-900 dark:text-indigo-300' : 
                                           (strtolower($user->role) === 'pembina' ? 'bg-purple-100 text-purple-600 dark:bg-purple-900 dark:text-purple-300' : 
                                           'bg-emerald-100 text-emerald-600 dark:bg-emerald-900 dark:text-emerald-300')) }}">
                                        {{ strtoupper(substr($user->username, 0, 1)) }}
                                    </div>
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ $user->username }}</div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $roleClass = match(strtolower($user->role)) {
                                        'admin' => 'bg-blue-50 text-blue-700 ring-blue-700/10 dark:bg-blue-900/30 dark:text-blue-400',
                                        'guru' => 'bg-indigo-50 text-indigo-700 ring-indigo-700/10 dark:bg-indigo-900/30 dark:text-indigo-400',
                                        'pembina' => 'bg-purple-50 text-purple-700 ring-purple-700/10 dark:bg-purple-900/30 dark:text-purple-400',
                                        'siswa' => 'bg-emerald-50 text-emerald-700 ring-emerald-700/10 dark:bg-emerald-900/30 dark:text-emerald-400',
                                        default => 'bg-gray-50 text-gray-600 ring-gray-500/10 dark:bg-gray-700 dark:text-gray-300',
                                    };
                                @endphp
                                <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-xs font-bold ring-1 ring-inset {{ $roleClass }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-3">
                                    
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-600 ring-1 ring-inset ring-amber-600/20 transition-all hover:bg-amber-100 hover:text-amber-700 dark:bg-amber-900/20 dark:text-amber-400 dark:hover:bg-amber-900/40">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus {{ $user->username }}? Data yang terhubung juga akan dihapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-rose-50 px-3 py-1.5 text-xs font-bold text-rose-600 ring-1 ring-inset ring-rose-600/20 transition-all hover:bg-rose-100 hover:text-rose-700 dark:bg-rose-900/20 dark:text-rose-400 dark:hover:bg-rose-900/40">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Belum ada pengguna</h3>
                                    <p class="text-sm mt-1">Silakan tambahkan pengguna baru untuk memulai.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="flex items-center justify-between border-t border-gray-100 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/30">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Total Pengguna: <span class="font-bold text-gray-900 dark:text-white">{{ $users->count() }}</span>
            </p>
        </div>
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
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
</style>
@endsection