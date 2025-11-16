@extends('Admin.admin-layout')
@section('title', 'Dashboard Admin')
@section('content')

<div class="container mx-auto px-4 py-6">

    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            Manajemen Pengguna
        </h1>

        <a href="{{ route('admin.users.create') }}"
            class="rounded-xl bg-blue-600 px-4 py-2 text-white font-semibold 
                   shadow-md hover:bg-blue-700 transition-all duration-200 
                   dark:bg-blue-700 dark:hover:bg-blue-800">
            + Tambah Pengguna
        </a>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="mb-6 rounded-xl bg-green-100 dark:bg-green-800 p-4 text-green-700 dark:text-green-200 
                    border border-green-200 dark:border-green-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Wrapper -->
    <div class="overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-md 
                border border-gray-200 dark:border-gray-700">

        <table class="min-w-full border-collapse">

            <!-- Table Head -->
            <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold text-gray-800 dark:text-gray-200">#</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-800 dark:text-gray-200">Username</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-800 dark:text-gray-200">Email</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-800 dark:text-gray-200">Role</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-800 dark:text-gray-200">Aksi</th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody>
                @forelse ($users as $index => $user)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                        <td class="px-5 py-4 text-gray-900 dark:text-gray-100">{{ $index + 1 }}</td>

                        <td class="px-5 py-4 capitalize text-gray-900 dark:text-gray-100">
                            {{ $user->username }}
                        </td>

                        <td class="px-5 py-4 text-gray-900 dark:text-gray-100">
                            {{ $user->email }}
                        </td>

                        <td class="px-5 py-4">
                            <span class="px-3 py-1 rounded-lg text-sm font-medium capitalize
                                         bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-100">
                                {{ $user->role }}
                            </span>
                        </td>

                        <!-- Aksi -->
                        <td class="px-5 py-4 flex gap-3">

                            <!-- Edit -->
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-white text-sm font-medium 
                                       hover:bg-yellow-600 transition shadow">
                                Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="rounded-lg bg-red-600 px-4 py-2 text-white text-sm font-medium 
                                           hover:bg-red-700 transition shadow">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-6 text-center text-gray-500 dark:text-gray-300">
                            Belum ada pengguna terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection
