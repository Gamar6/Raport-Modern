@extends('Admin.admin-layout')

@section('title', 'Dashboard Admin')

@section('content')

  <div class="container mx-auto px-4 py-6">

    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-2xl font-bold">Manajemen Pengguna</h1>

      <a href="{{ route('admin.users.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
        + Tambah Pengguna
      </a>
    </div>

    @if (session('success'))
      <div class="mb-4 rounded bg-green-100 p-3 text-green-700">
        {{ session('success') }}
      </div>
    @endif

    <div class="overflow-hidden rounded-lg bg-white shadow">
      <table class="min-w-full border-collapse">
        <thead class="border-b bg-gray-100">
          <tr>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">#</th>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Username</th>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Email</th>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Role</th>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($users as $index => $user)
            <tr class="border-b">
              <td class="px-4 py-3">{{ $index + 1 }}</td>
              <td class="px-4 py-3 capitalize">{{ $user->username }}</td>
              <td class="px-4 py-3">{{ $user->email }}</td>
              <td class="px-4 py-3">
                <span class="rounded bg-gray-200 px-2 py-1 capitalize text-gray-700">
                  {{ $user->role }}
                </span>
              </td>
              <td class="flex gap-2 px-4 py-3">

                <!-- Edit -->
                <a href="{{ route('admin.users.edit', $user->id) }}"
                  class="rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600">
                  Edit
                </a>

                <!-- Delete -->
                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                  @csrf
                  @method('DELETE')

                  <button class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700">
                    Hapus
                  </button>
                </form>

              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                Belum ada pengguna terdaftar.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
