@extends('app')

@section('title', 'Dashboard Pembina')

@section('content')
  <div class="min-h-screen space-y-8 rounded-2xl bg-white p-6 transition-colors duration-300 dark:bg-gray-900">

    <!-- Header -->
    <div>
      <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard Pembina Ekstrakurikuler</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400">Kelola catatan perilaku dan identifikasi potensi siswa</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Ekstrakurikuler</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Futsal</h3>
      </div>
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Anggota</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">123</h3>
      </div>
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Rata-rata Partisipasi</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">90.5%</h3>
      </div>
    </div>

    <!-- Form Section -->
    <div class="grid gap-6 lg:grid-cols-2">

      <!-- Penilaian Aktivitas -->
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-100 p-6 dark:border-gray-700">
          <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Penilaian Aktivitas</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400">Nilai partisipasi siswa dalam kegiatan ekstrakurikuler</p>
        </div>
        <div class="p-6">
          <form class="space-y-4">
            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
              <select
                class="mt-1 w-full rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400 dark:border-gray-700 dark:bg-purple-700 dark:focus:ring-purple-500">
                <option>Pilih siswa</option>
                <option>Ahmad Fauzan</option>
                <option>Siti Nurhaliza</option>
                <option>Budi Santoso</option>
                <option>Dewi Lestari</option>
              </select>
            </div> 

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat Partisipasi (%)</label>
              <input type="number" placeholder="95" min="0" max="100"
                class="mt-1 w-full rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400 dark:border-gray-700 dark:bg-purple-700 dark:focus:ring-purple-500" />
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat Keterampilan</label>
              <select
                class="mt-1 w-full rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400 dark:border-gray-700 dark:bg-purple-700 dark:focus:ring-purple-500">
                <option>Pilih tingkat</option>
                <option>Mahir</option>
                <option>Lanjut</option>
                <option>Menengah</option>
                <option>Pemula</option>
              </select>
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Catatan</label>
              <textarea rows="5" placeholder="Tambahkan feedback untuk siswa"
                class="mt-1 w-full rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400 dark:border-gray-700 dark:bg-purple-700 dark:focus:ring-purple-500"></textarea>
            </div>

            <button type="submit"
              class="h-10 w-full rounded-md mt-2 bg-blue-600 font-medium text-white transition hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">Simpan
              Penilaian</button>
          </form>
        </div>
      </div>


      <!-- Penilaian Potensi -->
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-100 p-6 dark:border-gray-700">
          <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Penilaian Potensi</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400">Berikan potensi siswa dalam kegiatan ekstrakurikuler
          </p>
        </div>
        <div class="p-6">
          <form class="space-y-4">
            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
              <select
                class="mt-1 w-full rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400 dark:border-gray-700 dark:bg-purple-700 dark:focus:ring-purple-500">
                <option>Pilih siswa</option>
                <option>Ahmad Fauzan</option>
                <option>Siti Nurhaliza</option>
                <option>Budi Santoso</option>
                <option>Dewi Lestari</option>
              </select>
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Kategori Potensi</label>
              <select
                class="mt-1 w-full rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400 dark:border-gray-700 dark:bg-purple-700 dark:focus:ring-purple-500">
                <option>Pilih kategori</option>
                <option>Keterampilan Teknis</option>
                <option>Kreativitas & Inovasi</option>
                <option>Potensi Kepemimpinan</option>
              </select>
            </div>

            {{-- <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Penilaian</label>
              <select
                class="mt-1 w-full rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400 dark:border-gray-700 dark:bg-purple-700 dark:focus:ring-purple-500">
                <option>Pilih rating</option>
                <option>⭐⭐⭐⭐⭐ Sangat Baik</option>
                <option>⭐⭐⭐⭐ Baik</option>
                <option>⭐⭐⭐ Cukup</option>
                <option>⭐⭐ Perlu Perbaikan</option>
              </select>
            </div> --}}

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Alasan Penilaian Potensi</label>
              <textarea rows="3" placeholder="Contoh: Siswa sangat antusias dalam mengikuti setiap latihan"
                class="mt-1 w-full rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400 dark:border-gray-700 dark:bg-purple-700 dark:focus:ring-purple-500"></textarea>
            </div>

            <div> 
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Rekomendasi Pengembangan</label>
              <textarea rows="3" placeholder="Contoh: Siswa diharapkan untuk lebih aktif dalam mengikuti kompetisi antar sekolah"
                class="mt-1 w-full rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400 dark:border-gray-700 dark:bg-purple-700 dark:focus:ring-purple-500"></textarea>
            </div>

            <button type="submit"
              class="h-10 w-full rounded-md bg-blue-600 font-medium text-white transition hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">Simpan
              Catatan</button>
          </form>
        </div>
      </div>
    </div>
  </div> 
@endsection
