@extends('app')

@section('title', 'Profil Siswa')

@section('content')
  <div class="min-h-screen space-y-8 bg-gray-50/50 p-6 transition-colors duration-300 dark:bg-gray-900">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between animate-fade-in-up">
      <div>
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Profil Siswa</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
          Laporan perkembangan komprehensif untuk <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $siswa->user->username }}</span>.
        </p>
      </div>
      
      <div class="hidden md:flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-1.5 text-xs font-medium text-gray-600 shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <span>{{ now()->translatedFormat('l, d F Y') }}</span>
      </div>
    </div>

    <div class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-8 shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-100">
        <div class="flex flex-col md:flex-row md:items-center gap-8">
            <div class="relative">
                <div class="flex h-24 w-24 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 text-4xl font-bold text-white shadow-lg shadow-blue-600/20">
                    {{ substr($siswa->user->username, 0, 1) }}
                </div>
                <div class="absolute -bottom-2 -right-2 rounded-lg bg-white p-1 dark:bg-gray-800">
                    <div class="flex items-center gap-1 rounded-md bg-green-100 px-2 py-0.5 text-[10px] font-bold uppercase text-green-700 dark:bg-green-900 dark:text-green-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span> Aktif
                    </div>
                </div>
            </div>

            <div class="flex-1 space-y-3">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $siswa->user->username }}</h2>
                    <div class="mt-1 flex items-center gap-4 text-sm font-medium text-gray-500 dark:text-gray-400">
                        <span class="flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Kelas {{ $siswa->kelas?->namaKelas ?? '-' }}
                        </span>
                        <span class="h-1 w-1 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                        <span class="flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                            NIS: {{ $siswa->nis ?? '-' }}
                        </span>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-2">
                    @foreach ($topPotensi as $potensiItem)
                        @foreach ($potensiItem['potensi'] as $item)
                            <span class="inline-flex items-center rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-700/10 transition-colors hover:bg-indigo-100 dark:bg-indigo-900/30 dark:text-indigo-300 dark:ring-indigo-500/30">
                                {{ $item }}
                            </span>
                        @endforeach
                    @endforeach
                    @if(empty($topPotensi))
                        <span class="text-xs italic text-gray-400">Belum ada data potensi.</span>
                    @endif
                </div>
            </div>

            <div class="flex gap-8 border-l border-gray-100 pl-8 dark:border-gray-700">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Rata-rata UAS</p>
                    <p class="mt-1 text-4xl font-extrabold tracking-tight text-blue-600 dark:text-blue-400">{{ $rataRataUAS }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Mapel</p>
                    <p class="mt-1 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">{{ $siswa->uas->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        
        <div class="space-y-8 lg:col-span-2">
            
            <div x-data="{ type: 'uas' }" class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-200">
                <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="flex items-center gap-2 text-lg font-bold text-gray-900 dark:text-white">
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                            </span>
                            Performa Akademik
                        </h3>
                        
                        <div class="flex rounded-lg bg-gray-100 p-1 dark:bg-gray-700/50">
                            <button @click="type = 'uas'" 
                                :class="type === 'uas' ? 'bg-white text-blue-600 shadow-sm dark:bg-gray-600 dark:text-white' : 'text-gray-500 hover:text-gray-900 dark:text-gray-400'"
                                class="rounded-md px-4 py-1.5 text-xs font-bold transition-all duration-200">
                                UAS
                            </button>
                            <button @click="type = 'uts'" 
                                :class="type === 'uts' ? 'bg-white text-blue-600 shadow-sm dark:bg-gray-600 dark:text-white' : 'text-gray-500 hover:text-gray-900 dark:text-gray-400'"
                                class="rounded-md px-4 py-1.5 text-xs font-bold transition-all duration-200">
                                UTS
                            </button>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <template x-if="type === 'uas'">
                            <div class="contents">
                                @foreach ($siswa->uas as $uas)
                                    <div class="group flex flex-col justify-between rounded-xl border border-gray-100 bg-gray-50 p-4 transition-all hover:border-blue-200 hover:bg-blue-50/50 dark:border-gray-700 dark:bg-gray-700/30 dark:hover:border-blue-500/30">
                                        <div class="mb-3 flex justify-between">
                                            <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $uas->mapel }}</span>
                                            <span class="font-bold {{ $uas->nilai >= 85 ? 'text-emerald-600' : ($uas->nilai >= 70 ? 'text-blue-600' : 'text-rose-600') }}">
                                                {{ $uas->nilai }}
                                            </span>
                                        </div>
                                        <div class="relative h-2 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-600">
                                            <div class="h-full rounded-full transition-all duration-1000 ease-out {{ $uas->nilai >= 85 ? 'bg-emerald-500' : ($uas->nilai >= 70 ? 'bg-blue-500' : 'bg-rose-500') }}" 
                                                 style="width: {{ $uas->nilai ?? 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </template>

                        <template x-if="type === 'uts'">
                            <div class="contents">
                                @foreach ($siswa->uts as $uts)
                                    <div class="group flex flex-col justify-between rounded-xl border border-gray-100 bg-gray-50 p-4 transition-all hover:border-indigo-200 hover:bg-indigo-50/50 dark:border-gray-700 dark:bg-gray-700/30 dark:hover:border-indigo-500/30">
                                        <div class="mb-3 flex justify-between">
                                            <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $uts->mapel }}</span>
                                            <span class="font-bold {{ $uts->nilai >= 85 ? 'text-emerald-600' : ($uts->nilai >= 70 ? 'text-indigo-600' : 'text-rose-600') }}">
                                                {{ $uts->nilai }}
                                            </span>
                                        </div>
                                        <div class="relative h-2 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-600">
                                            <div class="h-full rounded-full transition-all duration-1000 ease-out {{ $uts->nilai >= 85 ? 'bg-emerald-500' : ($uts->nilai >= 70 ? 'bg-indigo-500' : 'bg-rose-500') }}" 
                                                 style="width: {{ $uts->nilai ?? 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-300">
                <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-700">
                    <h3 class="flex items-center gap-2 text-lg font-bold text-gray-900 dark:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-100 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3L19 12L5 21V3Z" /></svg>
                        </span>
                        Aktivitas Ekstrakurikuler
                    </h3>
                </div>

                <div class="p-6 space-y-4">
                    @forelse ($ekskuls as $item)
                        <div class="flex flex-col gap-4 rounded-2xl bg-gray-50 p-5 transition-all hover:bg-gray-100 sm:flex-row sm:items-center dark:bg-gray-700/30 dark:hover:bg-gray-700/50">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-white text-2xl shadow-sm ring-1 ring-gray-100 dark:bg-gray-800 dark:ring-gray-700">
                                🏃
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-bold text-gray-900 dark:text-white">{{ $item['nama'] }}</h4>
                                    <span class="inline-flex items-center rounded-md bg-white px-2.5 py-0.5 text-xs font-bold text-gray-700 ring-1 ring-inset ring-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-600">
                                        {{ $item['tingkat_keterampilan'] }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-16">Partisipasi</span>
                                    <div class="h-2 flex-1 overflow-hidden rounded-full bg-gray-200 dark:bg-gray-600">
                                        <div class="h-full rounded-full bg-gradient-to-r from-orange-400 to-red-500" style="width: {{ $item['tingkat_partisipasi'] }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-gray-700 dark:text-gray-300">{{ $item['tingkat_partisipasi'] }}%</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center rounded-xl border border-dashed border-gray-300 bg-gray-50 py-10 dark:border-gray-700 dark:bg-gray-800/50">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Belum mengikuti ekstrakurikuler</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="space-y-8">
            
            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-200">
                <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white">Peta Potensi</h3>
                <p class="mb-6 text-xs text-gray-500 dark:text-gray-400">Visualisasi kekuatan akademik berdasarkan nilai UAS.</p>
                
                <div class="relative aspect-square w-full">
                    <canvas id="studentRadarChart"></canvas>
                </div>
            </div>

            <div x-data="{ tab: 'guru' }" class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-300">
                
                <div class="border-b border-gray-100 px-6 py-4 dark:border-gray-700">
                    <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Catatan & Feedback</h3>
                    <div class="flex w-full rounded-xl bg-gray-100 p-1 dark:bg-gray-700">
                        <button @click="tab = 'guru'" 
                            :class="tab === 'guru' ? 'bg-white text-blue-600 shadow-sm dark:bg-gray-600 dark:text-white' : 'text-gray-500 hover:text-gray-900 dark:text-gray-400'"
                            class="flex-1 rounded-lg py-2 text-xs font-bold transition-all">
                            Guru Mapel
                        </button>
                        <button @click="tab = 'pembina'" 
                            :class="tab === 'pembina' ? 'bg-white text-blue-600 shadow-sm dark:bg-gray-600 dark:text-white' : 'text-gray-500 hover:text-gray-900 dark:text-gray-400'"
                            class="flex-1 rounded-lg py-2 text-xs font-bold transition-all">
                            Pembina Ekskul
                        </button>
                    </div>
                </div>

                <div class="max-h-[500px] overflow-y-auto p-6 scrollbar-thin scrollbar-thumb-gray-200 dark:scrollbar-thumb-gray-700">
                    
                    <div x-show="tab === 'guru'" x-transition.opacity.duration.300ms>
                        @forelse ($catatanUTS as $uts)
                            <div class="mb-6 last:mb-0">
                                <div class="flex gap-4">
                                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700 ring-4 ring-white dark:bg-blue-900 dark:text-blue-300 dark:ring-gray-800">
                                        {{ strtoupper(substr($uts['guru_nama'], 0, 2)) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">{{ $uts['guru_nama'] }}</h4>
                                            <span class="rounded-full bg-gray-100 px-2 py-0.5 text-[10px] font-bold text-gray-600 dark:bg-gray-700 dark:text-gray-300">{{ $uts['mapel'] }}</span>
                                        </div>
                                        
                                        <div class="mt-3 space-y-2 border-l-2 border-blue-100 pl-4 dark:border-blue-900/50">
                                            <div>
                                                <span class="mb-1 block text-[10px] font-bold uppercase tracking-wide text-blue-600 dark:text-blue-400">UTS</span>
                                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $uts['catatan'] ?? 'Tidak ada catatan.' }}</p>
                                            </div>

                                            @php $uasMapel = $catatanUAS->firstWhere('mapel', $uts['mapel']); @endphp
                                            @if($uasMapel && $uasMapel['catatan'])
                                                <div>
                                                    <span class="mb-1 block text-[10px] font-bold uppercase tracking-wide text-indigo-600 dark:text-indigo-400">UAS</span>
                                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $uasMapel['catatan'] }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-sm text-gray-500 italic">Belum ada catatan guru.</p>
                        @endforelse
                    </div>

                    <div x-show="tab === 'pembina'" x-transition.opacity.duration.300ms style="display: none;">
                        @forelse ($catatanPembina as $catatan)
                            <div class="mb-6 last:mb-0">
                                <div class="flex gap-4">
                                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-orange-100 text-xs font-bold text-orange-700 ring-4 ring-white dark:bg-orange-900 dark:text-orange-300 dark:ring-gray-800">
                                        {{ strtoupper(substr($catatan['pembina_nama'], 0, 2)) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">{{ $catatan['pembina_nama'] }}</h4>
                                            <span class="rounded-full bg-gray-100 px-2 py-0.5 text-[10px] font-bold text-gray-600 dark:bg-gray-700 dark:text-gray-300">{{ $catatan['pembina_ekskul'] }}</span>
                                        </div>
                                        
                                        <div class="mt-3 space-y-3 rounded-xl bg-gray-50 p-4 dark:bg-gray-700/30">
                                            <div>
                                                <span class="block text-[10px] font-bold uppercase text-gray-400">Evaluasi</span>
                                                <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $catatan['catatan'] }}</p>
                                            </div>
                                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                                <div>
                                                    <span class="block text-[10px] font-bold uppercase text-gray-400">Potensi</span>
                                                    <p class="text-xs text-gray-600 dark:text-gray-300">{{ $catatan['alasan'] }}</p>
                                                </div>
                                                <div>
                                                    <span class="block text-[10px] font-bold uppercase text-gray-400">Rekomendasi</span>
                                                    <p class="text-xs text-gray-600 dark:text-gray-300">{{ $catatan['pengembangan'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-sm text-gray-500 italic">Belum ada catatan pembina.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const isDark = document.documentElement.classList.contains('dark');
    
    const chartColors = {
        fill: isDark ? 'rgba(37, 99, 235, 0.2)' : 'rgba(37, 99, 235, 0.2)', // Blue-600
        stroke: isDark ? '#60a5fa' : '#2563eb',
        point: isDark ? '#60a5fa' : '#2563eb',
        grid: isDark ? '#374151' : '#e5e7eb',
        text: isDark ? '#9ca3af' : '#6b7280'
    };

    const ctx = document.getElementById('studentRadarChart');
    
    if(ctx) {
        new Chart(ctx, {
          type: 'radar',
          data: {
            labels: @json($chartLabels),
            datasets: [{
              label: 'Potensi Akademik',
              data: @json($chartData),
              backgroundColor: chartColors.fill,
              borderColor: chartColors.stroke,
              borderWidth: 2,
              pointBackgroundColor: chartColors.point,
              pointBorderColor: '#fff',
              pointHoverBackgroundColor: '#fff',
              pointHoverBorderColor: chartColors.stroke,
              pointRadius: 4
            }]
          },
          options: {
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
                  padding: 12,
                  cornerRadius: 8,
                  displayColors: false,
                  titleFont: { size: 13, family: "'Inter', sans-serif", weight: 'bold' },
                  bodyFont: { size: 13, family: "'Inter', sans-serif" }
              }
            },
            scales: {
              r: {
                suggestedMin: 0,
                suggestedMax: 100,
                ticks: {
                  stepSize: 20,
                  display: false, 
                  backdropColor: 'transparent'
                },
                grid: {
                  color: chartColors.grid,
                  borderDash: [4, 4],
                  circular: true 
                },
                angleLines: { color: chartColors.grid },
                pointLabels: {
                  color: chartColors.text,
                  font: { size: 11, weight: '600', family: "'Inter', sans-serif" }
                }
              }
            }
          }
        });
    }
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