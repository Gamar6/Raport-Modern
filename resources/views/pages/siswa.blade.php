@extends('app')

@section('title', 'Dashboard Pembina')

@section('content')
    <div class="space-y-8">

  <!-- Header -->
  <div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Pembina Ekstrakurikuler</h1>
    <p class="text-gray-500">Kelola catatan perilaku dan identifikasi potensi siswa</p>
  </div>

  <!-- Form Section -->
  <div class="grid gap-6 lg:grid-cols-2">

    <!-- Catatan Perilaku Siswa -->
    <div class="rounded-xl border border-gray-200 bg-white shadow-md">
      <div class="p-6 border-b border-gray-100">
        <h3 class="text-2xl font-semibold text-gray-800">Catatan Perilaku Siswa</h3>
        <p class="text-sm text-gray-500">Catat perilaku dan sikap siswa dalam kegiatan ekstrakurikuler</p>
      </div>
      <div class="p-6">
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
                <label class="text-sm font-medium text-gray-700">Kategori Perilaku</label>
                <select class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400">
              <option>Pilih kategori</option>
              <option>Kepemimpinan</option>
              <option>Kerja Sama Tim</option>
              <option>Kedisiplinan</option>
              <option>Kreativitas</option>
              <option>Inisiatif</option>
            </select>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700">Penilaian</label>
            <select class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400">
              <option>Pilih rating</option>
              <option>⭐⭐⭐⭐⭐ Sangat Baik</option>
              <option>⭐⭐⭐⭐ Baik</option>
              <option>⭐⭐⭐ Cukup</option>
              <option>⭐⭐ Perlu Perbaikan</option>
            </select>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700">Catatan Detail</label>
            <textarea rows="3" placeholder="Contoh: Menunjukkan inisiatif tinggi dalam mengorganisir event" class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400"></textarea>
          </div>

          <button type="submit" class="w-full h-10 bg-blue-600 text-white rounded-md font-medium hover:bg-blue-700 transition">Simpan Catatan</button>
        </form>
      </div>
    </div>

    <!-- Penilaian Aktivitas -->
    <div class="rounded-xl border border-gray-200 bg-white shadow-md">
      <div class="p-6 border-b border-gray-100">
        <h3 class="text-2xl font-semibold text-gray-800">Penilaian Aktivitas</h3>
        <p class="text-sm text-gray-500">Nilai partisipasi siswa dalam kegiatan ekstrakurikuler</p>
      </div>
      <div class="p-6">
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
            <label class="text-sm font-medium text-gray-700">Nama Kegiatan</label>
            <input type="text" placeholder="Contoh: Latihan Basket Rutin" class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400" />
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700">Tingkat Partisipasi (%)</label>
            <input type="number" placeholder="95" min="0" max="100" class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400" />
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700">Tingkat Keterampilan</label>
            <select class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400">
              <option>Pilih tingkat</option>
              <option>Mahir</option>
              <option>Lanjut</option>
              <option>Menengah</option>
              <option>Pemula</option>
            </select>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700">Catatan</label>
            <textarea rows="3" placeholder="Tambahkan feedback untuk siswa" class="w-full mt-1 rounded-md border border-gray-200 bg-purple-50 p-2 text-sm focus:ring-2 focus:ring-purple-400"></textarea>
          </div>

          <button type="submit" class="w-full h-10 bg-blue-600 text-white rounded-md font-medium hover:bg-blue-700 transition">Simpan Penilaian</button>
        </form>
      </div>
    </div>

  </div>

</div>
    
@endsection