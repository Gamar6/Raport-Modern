@extends('app')

@section('title', 'Dashboard OrangTua dan Siswa')
@section('content')
  <div class="space-y-8">
    <!-- Header -->
    <div>
      <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Profil Siswa</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400">Ringkasan lengkap progres dan potensi siswa</p>
    </div>

    <!-- Profil Utama -->
    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
      <div class="flex flex-col items-start gap-6 md:flex-row md:items-center">
        <div
          class="flex h-24 w-24 items-center justify-center rounded-full bg-purple-100 text-4xl font-bold text-purple-700 shadow-sm dark:bg-purple-900 dark:text-purple-300">
          {{ strtoupper(substr($siswa->nama, 0, 1)) }}
        </div>
        <div class="flex-1 space-y-2">
          <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $siswa->nama }}</h2>
          <div class="flex flex-wrap gap-2 text-sm text-gray-500 dark:text-gray-400">
            <span>Kelas {{ $siswa->kelas->nama_kelas ?? '-' }}</span>
            <span>•</span>
            <span>{{ $siswa->nis }}</span>
            <span>•</span>
            <span>Semester 2 - 2024</span>
          </div>
          <div class="flex flex-wrap gap-2 pt-2">
            <span
              class="inline-flex items-center rounded-full bg-purple-100 px-3 py-0.5 text-xs font-medium text-purple-700 dark:bg-purple-800 dark:text-purple-300">Siswa
              Aktif</span>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-4 text-center">
          <div class="rounded-lg bg-purple-50 p-3 dark:bg-purple-900">
            <p class="text-3xl font-bold text-purple-700 dark:text-purple-300">{{ number_format($rataRata, 1) }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Rata-rata UAS</p>
          </div>
          <div class="rounded-lg bg-purple-50 p-3 dark:bg-purple-900">
            <p class="text-3xl font-bold text-green-700 dark:text-green-400">{{ $potensi->count() }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Bidang Potensi</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Potensi & Minat -->
    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
      <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">Potensi & Minat</h3>
      <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Badge menunjukkan 5 mata pelajaran dengan nilai tertinggi
        UAS</p>
      @forelse ($potensi as $pot)
        <span
          class="inline-flex items-center gap-2 rounded-full border border-transparent bg-purple-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-purple-700">
          {{ $pot->potensi }}
        </span>
      @empty
        <span class="text-sm text-gray-500 dark:text-gray-400">Belum ada data nilai UAS.</span>
      @endforelse
    </div>

    <!-- Grid Konten -->
    <div class="grid gap-6 lg:grid-cols-3">
      <!-- Kolom Kiri: Performa Akademik & Ekstrakurikuler -->
      <div class="space-y-6 lg:col-span-2">
        <!-- Performa Akademik -->
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
          <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">Performa Akademik</h3>
          <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Nilai per mata pelajaran (UAS)</p>

          <div class="space-y-4">
            @forelse ($nilaiUas as $n)
              <div>
                <div class="flex justify-between text-sm font-medium text-gray-700 dark:text-gray-300">
                  <span>{{ $n->mapel }}</span>
                  <span class="text-purple-700 dark:text-purple-300">{{ $n->nilai }}</span>
                </div>
                <div class="h-2 w-full rounded-full bg-purple-50 dark:bg-purple-950">
                  <div class="h-2 rounded-full bg-purple-600" style="width: {{ $n->nilai }}%"></div>
                </div>
              </div>
            @empty
              <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada nilai yang tersedia.</p>
            @endforelse
          </div>
        </div>

        <!-- Ekstrakurikuler -->
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
          <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">Ekstrakurikuler</h3>
          <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Tingkat Partisipasi & Tingkat Keterampilan</p>

          <div class="space-y-4">
            @forelse ($siswaEkskulModel as $se)
              <div class="border-b pb-4">
                <div class="flex justify-between text-sm font-medium text-gray-700 dark:text-gray-300">
                  <span>{{ $se->ekstrakurikuler->nama_ekskul }}</span> <!-- Menampilkan nama ekstrakurikuler -->
                  <span class="text-purple-700 dark:text-purple-300">{{ ucfirst($se->tingkat) }}</span>
                  <!-- Menampilkan tingkat -->
                </div>

                <div class="text-sm text-gray-500 dark:text-gray-400">
                  <span>Partisipasi: {{ ucfirst($se->partisipasi) }}</span> <!-- Menampilkan partisipasi -->
                </div>

                @php
                  // Hitung persentase berdasarkan tingkat
                  $nilai = 0;
                  switch ($se->tingkat) {
                      case 'pemula':
                          $nilai = 30;
                          break;
                      case 'menengah':
                          $nilai = 60;
                          break;
                      case 'lanjut':
                          $nilai = 80;
                          break;
                      case 'mahir':
                          $nilai = 100;
                          break;
                  }
                @endphp

                <div class="h-2 w-full rounded-full bg-purple-50 dark:bg-purple-950">
                  <div class="h-2 rounded-full bg-purple-600" style="width: {{ $nilai }}%"></div>
                </div>
              </div>
            @empty
              <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada ekstrakurikuler yang diikuti.</p>
            @endforelse
          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Radar Chart -->
      <div class="space-y-6">
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
          <h3 class="mb-4 text-xl font-semibold text-gray-800 dark:text-white">Statistik Siswa</h3>
          <canvas id="studentRadarChart" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Catatan Pembina -->
    @foreach ($siswaEkskulModel as $siswaEkskul)
      <div class="mt-6 rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
        <div class="text-base font-semibold text-gray-800 md:text-lg dark:text-white">
          {{ $siswaEkskul->ekstrakurikuler->pembina->nama ?? 'Pembina tidak ditemukan' }}
        </div>

        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Pembina Futsal</p>

        @forelse($siswaEkskul->catatanPembina as $catatan)
          <div
            class="mb-4 flex flex-wrap items-start gap-4 border-b border-gray-200 pb-4 pt-7 md:flex-nowrap dark:border-gray-700">
            <!-- Foto Guru -->
            <div class="flex-shrink-0">
              <div
                class="flex h-24 w-24 items-center justify-center rounded-full bg-gray-200 text-lg font-medium text-gray-400 shadow-inner dark:bg-gray-700 dark:text-gray-300">
                {{ strtoupper(substr($catatan->pembina->nama ?? 'PB', 0, 2)) }}
              </div>
            </div>

            <!-- Info Guru -->
            <div class="flex flex-col justify-center pt-1.5 md:min-w-[180px]">
              <div class="text-base font-semibold text-gray-800 md:text-lg dark:text-white">
                {{ $catatan->pembina->nama ?? 'Pembina' }}</div>
              <div class="text-sm text-gray-500 md:text-base dark:text-gray-400">
                Pembina {{ $siswaEkskul->ekstrakurikuler->nama_ekskul ?? 'Tidak ada ekskul' }}</div>
            </div>

            <div class="relative grid w-full flex-1 grid-cols-2 gap-4">
              <div
                class="col-span-2 -mt-6 flex justify-between rounded-lg bg-gray-50 p-2 text-sm font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                Kategori Potensi Siswa
              </div>

              <div class="flex h-full flex-col rounded-lg bg-gray-50 p-4 pt-6 shadow-sm dark:bg-gray-800">
                <b class="text-gray-800 dark:text-white">Alasan pemberian potensi</b>
                <p class="mt-1 text-base leading-relaxed text-gray-700 dark:text-gray-300">
                  {{ $catatan->alasan }}
                </p>
              </div>

              <div class="flex h-full flex-col rounded-lg bg-gray-50 p-4 pt-6 shadow-sm dark:bg-gray-800">
                <b class="text-gray-800 dark:text-white">Pengembangan Potensi</b>
                <p class="mt-1 text-base leading-relaxed text-gray-700 dark:text-gray-300">
                  {{ $catatan->rekomendasi }}
                </p>
              </div>
            </div>
          </div>
        @empty
          <p class="text-gray-500 dark:text-gray-400">Zainal Abidin sebaiknya melakukan latihan lebih untuk pengembangan lebih lanjut</p>
        @endforelse
      </div>
    @endforeach
  </div>

  <!-- Script Chart.js -->
  <script>
    const isDark = document.documentElement.classList.contains('dark');

    const ctx = document.getElementById('studentRadarChart');
    new Chart(ctx, {
      type: 'radar',
      data: {
        labels: @json($labels),
        datasets: [{
          label: 'Potensi Siswa (Nilai UAS)',
          data: @json($nilaiRadar),
          backgroundColor: 'rgba(139, 92, 246, 0.2)',
          borderColor: 'rgb(139, 92, 246)',
          borderWidth: 2,
          pointBackgroundColor: 'rgb(139, 92, 246)',
        }]
      },
      options: {
        scales: {
          r: {
            suggestedMin: 0,
            suggestedMax: 100,
            ticks: {
              stepSize: 20,
              backdropColor: 'transparent',
              color: isDark ? '#D1D5DB' : '#374151', // gray-300 (dark) / gray-700 (light)
            },
            grid: {
              color: isDark ? '#4C1D95' : '#E9D5FF'
            },
            pointLabels: {
              color: isDark ? '#D1D5DB' : '#374151',
              font: {
                size: 13
              }
            }
          }
        }
      }
    });
  </script>
@endsection
