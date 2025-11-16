@extends('Admin.admin-layout')
@section('title', 'Dashboard Admin')
@section('content')

  <div class="container mx-auto px-4 py-6">
    
    <!-- header content -->
    <div class="mb-8 flex items-center justify-between">
      <h1 class="text-3xl font-bold text-gray-900 dark:text-white"">
        Edit Pengguna
      </h1>

      <a href="{{ route('admin.users') }}"
          class="rounded-xl bg-blue-600 px-4 py-2 text-white font-semibold 
                 shadow-md hover:bg-blue-700 transition-all duration-200 
                 dark:bg-blue-700 dark:hover:bg-blue-800">
          Kembali ke Daftar Pengguna
      </a>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
      class="space-y-5 rounded-lg bg-white p-6 shadow-lg dark:bg-gray-800">
      @csrf
      @method('PUT')

      <!-- Username -->
      <div>
        <label class="mb-1 block font-medium text-gray-700 dark:text-gray-300">
          Username
        </label>
        <input type="text" name="username" value="{{ $user->username }}"
          class="w-full rounded-lg border bg-gray-50 px-3 py-2 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
          required>
      </div>

      <!-- Email -->
      <div>
        <label class="mb-1 block font-medium text-gray-700 dark:text-gray-300">
          Email
        </label>
        <input type="email" name="email" value="{{ $user->email }}"
          class="w-full rounded-lg border bg-gray-50 px-3 py-2 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
          required>
      </div>

      <!-- Role -->
      <div>
        <label class="mb-1 block font-medium text-gray-700 dark:text-gray-300">
          Role
        </label>

        <select name="role"
          class="w-full rounded-lg border bg-gray-50 px-3 py-2 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
          <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
          <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
          <option value="pembina" {{ $user->role == 'pembina' ? 'selected' : '' }}>Pembina</option>
        </select>
      </div>

      <!-- Optional: Change password -->
      <div>
        <label class="mb-1 block font-medium text-gray-700 dark:text-gray-300">
          Password Baru (opsional)
        </label>
        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
          class="w-full rounded-lg border bg-gray-50 px-3 py-2 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
      </div>

      <button type="submit" class="w-full rounded-lg bg-yellow-600 py-2 text-white transition hover:bg-yellow-700">
        Update
      </button>
    </form>
  </div>
@endsection
