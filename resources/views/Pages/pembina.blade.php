@extends('app')

@section('title', 'Dashboard Pembina Ekstrakurikuler')

@section('content')
  <div class="min-h-screen space-y-8 bg-gray-50/50 p-6 transition-colors duration-300 dark:bg-gray-900">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between animate-fade-in-up">
      <div>
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Dashboard Pembina</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
          Halo, <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $namaPembina }}</span>. Kelola aktivitas ekstrakurikuler <span class="font-bold text-gray-900 dark:text-white">{{ $namaEkskul }}</span>.
        </p>
      </div>
      
      <div class="hidden md:flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-1.5 text-xs font-medium text-gray-600 shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <span>{{ now()->translatedFormat('l, d F Y') }}</span>
      </div>
    </div>

    <div class="grid gap-6 md:grid-cols-3 animate-fade-in-up delay-100">
      
      <div class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-8 shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Ekstrakurikuler</p>
            <h3 class="truncate text-xl font-extrabold text-gray-900 dark:text-white" title="{{ $namaEkskul }}">{{Str::limit($namaEkskul, 15) }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-500 text-white shadow-lg shadow-orange-500/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-8 shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Anggota</p>
            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $totalAnggota }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-8 shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Rata-rata Partisipasi</p>
            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $rataPartisipasi }}%</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500 text-white shadow-lg shadow-emerald-500/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-2 animate-fade-in-up delay-200">
      
      <div class="relative overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-100 bg-blue-50/50 px-6 py-5 dark:border-gray-700 dark:bg-blue-900/10">
            <h3 class="flex items-center text-lg font-bold text-gray-900 dark:text-white">
                <span class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600 text-white shadow-md shadow-blue-600/20">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                </span>
                Penilaian Aktivitas
            </h3>
        </div>

        <div class="p-6">
            @if (session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-100 bg-emerald-50 p-4 text-sm font-medium text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-900/20 dark:text-emerald-400">
                <svg class="h-5 w-5 flex-shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('pembina.nilai.store') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="ekskul_id" value="{{ $ekskul->id }}">

                <div>
                    <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nama Siswa</label>
                    <div class="relative">
                        <select name="siswa_id" required class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach ($anggota as $a)
                                <option value="{{ $a->siswa->id }}">{{ $a->siswa->namaSiswa }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Partisipasi (%)</label>
                        <input type="number" name="tingkat_partisipasi" min="0" max="100" placeholder="0-100" required class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Keterampilan</label>
                        <select name="tingkat_keterampilan" required class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="Mahir">Mahir</option>
                            <option value="Lanjut">Lanjut</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Pemula">Pemula</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Catatan (Opsional)</label>
                    <textarea name="catatan" rows="3" placeholder="Catatan tambahan..." class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
                </div>

                <button type="submit" class="w-full rounded-xl bg-blue-600 py-3 text-sm font-bold text-white shadow-md shadow-blue-600/20 transition-all hover:bg-blue-700 hover:shadow-lg active:scale-[0.98]">
                    Simpan Penilaian
                </button>
            </form>
        </div>
      </div>

      <div class="relative overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-100 bg-purple-50/50 px-6 py-5 dark:border-gray-700 dark:bg-purple-900/10">
            <h3 class="flex items-center text-lg font-bold text-gray-900 dark:text-white">
                <span class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-purple-600 text-white shadow-md shadow-purple-600/20">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </span>
                Penilaian Potensi
            </h3>
        </div>

        <div class="p-6">
            @if (session('SUKSES'))
            <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-100 bg-emerald-50 p-4 text-sm font-medium text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-900/20 dark:text-emerald-400">
                <svg class="h-5 w-5 flex-shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                {{ session('SUKSES') }}
            </div>
            @endif

            <form method="POST" action="{{ route('pembina.catatan.store') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="ekskul_id" value="{{ $ekskul->id }}">

                <div>
                    <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nama Siswa</label>
                    <select name="siswa_id" required class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($anggota as $a)
                            <option value="{{ $a->siswa->id }}">{{ $a->siswa->namaSiswa }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Potensi Utama</label>
                    <input type="text" name="potensi" placeholder="Contoh: Menjadi Atlet Nasional" class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Alasan Penilaian</label>
                        <textarea name="alasan" rows="3" class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Rekomendasi</label>
                        <textarea name="rekomendasi" rows="3" class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full rounded-xl bg-purple-600 py-3 text-sm font-bold text-white shadow-md shadow-purple-600/20 transition-all hover:bg-purple-700 hover:shadow-lg active:scale-[0.98]">
                    Simpan Potensi
                </button>
            </form>
        </div>
      </div>
    </div>

    <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-300">
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Grafik Partisipasi Siswa</h3>
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" /></svg>
            </div>
        </div>
        <div class="relative h-80 w-full">
            <canvas id="chartPartisipasi"></canvas>
        </div>
    </div>

    <div class="grid gap-8 md:grid-cols-2 animate-fade-in-up delay-300">
        <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-6 flex items-center text-lg font-bold text-gray-900 dark:text-white">
                <span class="mr-2 text-xl">🏆</span> Top 5 Partisipasi
            </h3>
            <div class="space-y-4">
                @foreach ($top5 as $index => $s)
                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4 transition-colors hover:bg-gray-100 dark:bg-gray-700/30 dark:hover:bg-gray-700/50">
                    <div class="flex items-center gap-4">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-yellow-100 text-sm font-bold text-yellow-700 ring-1 ring-yellow-200">{{ $index + 1 }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $s->siswa->namaSiswa }}</span>
                    </div>
                    <span class="inline-flex items-center rounded-md bg-green-50 px-2.5 py-0.5 text-xs font-bold text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-900/30 dark:text-green-400">
                        {{ optional($s->penilaianEkskul)->tingkat_partisipasi ?? 0 }}%
                    </span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-6 flex items-center text-lg font-bold text-gray-900 dark:text-white">
                <span class="mr-2 text-xl">⚠️</span> Butuh Perhatian (&lt; 60%)
            </h3>
            @if ($butuhPerhatian->isEmpty())
                <div class="flex h-full flex-col items-center justify-center py-8 text-center text-gray-500">
                    <div class="mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-green-50 text-green-500 dark:bg-green-900/20">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-sm font-medium">Luar biasa! Semua siswa aktif.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($butuhPerhatian as $s)
                    <div class="flex items-center justify-between rounded-xl bg-red-50 p-4 border border-red-100 dark:bg-red-900/10 dark:border-red-800/50">
                        <span class="font-semibold text-red-700 dark:text-red-300">{{ $s->siswa->namaSiswa }}</span>
                        <span class="inline-flex items-center rounded-md bg-red-100 px-2.5 py-0.5 text-xs font-bold text-red-700 dark:bg-red-900/50 dark:text-red-200">
                            {{ optional($s->penilaianEkskul)->tingkat_partisipasi ?? 0 }}%
                        </span>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div x-data="{ tingkat: 'all' }" class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-300">
        <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-700">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Anggota</h3>
                
                <div class="flex flex-wrap gap-2">
                    <button @click="tingkat = 'all'"
                        :class="tingkat === 'all' ? 'bg-blue-600 text-white shadow-md ring-2 ring-blue-600 dark:ring-blue-500' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300'"
                        class="rounded-lg px-4 py-2 text-xs font-bold transition-all duration-200">
                        Semua
                    </button>
                    @foreach ($listSiswa as $t => $siswa)
                        <button @click="tingkat = '{{ $t }}'"
                            :class="tingkat === '{{ $t }}' ? 'bg-blue-600 text-white shadow-md ring-2 ring-blue-600 dark:ring-blue-500' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300'"
                            class="flex items-center gap-2 rounded-lg px-4 py-2 text-xs font-bold transition-all duration-200">
                            {{ $t }}
                            <span class="flex h-4 w-4 items-center justify-center rounded-full bg-white/20 text-[10px]">
                                {{ count($siswa) }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="p-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($listSiswa as $t => $siswas)
                <template x-for="(s, index) in {{ json_encode($siswas) }}" :key="index">
                <div x-show="tingkat === 'all' || tingkat === '{{ $t }}'"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="group relative rounded-2xl border border-gray-100 bg-white p-4 shadow-sm hover:border-blue-400 hover:shadow-md transition-all dark:border-gray-700 dark:bg-gray-800 dark:hover:border-blue-500">
                    
                    <div class="flex items-center gap-4">
                         <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-600 ring-2 ring-white dark:bg-blue-900 dark:text-blue-300 dark:ring-gray-700">
                            <span x-text="s.charAt(0)"></span>
                         </div>
                         <div>
                            <p class="font-bold text-gray-900 text-sm dark:text-white" x-text="s"></p>
                            <span class="mt-1 inline-block rounded-md bg-blue-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-blue-600 dark:bg-blue-900/30 dark:text-blue-300">
                                {{ $t }}
                            </span>
                         </div>
                    </div>
                </div>
                </template>
            @endforeach
        </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Chart Partisipasi Logic
    const isDark = document.documentElement.classList.contains('dark');

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
            if (value >= 90) return '#10b981'; // Emerald-500 Solid
            if (value >= 60) return '#3b82f6'; // Blue-500 Solid
            return '#ef4444'; // Red-500 Solid
          },
          borderWidth: 0,
          borderRadius: 6,
          barPercentage: 0.6,
          categoryPercentage: 0.8
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: isDark ? 'rgba(17, 24, 39, 0.95)' : 'rgba(255, 255, 255, 0.95)',
                titleColor: isDark ? '#fff' : '#111',
                bodyColor: isDark ? '#fff' : '#444',
                borderColor: isDark ? '#374151' : '#e5e7eb',
                borderWidth: 1,
                padding: 10,
                cornerRadius: 8,
                titleFont: { size: 13, family: "'Inter', sans-serif" },
                bodyFont: { size: 13, family: "'Inter', sans-serif" },
                displayColors: false
            }
        },
        scales: {
          x: {
            beginAtZero: true,
            max: 100,
            grid: { 
                color: isDark ? '#374151' : '#f3f4f6', 
                borderDash: [4, 4] 
            },
            ticks: { 
                font: { size: 11, family: "'Inter', sans-serif" },
                color: isDark ? '#9ca3af' : '#6b7280'
            }
          },
          y: {
             grid: { display: false },
             ticks: { 
                 font: { weight: '600', family: "'Inter', sans-serif" },
                 color: isDark ? '#d1d5db' : '#374151'
             }
          }
        },
        animation: { duration: 1000, easing: 'easeOutQuart' }
      }
    });
  </script>

  <style>
      @keyframes fadeInUp {
          from { opacity: 0; transform: translateY(10px); }
          to { opacity: 1; transform: translateY(0); }
      }
      .animate-fade-in-up {
          animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
          opacity: 0;
      }
      .delay-100 { animation-delay: 0.1s; }
      .delay-200 { animation-delay: 0.2s; }
      .delay-300 { animation-delay: 0.3s; }
  </style>
@endsection