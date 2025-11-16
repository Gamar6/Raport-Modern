@extends('Admin.admin-layout')
@section('title', 'Dashboard Admin')
@section('content')

<div class="container mx-auto px-4 py-6">

    <!-- header content -->
    <div class="mb-8 flex items-center justify-between">
      <h1 class="text-3xl font-bold text-gray-900 dark:text-white"">
        Tambah Pengguna Baru
      </h1>

      <a href="{{ route('admin.users') }}"
          class="rounded-xl bg-blue-600 px-4 py-2 text-white font-semibold 
                 shadow-md hover:bg-blue-700 transition-all duration-200 
                 dark:bg-blue-700 dark:hover:bg-blue-800">
          Kembali ke Daftar Pengguna
      </a>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST"
          class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 space-y-5">
        @csrf
        
        <!-- Username -->
        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300 mb-1">
                Username
            </label>
            <input type="text" name="username"
                class="w-full px-3 py-2 border rounded-lg 
                       bg-gray-50 dark:bg-gray-700 
                       dark:text-white dark:border-gray-600"
                required>
        </div>

        <!-- Email -->
        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300 mb-1">
                Email
            </label>
            <input type="email" name="email"
                class="w-full px-3 py-2 border rounded-lg 
                       bg-gray-50 dark:bg-gray-700 
                       dark:text-white dark:border-gray-600"
                required>
        </div>

        <!-- Password -->
        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300 mb-1">
                Password
            </label>
            <input type="password" name="password"
                class="w-full px-3 py-2 border rounded-lg 
                       bg-gray-50 dark:bg-gray-700 
                       dark:text-white dark:border-gray-600"
                required>
        </div>

        <!-- Role -->
        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300 mb-1">
                Role
            </label>

            <select name="role"
                class="w-full px-3 py-2 border rounded-lg 
                       bg-gray-50 dark:bg-gray-700 
                       dark:text-white dark:border-gray-600">
                <option value="guru">Guru</option>
                <option value="siswa">Siswa</option>
                <option value="pembina">Pembina</option>
            </select>
        </div>

        <button type="submit"
            class="w-full py-2 bg-blue-600 text-white rounded-lg 
                   hover:bg-blue-700 transition">
            Simpan
        </button>
    </form>

</div>

@endsection