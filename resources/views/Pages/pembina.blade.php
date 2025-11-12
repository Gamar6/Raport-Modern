@extends('app')

@section('title', 'Dashboard Pembina Ekstrakurikuler')

@section('content')
  <div class="min-h-screen space-y-8 rounded-2xl bg-white p-6 transition-colors duration-300 dark:bg-gray-900">

    <div>
      <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard Pembina Ekstrakurikuler</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400">Kelola catatan perilaku dan identifikasi potensi siswa</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
      @foreach ($ekskul as $item)
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
          <p class="text-sm text-gray-500 dark:text-gray-400">Ekstrakurikuler</p>
          <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $item->namaEkskul }}</h3>
        </div>
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
          <p class="text-sm text-gray-500 dark:text-gray-400">Total Anggota</p>
          <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $item->anggota->count() }}</h3>
        </div>
      @endforeach
    </div>

    <div class="mt-6 rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <div class="border-b border-gray-100 p-6 dark:border-gray-700">
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Daftar Anggota Ekstrakurikuler</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Informasi pembina dan anggota aktif</p>
      </div>

      <div class="overflow-hidden rounded-b-xl">
        <table class="w-full border-collapse text-sm text-gray-800 dark:text-gray-200">
          <thead class="bg-blue-50 text-left font-bold dark:bg-blue-950/20">
            <tr>
              <th class="border-b border-gray-200 px-6 py-3 font-semibold dark:border-gray-700">Nama Ekskul</th>
              <th class="border-b border-gray-200 px-6 py-3 font-semibold dark:border-gray-700">Nama Pembina</th>
              <th class="border-b border-gray-200 px-6 py-3 font-semibold dark:border-gray-700">Nama Anggota</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($ekskul as $item)
              @foreach ($item->anggota as $siswa)
                <tr>
                  <td>{{ $item->namaEkskul }}</td>
                  <td>{{ $item->pembina->nama }}</td>
                  <td>{{ $siswa->namaSiswa }}</td>
                </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
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
          <form method="POST" action="" class="space-y-4">
            @csrf
            <input type="hidden" name="ekskul_id" value="">

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
              <select name="siswa_id"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
                <option value="">Pilih siswa</option>
                <option>nama anggota</option>
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
              class="mt-2 h-10 w-full rounded-md bg-blue-600 font-medium text-white transition hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">Simpan
              Penilaian</button>
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
          <form method="POST" action="" class="space-y-4">
            @csrf
            <input type="hidden" name="ekskul_id" value="">

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
              <select name="siswa_id"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
                <option value="">Pilih siswa</option>

              </select>
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Potensi</label>
              <input type="text" name="potensi" placeholder="Contoh: Menjadi Atlet" min="0" max="100"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200" />
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Alasan Penilaian Potensi</label>
              <textarea name="alasan" rows="3" placeholder="Contoh: Siswa sangat antusias dalam mengikuti setiap latihan"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 focus:ring-2 focus:ring-blue-400 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Rekomendasi Pengembangan</label>
              <textarea name="rekomendasi" rows="3" placeholder="Contoh: Siswa disarankan aktif di kompetisi antar sekolah"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 focus:ring-2 focus:ring-blue-400 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
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
