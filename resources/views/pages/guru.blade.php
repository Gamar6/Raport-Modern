@extends('app')
@section('title', 'Dashboard Guru')
@section('content')

  <div class="min-h-screen space-y-8 rounded-2xl bg-white p-6 transition-colors duration-300 dark:bg-gray-900">
    <!-- Header -->
    <div>
      <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard Guru</h1>
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

    <!-- Select Kelas -->
    <div>
      <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Kelas</label>
      <select name="kelas_id" id="kelas_id"
        class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 focus:ring-2 focus:ring-blue-400 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
        <option value="" class="dark:bg-blue-950 dark:text-gray-200">Pilih Kelas</option>
        @foreach ($kelasYangDiampu as $kls)
          <option value="{{ $kls->id }}" class="dark:bg-blue-950 dark:text-gray-200">{{ $kls->nama_kelas }}</option>
        @endforeach
      </select>
    </div>

    <!-- Form Input Nilai -->
    <div class="grid gap-6 lg:grid-cols-2">
      <!-- Form Tugas -->
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-1 text-2xl font-semibold text-gray-800 dark:text-gray-100">Input Nilai Tugas</h3>
        <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Masukkan nilai tugas individu atau kelompok</p>

        <form action="{{ route('dashboard.guru.simpan-nilai') }}" method="POST" class="space-y-4">
          @csrf
          <div>
            <label>Nama Siswa</label>
            <select name="siswa_id" id="siswa_id_tugas" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="" class="dark:bg-blue-950">Pilih siswa</option>
              @foreach ($siswas as $s)
                <option value="{{ $s->id }}" class="dark:bg-blue-950">{{ $s->nama }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label>Jenis Tugas</label>
            <select name="jenis nilai" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="" class="dark:bg-blue-950">Pilih jenis</option>
              <option value="tugas individu" class="dark:bg-blue-950">Tugas Individu</option>
              <option value="tugas kelompok" class="dark:bg-blue-950">Tugas Kelompok</option>
            </select>
          </div>

          <div>
            <label>Nilai (0-100)</label>
            <input type="number" name="nilai" min="0" max="100" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200" />
          </div>

          <div>
            <label>Catatan</label>
            <textarea name="catatan"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
          </div>

          <input type="hidden" name="mapel" value="{{ $mapel }}">

          <button type="submit"
            class="w-full rounded-md bg-blue-600 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
            Simpan Nilai
          </button>
        </form>
      </div>

      <!-- Form UTS/UAS -->
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-1 text-2xl font-semibold text-gray-800 dark:text-gray-100">Input Nilai UTS/UAS</h3>
        <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Masukkan nilai ujian tengah/akhir semester</p>

        <form action="{{ route('dashboard.guru.simpan-nilai-ujian') }}" method="POST" class="space-y-4">
          @csrf
          <div>
            <label>Nama Siswa</label>
            <select name="siswa_id" id="siswa_id_ujian" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="" class="dark:bg-blue-950">Pilih siswa</option>
              @foreach ($siswas as $s)
                <option value="{{ $s->id }}" class="dark:bg-blue-950">{{ $s->nama }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label>Jenis Ujian</label>
            <select name="jenis nilai" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="" class="dark:bg-blue-950">Pilih jenis</option>
              <option value="UTS" class="dark:bg-blue-950">UTS</option>
              <option value="UAS" class="dark:bg-blue-950">UAS</option>
            </select>
          </div>

          <input type="hidden" name="mapel" value="{{ $mapel }}">

          <div>
            <label>Nilai (0-100)</label>
            <input type="number" name="nilai" min="0" max="100" placeholder="90"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200" />
          </div>

          <div>
            <label>Catatan</label>
            <textarea name="catatan"
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

  <script>
  document.getElementById('kelas_id').addEventListener('change', function () {
    const kelasId = this.value;

    // Pastikan kelas dipilih
    if (!kelasId) return;

    fetch(`/guru/siswa-by-kelas?kelas_id=${kelasId}`)
      .then(res => res.json())
      .then(data => {
        // Form Tugas
        const siswaSelectTugas = document.getElementById('siswa_id_tugas');
        siswaSelectTugas.innerHTML = '<option class="dark:bg-blue-950" value="">Pilih siswa</option>';
        data.forEach(siswa => {
          siswaSelectTugas.innerHTML += `<option class="dark:bg-blue-950" value="${siswa.id}">${siswa.nama}</option>`;
        });

        // Form Ujian
        const siswaSelectUjian = document.getElementById('siswa_id_ujian');
        siswaSelectUjian.innerHTML = '<option class="dark:bg-blue-950" value="">Pilih siswa</option>';
        data.forEach(siswa => {
          siswaSelectUjian.innerHTML += `<option class="dark:bg-blue-950" value="${siswa.id}">${siswa.nama}</option>`;
        });
      });
  }); 
  </script>

@endsection
