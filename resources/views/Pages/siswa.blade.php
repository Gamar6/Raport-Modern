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
          A
        </div>
        <div class="flex-1 space-y-2">
          <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $siswa->user->username }}</h2>
          <div class="flex flex-wrap gap-2 text-sm text-gray-500 dark:text-gray-400">
            <span>Kelas {{ $siswa->kelas?->namaKelas ?? 'Belum ada kelas' }}</span>
            <span>•</span>
            <span>{{ $siswa->nis ?? '-' }}</span>
          </div>
          <div class="flex flex-wrap gap-2 pt-2">
            <span
              class="inline-flex items-center rounded-full bg-purple-100 px-3 py-0.5 text-xs font-medium text-purple-700 dark:bg-purple-800 dark:text-purple-300">Siswa
              Aktif</span>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-4 text-center">
          <div class="rounded-lg bg-purple-50 p-3 dark:bg-purple-900">
            <p class="text-3xl font-bold text-purple-700 dark:text-white">{{ $rataRataUAS }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Rata-rata UAS</p>
          </div>
          <div class="rounded-lg bg-purple-50 p-3 dark:bg-purple-900">
            <p class="text-3xl font-bold text-green-700 dark:text-green-400">6</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Bidang Potensi</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Potensi & Minat -->
    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
      <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">Potensi & Minat</h3>
      <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Badge menunjukkan 3 mata pelajaran dengan nilai tertinggi
        UAS</p>
      @foreach ($topPotensi as $potensiItem)
        @foreach ($potensiItem['potensi'] as $item)
          <span
            class="inline-flex items-center gap-2 rounded-full border border-transparent bg-purple-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-purple-700">
            {{ $item }}
          </span>
        @endforeach
      @endforeach
    </div>

    <!-- Grid Konten -->
    <div class="grid gap-6 lg:grid-cols-3">
      <!-- Kolom Kiri: Performa Akademik & Ekstrakurikuler -->
      <div class="space-y-6 lg:col-span-2">
        <!-- Performa Akademik -->
        <div x-data="{ type: 'uas' }"
          class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
          <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">Performa Akademik</h3>
          <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Nilai per mata pelajaran</p>

          <!-- Tombol UAS & UTS -->
          <div class="mb-6 flex gap-3">
            <!-- Tombol UAS -->
            <button @click="type = 'uas'"
              :class="type === 'uas' ? 'bg-purple-900' : 'bg-purple-600 hover:bg-purple-800'"
              class="flex-1 rounded-md px-4 py-2 font-semibold text-white focus:outline-none focus:ring-2 focus:ring-purple-400">
              UAS
            </button>

            <!-- Tombol UTS -->
            <button @click="type = 'uts'"
              :class="type === 'uts' ? 'bg-purple-900' : 'bg-purple-600 hover:bg-purple-800'"
              class="flex-1 rounded-md px-4 py-2 font-semibold text-white focus:outline-none focus:ring-2 focus:ring-purple-400">
              UTS
            </button>
          </div>

          <!-- Nilai -->
          <div>
            <template x-if="type === 'uas'">
              <div>
                @foreach ($siswa->uas as $uas)
                  <div class="flex justify-between text-sm font-medium text-gray-700 dark:text-gray-300">
                    <span>{{ $uas->mapel }}</span>
                    <span class="text-purple-700 dark:text-purple-300">{{ $uas->nilai }}</span>
                  </div>
                  <div class="h-2 w-full rounded-full bg-purple-50 dark:bg-purple-950">
                    <div class="h-2 rounded-full bg-purple-600 transition-all duration-300"
                      style="width: {{ $uas->nilai ?? 0 }}%"></div>
                  </div>
                @endforeach
              </div>
            </template>

            <template x-if="type === 'uts'">
              <div>
                @foreach ($siswa->uts as $uts)
                  <div class="flex justify-between text-sm font-medium text-gray-700 dark:text-gray-300">
                    <span>{{ $uts->mapel }}</span>
                    <span class="text-purple-700 dark:text-purple-300">{{ $uts->nilai }}</span>
                  </div>
                  <div class="h-2 w-full rounded-full bg-purple-50 dark:bg-purple-950">
                    <div class="h-2 rounded-full bg-purple-600 transition-all duration-300"
                      style="width: {{ $uts->nilai ?? 0 }}%"></div>
                  </div>
                @endforeach
              </div>
            </template>
          </div>
        </div>

        <!-- Ekstrakurikuler -->
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
          <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">Ekstrakurikuler</h3>
          <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Tingkat Partisipasi Siswa dalam Ekstrakurikuler</p>

          @forelse ($ekskuls as $item)
            <div class="flex justify-between text-sm font-medium text-gray-700 dark:text-gray-300">
              <span>{{ $item['nama'] }}</span>
              <span class="text-purple-700 dark:text-purple-300">
                {{ $item['tingkat_keterampilan'] }}
              </span>
            </div>

            <div class="text-sm text-gray-500 dark:text-gray-400">
              <span>Partisipasi: {{ $item['tingkat_partisipasi'] }}%</span>
            </div>

            <div class="h-2 w-full rounded-full bg-purple-50 dark:bg-purple-950">
              <div class="h-2 rounded-full bg-purple-600" style="width: {{ $item['tingkat_partisipasi'] }}%"></div>
            </div>
          @empty
            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data ekstrakurikuler.</p>
          @endforelse
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


    <!-- Catatan Guru & Pembina -->
    <div x-data="{ tab: 'guru' }" class="mt-6">

      <!-- Toggle -->
      <div class="mb-5 flex items-center gap-3">
        <button @click="tab = 'guru'"
          :class="tab === 'guru'
              ?
              'bg-purple-900 text-white' :
              'bg-purple-600 hover:bg-purple-800 text-white'"
          class="rounded-lg px-4 py-2 font-medium transition-all duration-200">
          Catatan Guru
        </button>

        <button @click="tab = 'pembina'"
          :class="tab === 'pembina'
              ?
              'bg-purple-900 text-white' :
              'bg-purple-600 hover:bg-purple-800 text-white'"
          class="rounded-lg px-4 py-2 font-medium transition-all duration-200">
          Catatan Pembina Ekstrakurikuler
        </button>
      </div>


      <!-- ====================== -->
      <!--       CATATAN GURU     -->
      <!-- ====================== -->
      <template x-if="tab === 'guru'">
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">

          <div class="text-base font-semibold text-gray-800 md:text-lg dark:text-white">
            Catatan dari Guru
          </div>

          @foreach ($catatanUTS as $uts)
            <div
              class="mb-4 flex flex-wrap items-start gap-4 border-b border-gray-200 pb-4 pt-7 md:flex-nowrap dark:border-gray-700">

              <!-- Foto Guru -->
              <div class="flex-shrink-0">
                <div
                  class="flex h-24 w-24 items-center justify-center rounded-full bg-gray-200 text-lg font-medium text-gray-400 shadow-inner dark:bg-gray-700 dark:text-gray-300">
                  {{ strtoupper(substr($uts['guru_nama'], 0, 2)) }}
                </div>
              </div>

              <!-- Info Guru -->
              <div class="flex flex-col justify-center pt-1.5 md:min-w-[180px]">
                <div class="text-base font-semibold text-gray-800 md:text-lg dark:text-white">
                  {{ $uts['guru_nama'] }}
                </div>
                <div class="text-sm text-gray-500 md:text-base dark:text-gray-400">
                  Guru {{ $uts['mapel'] }}
                </div>
              </div>

              <!-- Catatan UTS & UAS -->
              <div class="grid w-full grid-cols-2 gap-4">

                <!-- Catatan UTS -->
                <div class="flex h-full flex-col rounded-lg bg-gray-50 p-4 pt-6 shadow-sm dark:bg-gray-800">
                  <b class="text-gray-800 dark:text-white">Catatan UTS Siswa</b>
                  <p class="mt-1 text-base leading-relaxed text-gray-700 dark:text-gray-300">
                    {{ $uts['catatan'] ?? '-' }}
                  </p>
                </div>

                <!-- Cari catatan UAS dari mapel yg sama -->
                @php
                  $uasMapel = $catatanUAS->firstWhere('mapel', $uts['mapel']);
                @endphp

                <!-- Catatan UAS -->
                <div class="flex h-full flex-col rounded-lg bg-gray-50 p-4 pt-6 shadow-sm dark:bg-gray-800">
                  <b class="text-gray-800 dark:text-white">Catatan UAS Siswa</b>
                  <p class="mt-1 text-base leading-relaxed text-gray-700 dark:text-gray-300">
                    {{ $uasMapel['catatan'] ?? '-' }}
                  </p>
                </div>

              </div>

            </div>
          @endforeach


          @if ($catatanUTS->isEmpty() && $catatanUAS->isEmpty())
            <p class="mt-4 text-gray-600 dark:text-gray-400">Belum ada catatan dari guru.</p>
          @endif

        </div>
      </template>



      <!-- ======================================== -->
      <!--   CATATAN PEMBINA EKSTRAKURIKULER        -->
      <!-- ======================================== -->
      <template x-if="tab === 'pembina'">
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">

          <div class="text-base font-semibold text-gray-800 md:text-lg dark:text-white">
            Catatan dari Pembina Ekstrakurikuler
          </div>

          @foreach ($catatanPembina as $catatan)
            <div
              class="mb-4 flex flex-wrap items-start gap-4 border-b border-gray-200 pb-4 pt-7 md:flex-nowrap dark:border-gray-700">

              <!-- Foto Pembina -->
              <div class="flex-shrink-0">
                <div
                  class="flex h-24 w-24 items-center justify-center rounded-full bg-gray-200 text-lg font-medium text-gray-400 shadow-inner dark:bg-gray-700 dark:text-gray-300">
                  {{ strtoupper(substr($catatan['pembina_nama'], 0, 2)) }}
                </div>
              </div>

              <!-- Info Pembina -->
              <div class="mb-4 flex flex-col justify-center pt-1.5 md:min-w-[180px]">
                <div class="text-base font-semibold text-gray-800 md:text-lg dark:text-white">
                  {{ $catatan['pembina_nama'] }}
                </div>
                <div class="text-sm text-gray-500 md:text-base dark:text-gray-400">
                  Pembina {{ $catatan['pembina_ekskul'] }}
                </div>
              </div>

              <!-- Detail Catatan -->
              <div class="mb-6 grid w-full grid-cols-2 gap-4">

                <!-- Catatan -->
                <div class="col-span-2 flex h-full flex-col rounded-lg bg-gray-50 p-4 pt-6 shadow-sm dark:bg-gray-800">
                  <b class="text-gray-800 dark:text-white">Catatan</b>
                  <p class="mt-1 text-base leading-relaxed text-gray-700 dark:text-gray-300">
                    {{ $catatan['catatan'] }}
                  </p>
                </div>

                <!-- Alasan -->
                <div class="flex h-full flex-col rounded-lg bg-gray-50 p-4 pt-6 shadow-sm dark:bg-gray-800">
                  <b class="text-gray-800 dark:text-white">Alasan pemberian potensi</b>
                  <p class="mt-1 text-base leading-relaxed text-gray-700 dark:text-gray-300">
                    {{ $catatan['alasan'] }}
                  </p>
                </div>

                <!-- Pengembangan -->
                <div class="flex h-full flex-col rounded-lg bg-gray-50 p-4 pt-6 shadow-sm dark:bg-gray-800">
                  <b class="text-gray-800 dark:text-white">Pengembangan Potensi</b>
                  <p class="mt-1 text-base leading-relaxed text-gray-700 dark:text-gray-300">
                    {{ $catatan['pengembangan'] }}
                  </p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </template>
    </div>
  </div>
  </div>

  <script>
    const isDark = document.documentElement.classList.contains('dark');

    const ctx = document.getElementById('studentRadarChart');
    new Chart(ctx, {
      type: 'radar',
      data: {
        labels: @json($chartLabels),
        datasets: [{
          label: 'Potensi Siswa (Nilai UAS)',
          data: @json($chartData),
          backgroundColor: isDark ? 'rgba(139, 92, 246, 0.2)' : 'rgba(139, 92, 246, 0.2)',
          borderColor: isDark ? 'rgb(139, 92, 246)' : 'rgb(139, 92, 246)',
          borderWidth: 2,
          pointBackgroundColor: isDark ? 'rgb(139, 92, 246)' : 'rgb(139, 92, 246)',
        }]
      },
      options: {
        plugins: {
          legend: {
            labels: {
              color: isDark ? '#D1D5DB' : '#374151'
            }
          }
        },
        scales: {
          r: {
            suggestedMin: 0,
            suggestedMax: 100,
            ticks: {
              stepSize: 20,
              color: isDark ? '#D1D5DB' : '#374151'
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
