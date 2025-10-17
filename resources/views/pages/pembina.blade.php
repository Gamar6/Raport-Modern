@extends('app')

@section('title', 'Dashboard Pembina Ekstrakurikuler')

@section('content')
<div class="min-h-screen space-y-8 rounded-2xl bg-white p-6 transition-colors duration-300 dark:bg-gray-900">

  <!-- Header -->
  <div>
    <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard Pembina Ekstrakurikuler</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400">Kelola catatan perilaku dan identifikasi potensi siswa</p>
  </div>

  <!-- Ringkasan Ekskul -->
  <div class="grid gap-6 lg:grid-cols-3">
    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <p class="text-sm text-gray-500 dark:text-gray-400">Ekstrakurikuler</p>
      <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
        {{ $ekskulDipilih->nama_ekskul ?? '-' }}
      </h3>
    </div>
    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <p class="text-sm text-gray-500 dark:text-gray-400">Total Anggota</p>
      <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $totalAnggota ?? 0 }}</h3>
    </div>
    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <p class="text-sm text-gray-500 dark:text-gray-400">Rata-rata Partisipasi</p>
      <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
        {{ number_format($rataPartisipasi ?? 0, 1) }}%
      </h3>
    </div>
  </div>

  <!-- Form Section -->
  <div class="grid gap-6 lg:grid-cols-2">
    
    <!-- Penilaian Aktivitas -->
    <div class="rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <div class="border-b border-gray-100 p-6 dark:border-gray-700">
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Penilaian Aktivitas</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Nilai partisipasi siswa dalam kegiatan ekstrakurikuler</p>
      </div>
      <div class="p-6">
        <form method="POST" action="{{ route('pembina.aktivitas.simpan') }}" class="space-y-4">
          @csrf
          <input type="hidden" name="ekskul_id" value="{{ $ekskulDipilih->id ?? '' }}">

          <div>
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
            <select name="siswa_id"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="">Pilih siswa</option>
              @foreach ($anggota as $a)
                <option value="{{ $a->siswa->id }}">{{ $a->siswa->name }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat Partisipasi (%)</label>
            <input type="number" name="partisipasi" placeholder="95" min="0" max="100"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200" />
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat Keterampilan</label>
            <select name="tingkat_keterampilan"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="">Pilih tingkat</option>
              <option value="Mahir">Mahir</option>
              <option value="Lanjut">Lanjut</option>
              <option value="Menengah">Menengah</option>
              <option value="Pemula">Pemula</option>
            </select>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Catatan</label>
            <textarea name="catatan" rows="5" placeholder="Tambahkan feedback untuk siswa"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
          </div>

          <button type="submit"
            class="h-10 w-full rounded-md mt-2 bg-blue-600 font-medium text-white transition hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">Simpan Penilaian</button>
        </form>
      </div>
    </div>

    <!-- Penilaian Potensi -->
    <div class="rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <div class="border-b border-gray-100 p-6 dark:border-gray-700">
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Penilaian Potensi</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Berikan potensi siswa dalam kegiatan ekstrakurikuler</p>
      </div>
      <div class="p-6">
        <form method="POST" action="{{ route('pembina.potensi.simpan') }}" class="space-y-4">
          @csrf
          <input type="hidden" name="ekskul_id" value="{{ $ekskulDipilih->id ?? '' }}">

          <div>
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
            <select name="siswa_id"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="">Pilih siswa</option>
              @foreach ($anggota as $a)
                <option value="{{ $a->siswa->id }} "class="dark:bg-blue-950">{{ $a->siswa->name }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Kategori Potensi</label>
            <select name="kategori_potensi"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="">Pilih kategori</option>
              <option value="Keterampilan Teknis">Keterampilan Teknis</option>
              <option value="Kreativitas & Inovasi">Kreativitas & Inovasi</option>
              <option value="Kepemimpinan">Kepemimpinan</option>
            </select>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Alasan Penilaian Potensi</label>
            <textarea name="alasan" rows="3" placeholder="Contoh: Siswa sangat antusias dalam mengikuti setiap latihan"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Rekomendasi Pengembangan</label>
            <textarea name="rekomendasi" rows="3" placeholder="Contoh: Siswa disarankan aktif di kompetisi antar sekolah"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
          </div>

          <button type="submit"
            class="h-10 w-full rounded-md bg-blue-600 font-medium text-white transition hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
            Simpan Catatan
          </button>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection
