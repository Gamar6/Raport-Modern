@extends('app')

@section('title', 'Dashboard Guru')
@section('content')

  <div class="min-h-screen space-y-8 rounded-2xl bg-white p-6 transition-colors duration-300 dark:bg-gray-900">
    <!-- Header -->
    <div>
      <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard Guru | {{ $nama }}</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400">Kelola nilai dan catatan keaktifan siswa</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Mata Pelajaran</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $mapel }}</h3>
      </div>
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Kelas</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $totalKelas }}</h3>
      </div>
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Siswa yang diajar</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $totalSiswa }}</h3>
      </div>
    </div>

    <!-- Form Input Nilai UTS -->
    <div class="grid gap-6 lg:grid-cols-2">
      <!-- Form Nilai UTS -->
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-1 text-2xl font-semibold text-gray-800 dark:text-gray-100">Input Nilai UTS</h3>
        <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Masukkan nilai ujian tengah/akhir semester</p>
        @if (session('success'))
          <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700 dark:bg-green-800 dark:text-green-200">
            {{ session('success') }}
          </div>
        @endif
        <form action="{{ route('guru.uts.store') }}" method="POST" class="space-y-4">
          @csrf
          <div>
            <label>Nama Siswa</label>
            <select name="siswa_id" id="siswa_id_ujian" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="" class="dark:bg-blue-950">Pilih siswa</option>
              @foreach ($semuaSiswa as $siswa)
                <option value="{{ $siswa->id }}">{{ $siswa->namaSiswa }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label>Nilai (0-100)</label>
            <input type="number" name="nilai" min="0" max="100" placeholder="90"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200" />
          </div>

          <div>
            <label>Catatan</label>
            <textarea name="catatan" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
          </div>

          <button type="submit"
            class="w-full rounded-md bg-blue-600 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
            Simpan Nilai
          </button>
        </form>
      </div>


      <!-- Form UTS/UAS -->
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-1 text-2xl font-semibold text-gray-800 dark:text-gray-100">Input Nilai UAS</h3>
        <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Masukkan nilai ujian tengah/akhir semester</p>
        @if (session('success'))
          <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700 dark:bg-green-800 dark:text-green-200">
            {{ session('success') }}
          </div>
        @endif
        <form action="{{ route('guru.uas.store') }}" method="POST" class="space-y-4">
          @csrf
          <div>
            <label>Nama Siswa</label>
            <select name="siswa_id" id="siswa_id_uas" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="" class="dark:bg-blue-950">Pilih siswa</option>
              @foreach ($semuaSiswa as $siswa)
                <option value="{{ $siswa->id }}">{{ $siswa->namaSiswa }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label>Nilai (0-100)</label>
            <input type="number" name="nilai" min="0" max="100" placeholder="90"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200" />
          </div>

          <div>
            <label>Catatan</label>
            <textarea name="catatan" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
          </div>

          <button type="submit"
            class="w-full rounded-md bg-blue-600 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
            Simpan Nilai
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
