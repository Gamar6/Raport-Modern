@extends('app')
@section('title', 'Dashboard Guru')
@section('content')

<div class="space-y-8">
  <!-- Header -->
  <div>
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Guru</h1>
    <p class="text-gray-500 text-sm">Kelola nilai dan catatan keaktifan siswa</p>
  </div>

  <!-- Form Input Nilai -->
  <div class="grid gap-6 lg:grid-cols-2">
    <!-- Form Tugas -->
    <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
      <div class="mb-4">
        <h3 class="text-2xl font-semibold text-gray-800">Input Nilai Tugas</h3>
        <p class="text-sm text-gray-500">Masukkan nilai tugas individu atau kelompok</p>
      </div>

      <form class="space-y-4">
        <div>
          <label class="text-sm font-medium text-gray-700">Nama Siswa</label>
          <select class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400">
            <option>Pilih siswa</option>
            <option>Ahmad Fauzan</option>
            <option>Siti Nurhaliza</option>
            <option>Budi Santoso</option>
            <option>Dewi Lestari</option>
          </select>
        </div>

        <div>
          <label class="text-sm font-medium text-gray-700">Jenis Tugas</label>
          <select class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400">
            <option>Pilih jenis</option>
            <option>Tugas Individu</option>
            <option>Tugas Kelompok</option>
          </select>
        </div>

        <div>
          <label class="text-sm font-medium text-gray-700">Nilai (0-100)</label>
          <input type="number" placeholder="85" class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400" />
        </div>

        <div>
          <label class="text-sm font-medium text-gray-700">Catatan</label>
          <textarea placeholder="Tambahkan catatan (opsional)" class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400"></textarea>
        </div>

        <button type="submit" class="w-full bg-purple-600 text-white rounded-md py-2 hover:bg-purple-700 text-sm font-medium transition-colors">
          Simpan Nilai
        </button>
      </form>
    </div>

    <!-- Form UTS/UAS -->
    <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
      <div class="mb-4">
        <h3 class="text-2xl font-semibold text-gray-800">Input Nilai UTS/UAS</h3>
        <p class="text-sm text-gray-500">Masukkan nilai ujian tengah/akhir semester</p>
      </div>

      <form class="space-y-4">
        <div>
          <label class="text-sm font-medium text-gray-700">Nama Siswa</label>
          <select class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400">
            <option>Pilih siswa</option>
            <option>Ahmad Fauzan</option>
            <option>Siti Nurhaliza</option>
            <option>Budi Santoso</option>
            <option>Dewi Lestari</option>
          </select>
        </div>

        <div>
          <label class="text-sm font-medium text-gray-700">Jenis Ujian</label>
          <select class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400">
            <option>Pilih jenis</option>
            <option>UTS</option>
            <option>UAS</option>
          </select>
        </div>

        <div>
          <label class="text-sm font-medium text-gray-700">Mata Pelajaran</label>
          <select class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400">
            <option>Pilih mata pelajaran</option>
            <option>Matematika</option>
            <option>IPA</option>
            <option>Bahasa Indonesia</option>
            <option>Bahasa Inggris</option>
          </select>
        </div>

        <div>
          <label class="text-sm font-medium text-gray-700">Nilai (0-100)</label>
          <input type="number" placeholder="90" class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400" />
        </div>

        <button type="submit" class="w-full bg-purple-600 text-white rounded-md py-2 hover:bg-purple-700 text-sm font-medium transition-colors">
          Simpan Nilai
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
