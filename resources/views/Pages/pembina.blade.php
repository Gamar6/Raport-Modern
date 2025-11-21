@extends('app')

@section('title', 'Dashboard Pembina Ekstrakurikuler')

@section('content')
  <div class="min-h-screen space-y-8 bg-gray-50 p-6 transition-colors duration-300 dark:bg-gray-900">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard Pembina</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Halo, <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $namaPembina }}</span>. Kelola aktivitas ekstrakurikuler <span class="font-bold text-gray-700 dark:text-gray-300">{{ $namaEkskul }}</span> di sini.
        </p>
      </div>
      <div class="hidden md:flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-600 shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <span>{{ now()->translatedFormat('l, d F Y') }}</span>
      </div>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
      
      <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-400">Ekstrakurikuler</p>
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $namaEkskul }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-600 dark:bg-orange-900/20 dark:text-orange-400">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path opacity="0.4" d="M5 3L19 12L5 21V3Z" fill="currentColor" stroke="none"/>
                <path d="M5 3L19 12L5 21V3Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5 21V3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-400">Total Anggota</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalAnggota }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path opacity="0.4" d="M2 21V17C2 15.8954 2.89543 15 4 15H14C15.1046 15 16 15.8954 16 17V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55667C18.7122 5.26263 19.0104 6.13638 19.0104 7.045C19.0104 7.95362 18.7122 8.82737 18.1676 9.53333C17.623 10.2393 16.8604 10.7397 16 10.96M16 15C19.0001 15.0001 21.4376 17.2582 21.9169 20.2275" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-400">Rata-rata Partisipasi</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $rataPartisipasi }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path opacity="0.4" d="M12 20V10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M18 20V4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M6 20V16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Penilaian Aktivitas -->
    <div class="grid gap-8 lg:grid-cols-2">
        <div class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="absolute top-0 left-0 h-1 w-full bg-blue-500"></div>
            <h3 class="mb-6 flex items-center text-lg font-bold text-gray-800 dark:text-gray-100">
                <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                </div>
                Penilaian Aktivitas
            </h3>

            @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-50 p-3 text-sm text-green-700 dark:bg-green-900/20 dark:text-green-300 border border-green-100">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('pembina.nilai.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="ekskul_id" value="{{ $ekskul->id }}">

                <div>
                    <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Nama Siswa</label>
                    <select name="siswa_id" required class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($anggota as $a)
                            <option value="{{ $a->siswa->id }}">{{ $a->siswa->namaSiswa }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Partisipasi (%)</label>
                        <input type="number" name="tingkat_partisipasi" min="0" max="100" placeholder="0-100" required class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Keterampilan</label>
                        <select name="tingkat_keterampilan" required class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
                            <option value="Mahir">Mahir</option>
                            <option value="Lanjut">Lanjut</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Pemula">Pemula</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Catatan (Opsional)</label>
                    <textarea name="catatan" rows="3" placeholder="Catatan tambahan..." class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200"></textarea>
                </div>

                <button type="submit" class="w-full rounded-lg bg-blue-600 py-2.5 text-sm font-semibold text-white transition-all hover:bg-blue-700 hover:shadow-lg dark:bg-blue-700">
                    Simpan Penilaian
                </button>
            </form>
        </div>

        <div class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="absolute top-0 left-0 h-1 w-full bg-purple-500"></div>
            <h3 class="mb-6 flex items-center text-lg font-bold text-gray-800 dark:text-gray-100">
                <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                </div>
                Penilaian Potensi
            </h3>

            @if (session('SUKSES'))
            <div class="mb-4 rounded-lg bg-green-50 p-3 text-sm text-green-700 dark:bg-green-900/20 dark:text-green-300 border border-green-100">
                {{ session('SUKSES') }}
            </div>
            @endif

            <form method="POST" action="{{ route('pembina.catatan.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="ekskul_id" value="{{ $ekskul->id }}">

                <div>
                    <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Nama Siswa</label>
                    <select name="siswa_id" required class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($anggota as $a)
                            <option value="{{ $a->siswa->id }}">{{ $a->siswa->namaSiswa }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Potensi Utama</label>
                    <input type="text" name="potensi" placeholder="Contoh: Menjadi Atlet Nasional" class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Alasan Penilaian</label>
                        <textarea name="alasan" rows="3" class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200"></textarea>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Rekomendasi</label>
                        <textarea name="rekomendasi" rows="3" class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200"></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full rounded-lg bg-purple-600 py-2.5 text-sm font-semibold text-white transition-all hover:bg-purple-700 hover:shadow-lg dark:bg-purple-700">
                    Simpan Potensi
                </button>
            </form>
        </div>
    </div>

    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Grafik Partisipasi Siswa</h3>
             <svg class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" /></svg>
        </div>
        <div class="relative h-80 w-full">
            <canvas id="chartPartisipasi"></canvas>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 flex items-center text-lg font-bold text-gray-800 dark:text-gray-100">
                <span class="mr-2 text-yellow-500">🏆</span> Top 5 Partisipasi
            </h3>
            <div class="space-y-3">
                @foreach ($top5 as $index => $s)
                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-3 dark:bg-gray-700/50">
                    <div class="flex items-center gap-3">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-yellow-100 text-xs font-bold text-yellow-700">{{ $index + 1 }}</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $s->siswa->namaSiswa }}</span>
                    </div>
                    <span class="rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-bold text-green-700">
                        {{ optional($s->penilaianEkskul)->tingkat_partisipasi ?? 0 }}%
                    </span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 flex items-center text-lg font-bold text-gray-800 dark:text-gray-100">
                <span class="mr-2 text-red-500">⚠️</span> Butuh Perhatian (< 60%)
            </h3>
            @if ($butuhPerhatian->isEmpty())
                <div class="flex h-full flex-col items-center justify-center text-center text-gray-500">
                    <svg class="h-10 w-10 text-green-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-sm">Luar biasa! Semua siswa aktif.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($butuhPerhatian as $s)
                    <div class="flex items-center justify-between rounded-lg bg-red-50 p-3 border border-red-100 dark:bg-red-900/20 dark:border-red-800">
                        <span class="text-sm font-medium text-red-700 dark:text-red-300">{{ $s->siswa->namaSiswa }}</span>
                        <span class="rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-bold text-red-700 dark:bg-red-900 dark:text-red-200">
                            {{ optional($s->penilaianEkskul)->tingkat_partisipasi ?? 0 }}%
                        </span>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div x-data="{ tingkat: 'all' }" class="rounded-2xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-100 p-6 dark:border-gray-700">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Daftar Anggota</h3>
                <div class="flex flex-wrap gap-2">
                    <button @click="tingkat = 'all'"
                        :class="tingkat === 'all' ? 'bg-blue-600 text-white shadow-md ring-2 ring-blue-200 dark:ring-blue-900' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300'"
                        class="rounded-lg px-4 py-2 text-xs font-bold transition-all duration-200">
                        Semua
                    </button>
                    @foreach ($listSiswa as $t => $siswa)
                        <button @click="tingkat = '{{ $t }}'"
                            :class="tingkat === '{{ $t }}' ? 'bg-blue-600 text-white shadow-md ring-2 ring-blue-200 dark:ring-blue-900' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300'"
                            class="rounded-lg px-4 py-2 text-xs font-bold transition-all duration-200 flex items-center gap-2">
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
                    class="group relative rounded-xl border border-gray-100 bg-white p-4 shadow-sm hover:border-blue-400 hover:shadow-md transition-all dark:border-gray-700 dark:bg-gray-800 dark:hover:border-blue-500">
                    
                    <div class="flex items-center gap-3">
                         <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-gray-100 to-gray-200 text-sm font-bold text-gray-600 dark:from-gray-700 dark:to-gray-600 dark:text-gray-200">
                            <span x-text="s.charAt(0)"></span>
                         </div>
                         <div>
                            <p class="font-semibold text-gray-900 text-sm dark:text-gray-100" x-text="s"></p>
                            <span class="inline-block mt-1 rounded bg-blue-50 px-1.5 py-0.5 text-[10px] font-bold uppercase tracking-wide text-blue-600 dark:bg-blue-900/30 dark:text-blue-300">
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
    // Style Chart dimodernisasi (Grid dashed, Font family, dll) namun Logika Warna Merah/Hijau tetap dipertahankan.
    
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
            if (value >= 90) return 'rgba(16, 185, 129, 0.8)'; // Emerald-500
            if (value >= 60) return 'rgba(59, 130, 246, 0.8)'; // Blue-500
            return 'rgba(239, 68, 68, 0.8)'; // Red-500
          },
          borderColor: function(context) {
            const value = context.parsed.x;
            if (value >= 90) return 'rgba(16, 185, 129, 1)';
            if (value >= 60) return 'rgba(59, 130, 246, 1)';
            return 'rgba(239, 68, 68, 1)';
          },
          borderWidth: 1,
          borderRadius: 4,
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
                backgroundColor: 'rgba(17, 24, 39, 0.9)',
                padding: 10,
                cornerRadius: 8,
                titleFont: { size: 13 },
                bodyFont: { size: 13 }
            }
        },
        scales: {
          x: {
            beginAtZero: true,
            max: 100,
            grid: { color: 'rgba(0,0,0,0.05)', borderDash: [5, 5] },
            ticks: { font: { size: 11 } }
          },
          y: {
             grid: { display: false },
             ticks: { font: { weight: '500' } }
          }
        },
        animation: { duration: 1500, easing: 'easeOutQuart' }
      }
    });
  </script>
@endsection