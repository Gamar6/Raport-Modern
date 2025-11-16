@extends('app')

@section('title', 'Dashboard Pembina Ekstrakurikuler')

@section('content')
  <div class="min-h-screen space-y-8 rounded-2xl bg-white p-6 transition-colors duration-300 dark:bg-gray-900">
    <!-- Header -->
    <div>
      <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard Pembina | {{ $namaPembina }}</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400">Kelola nilai dan catatan keaktifan siswa dalam Ekstrakurikuler
        {{ $namaEkskul }}</p>
    </div>

    <!-- Ringkasan -->
    <div class="grid gap-6 lg:grid-cols-3">
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Ekstrakurikuler</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $namaEkskul }}</h3>
      </div>

      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Anggota</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $totalAnggota }}</h3>
      </div>

      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Rata-rata Partisipasi</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $rataPartisipasi }}</h3>
      </div>
    </div>

    <!-- Chart Partisipasi -->
  <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 mb-6">
    <h3 class="mb-4 text-2xl font-semibold text-gray-800 dark:text-gray-100">Partisipasi Siswa</h3>
    <canvas id="chartPartisipasi" class="h-80 w-full"></canvas>
  </div>
  
  <!-- Top 5 & Perhatian -->
  <div class="grid gap-4 md:grid-cols-2">
    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-gray-100">Top 5 Partisipasi</h3>
      <ul class="list-inside list-disc text-gray-700 dark:text-gray-300">
        @foreach ($top5 as $s)
          <li>{{ $s->siswa->namaSiswa }} - {{ optional($s->penilaianEkskul)->tingkat_partisipasi ?? 0 }}%</li>
        @endforeach
      </ul>
    </div>
  
    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-gray-100">Siswa Butuh Perhatian (&lt;60%)</h3>
      @if ($butuhPerhatian->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">Semua siswa partisipasi di atas 60%</p>
      @else
        <ul class="list-inside list-disc text-gray-700 dark:text-gray-300">
          @foreach ($butuhPerhatian as $s)
            <li>{{ $s->siswa->namaSiswa }} - {{ optional($s->penilaianEkskul)->tingkat_partisipasi ?? 0 }}%</li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>

    {{-- <canvas id="keterampilanChart"></canvas> --}}
    <div x-data="{ tingkat: 'all' }" class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <div class="mb-4 flex items-center justify-between">
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Daftar Anggota</h3>
        <span class="text-sm text-gray-500 dark:text-gray-400">Filter berdasarkan tingkat</span>
      </div>

      <!-- Tombol Filter -->
      <div class="mb-6 flex flex-wrap gap-2">
        <button @click="tingkat = 'all'"
          :class="tingkat === 'all' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'"
          class="rounded-lg px-4 py-2 font-medium transition-all duration-200">
          Semua Tingkat
        </button>
        @foreach ($listSiswa as $t => $siswa)
          <button @click="tingkat = '{{ $t }}'"
            :class="tingkat === '{{ $t }}' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'"
            class="rounded-lg px-4 py-2 font-medium transition-all duration-200">
            {{ $t }} 
            <span class="ml-1.5 inline-block rounded-full bg-white/90 px-2 py-0.5 text-xs font-semibold text-gray-800 dark:bg-gray-800 dark:text-gray-200">
              {{ count($siswa) }}
            </span>
          </button>
        @endforeach
      </div>

      <!-- Daftar Siswa -->
      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($listSiswa as $t => $siswas)
          <template x-for="(s, index) in {{ json_encode($siswas) }}" :key="index">
            <div x-show="tingkat === 'all' || tingkat === '{{ $t }}'"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="opacity-100 scale-100"
              class="group rounded-xl border border-gray-200 bg-gradient-to-br from-gray-50 to-white p-4 shadow-sm transition-all duration-200 hover:shadow-md hover:border-blue-300 dark:border-gray-700 dark:from-gray-800 dark:to-gray-800 dark:hover:border-blue-600">
              <div class="mb-2 flex items-center justify-between">
                <span class="inline-block rounded-md bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900 dark:text-blue-200">
                  {{ $t }}
                </span>
                <span class="text-xl opacity-0 transition-opacity group-hover:opacity-100">👤</span>
              </div>
              <p class="font-semibold text-gray-900 dark:text-gray-100" x-text="s"></p>
            </div>
          </template>
        @endforeach
      </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
      <!-- Penilaian Aktivitas -->
      <div class="rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-100 p-6 dark:border-gray-700">
          <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Penilaian Aktivitas</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400">Nilai partisipasi siswa dalam kegiatan ekstrakurikuler</p>
        </div>
        <div class="p-6">
          @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700 dark:bg-green-800 dark:text-green-200">
              {{ session('success') }}
            </div>
          @endif

          <form method="POST" action="{{ route('pembina.nilai.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="ekskul_id" value="{{ $ekskul->id }}">

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
              <select name="siswa_id"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"
                required>
                <option value="">Pilih Anggota</option>
                @foreach ($anggota as $a)
                  <option value="{{ $a->siswa->id }}">{{ $a->siswa->namaSiswa }}</option>
                @endforeach
              </select>
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat Partisipasi (%)</label>
              <input type="number" name="tingkat_partisipasi" min="0" max="100" placeholder="95" required
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat Keterampilan</label>
              <select name="tingkat_keterampilan" required
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
                <option value="">Pilih tingkat</option>
                <option value="Mahir">Mahir</option>
                <option value="Lanjut">Lanjut</option>
                <option value="Menengah">Menengah</option>
                <option value="Pemula">Pemula</option>
              </select>
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Catatan (opsional)</label>
              <textarea name="catatan" rows="3"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
            </div>

            <button type="submit"
              class="mt-2 h-10 w-full rounded-md bg-blue-600 font-medium text-white hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
              Simpan Penilaian
            </button>
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
          @if (session('SUKSES'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700 dark:bg-green-800 dark:text-green-200">
              {{ session('SUKSES') }}
            </div>
          @endif
          <form method="POST" action="{{ route('pembina.catatan.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="ekskul_id" value="{{ $ekskul->id }}">

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
              <select name="siswa_id" required
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
                <option value="">Pilih Anggota</option>
                @foreach ($anggota as $a)
                  <option value="{{ $a->siswa->id }}">{{ $a->siswa->namaSiswa }}</option>
                @endforeach
              </select>
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Potensi</label>
              <input type="text" name="potensi" placeholder="Contoh: Menjadi Atlet"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Catatan</label>
              <textarea name="catatan" rows="5" placeholder="Tambahkan feedback untuk siswa"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Alasan Penilaian Potensi</label>
              <textarea name="alasan" rows="3" placeholder="Contoh: Siswa sangat antusias dalam latihan"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 focus:ring-2 focus:ring-blue-400 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Rekomendasi Pengembangan</label>
              <textarea name="rekomendasi" rows="3" placeholder="Contoh: Siswa disarankan ikut kompetisi antar sekolah"
                class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm text-gray-900 focus:ring-2 focus:ring-blue-400 dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
            </div>

            <button type="submit"
              class="h-10 w-full rounded-md bg-blue-600 font-medium text-white hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
              Simpan Catatan
            </button>
          </form>
        </div>
      </div>
    </div>
    <script>
      // Chart Partisipasi
      const ctxPartisipasi = document.getElementById('chartPartisipasi').getContext('2d');
      const chartPartisipasi = new Chart(ctxPartisipasi, {
        type: 'bar',
        data: {
          labels: @json($chartLabels),
          datasets: [{
            label: 'Partisipasi (%)',
            data: @json($chartPartisipasi),
            backgroundColor: function(context) {
              const value = context.parsed.x;
              if (value >= 90) return 'rgba(16, 185, 129, 0.8)'; // hijau
              if (value >= 60) return 'rgba(59, 130, 246, 0.8)'; // biru
              return 'rgba(239, 68, 68, 0.8)'; // merah
            },
            borderColor: function(context) {
              const value = context.parsed.x;
              if (value >= 90) return 'rgba(16, 185, 129, 1)';
              if (value >= 60) return 'rgba(59, 130, 246, 1)';
              return 'rgba(239, 68, 68, 1)';
            },
            borderRadius: 3,
            barThickness: 7,          // tebal bar
            categoryPercentage: 0.8,   // lebar kategori
            barPercentage: 0.7          // lebar bar di kategori
          }]
        },
        options: {
          indexAxis: 'y',
          responsive: true,
          scales: {
            x: {
              beginAtZero: true,
              max: 100
            }
          }
        }
      });
      
      // // Chart Keterampilan
      // const ctxKeterampilan = document.getElementById('keterampilanChart').getContext('2d');
      // new Chart(ctxKeterampilan, {
      //   type: 'bar',
      //   data: {
      //     labels: {!! json_encode(array_keys($dataChart)) !!},
      //     datasets: [{
      //       label: 'Jumlah Anggota',
      //       data: {!! json_encode(array_values($dataChart)) !!},
      //       backgroundColor: 'rgba(54, 162, 235, 0.7)',
      //     }]
      //   },
      //   options: {
      //     indexAxis: 'y',
      //     scales: {
      //       x: {
      //         beginAtZero: true
      //       }
      //     }
      //   }
      // });
    </script>
  @endsection
