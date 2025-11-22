@extends('app')

@section('title', 'Dashboard Guru')

@section('content')
  <div class="min-h-screen space-y-8 bg-gray-50/50 p-6 transition-colors duration-300 dark:bg-gray-900">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between animate-fade-in-up">
      <div>
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Dashboard Akademik</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
          Selamat datang kembali, <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $nama }}</span>. Berikut ringkasan aktivitas kelasmu.
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
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Mata Pelajaran</p>
            <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $mapel }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-8 shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Kelas</p>
            <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $totalKelas }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-8 shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Siswa</p>
            <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $totalSiswa }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-600 text-white shadow-lg shadow-purple-600/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
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
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
              </span>
              Input Nilai UTS
            </h3>
        </div>
        
        <div class="p-6">
            <form action="{{ route('guru.uts.store') }}" method="POST" class="space-y-5">
              @csrf
              <div>
                <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Pilih Siswa</label>
                <div class="relative">
                    <select name="siswa_id" required class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                      <option value="">-- Cari nama siswa --</option>
                      @foreach ($semuaSiswa as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->namaSiswa }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div>
                <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nilai (0-100)</label>
                <input type="number" name="nilai" min="0" max="100" placeholder="Contoh: 85" class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white" />
              </div>
              <div>
                <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Catatan Guru</label>
                <textarea name="catatan" rows="3" placeholder="Berikan evaluasi singkat..." class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
              </div>
              <button type="submit" class="w-full rounded-xl bg-blue-600 py-3 text-sm font-bold text-white shadow-md shadow-blue-600/20 transition-all hover:bg-blue-700 hover:shadow-lg active:scale-[0.98]">
                Simpan Nilai UTS
              </button>
            </form>
        </div>
      </div>

      <div class="relative overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-100 bg-indigo-50/50 px-6 py-5 dark:border-gray-700 dark:bg-indigo-900/10">
            <h3 class="flex items-center text-lg font-bold text-gray-900 dark:text-white">
              <span class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-md shadow-indigo-600/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
              </span>
              Input Nilai UAS
            </h3>
        </div>

        <div class="p-6">
            <form action="{{ route('guru.uas.store') }}" method="POST" class="space-y-5">
              @csrf
              <div>
                <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Pilih Siswa</label>
                <select name="siswa_id" required class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                  <option value="">-- Cari nama siswa --</option>
                  @foreach ($semuaSiswa as $siswa)
                    <option value="{{ $siswa->id }}">{{ $siswa->namaSiswa }}</option>
                  @endforeach
                </select>
              </div>
              <div>
                <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nilai (0-100)</label>
                <input type="number" name="nilai" min="0" max="100" placeholder="Contoh: 90" class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white" />
              </div>
              <div>
                <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">Catatan Guru</label>
                <textarea name="catatan" rows="3" placeholder="Berikan evaluasi singkat..." class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
              </div>
              <button type="submit" class="w-full rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white shadow-md shadow-indigo-600/20 transition-all hover:bg-indigo-700 hover:shadow-lg active:scale-[0.98]">
                Simpan Nilai UAS
              </button>
            </form>
        </div>
      </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-2 animate-fade-in-up delay-300">
      <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-6 flex items-center justify-between">
          <h3 class="text-lg font-bold text-gray-900 dark:text-white">Analisis UTS</h3>
          <div class="rounded-md bg-blue-50 px-2 py-1 text-xs font-bold text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">Rata-rata Kelas</div>
        </div>
        <div class="relative h-64 w-full">
          <canvas id="utsChart"></canvas>
        </div>
      </div>

      <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-6 flex items-center justify-between">
          <h3 class="text-lg font-bold text-gray-900 dark:text-white">Analisis UAS</h3>
          <div class="rounded-md bg-indigo-50 px-2 py-1 text-xs font-bold text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">Rata-rata Kelas</div>
        </div>
        <div class="relative h-64 w-full">
          <canvas id="uasChart"></canvas>
        </div>
      </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-300">
      <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-700">
        <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Daftar Siswa & Potensi</h3>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
          
          <div class="relative">
             <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
             </div>
            <select id="filterKelas" class="w-full appearance-none rounded-xl border-gray-200 bg-gray-50 pl-10 pr-10 py-2.5 text-sm font-medium text-gray-700 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white md:w-56">
              <option value="all">Semua Kelas</option>
              @foreach ($kelasList as $kelas)
                <option value="{{ $kelas->namaKelas }}">{{ $kelas->namaKelas }}</option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
          </div>

          <div class="relative w-full md:w-72">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" id="searchInput" placeholder="Cari nama siswa..." class="w-full rounded-xl border-gray-200 bg-gray-50 py-2.5 pl-10 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
          </div>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-500 dark:bg-gray-700 dark:text-gray-300">
            <tr>
              <th class="px-6 py-4">Nama Siswa</th>
              <th class="px-6 py-4">Rata-rata Nilai</th>
              <th class="px-6 py-4">Potensi</th>
              <th class="px-6 py-4">Catatan UTS</th>
              <th class="px-6 py-4">Catatan UAS</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($semuaSiswa as $siswa)
              <tr data-kelas="{{ $siswa->kelas_nama }}" class="group transition-colors hover:bg-blue-50/50 dark:hover:bg-gray-700/50">
                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-600 ring-2 ring-white dark:bg-blue-900 dark:text-blue-300 dark:ring-gray-800">
                      {{ substr($siswa->namaSiswa, 0, 1) }}
                    </div>
                    <div>
                        <span class="block font-semibold text-gray-900 dark:text-white">{{ $siswa->namaSiswa }}</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $siswa->kelas_nama }}</span>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4">
                  @if($siswa->rataRataNilai)
                    <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-xs font-bold {{ $siswa->rataRataNilai >= 75 ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' }}">
                      {{ $siswa->rataRataNilai }}
                    </span>
                  @else
                    <span class="text-gray-400">-</span>
                  @endif
                </td>
                <td class="px-6 py-4">
                    @if($siswa->potensi)
                        <span class="inline-flex items-center rounded-md bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                            {{ $siswa->potensi }}
                        </span>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="max-w-xs truncate px-6 py-4 text-gray-500 dark:text-gray-400" title="{{ $siswa->catatanutsGuru }}">{{ $siswa->catatanutsGuru ?? '-' }}</td>
                <td class="max-w-xs truncate px-6 py-4 text-gray-500 dark:text-gray-400" title="{{ $siswa->catatanuasGuru }}">{{ $siswa->catatanuasGuru ?? '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const kelasLabels = @json($kelasLabels);
    const utsData = @json($utsRataRata);
    const uasData = @json($uasRataRata);
    
    // Check Dark Mode class from HTML tag
    const isDark = document.documentElement.classList.contains('dark');

    // Common Config for both charts
    const commonOptions = {
      indexAxis: 'y',
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
            backgroundColor: isDark ? 'rgba(17, 24, 39, 0.9)' : 'rgba(255, 255, 255, 0.9)',
            titleColor: isDark ? '#fff' : '#111',
            bodyColor: isDark ? '#fff' : '#444',
            borderColor: isDark ? '#374151' : '#e5e7eb',
            borderWidth: 1,
            padding: 10,
            cornerRadius: 8,
            displayColors: false,
            titleFont: { family: "'Inter', sans-serif", size: 13 },
            bodyFont: { family: "'Inter', sans-serif", size: 13 }
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
    };

    // Render Chart UTS
    new Chart(document.getElementById('utsChart'), {
      type: 'bar',
      data: {
        labels: kelasLabels,
        datasets: [{
          label: 'Rata-rata UTS',
          data: utsData,
          backgroundColor: '#2563eb', // Blue-600 Solid
          borderRadius: 6,
          barPercentage: 0.6
        }]
      },
      options: commonOptions
    });

    // Render Chart UAS
    new Chart(document.getElementById('uasChart'), {
      type: 'bar',
      data: {
        labels: kelasLabels,
        datasets: [{
          label: 'Rata-rata UAS',
          data: uasData,
          backgroundColor: '#4f46e5', // Indigo-600 Solid
          borderRadius: 6,
          barPercentage: 0.6
        }]
      },
      options: commonOptions
    });

    // Table Filter Logic
    document.addEventListener("DOMContentLoaded", function() {
      const filterKelas = document.getElementById("filterKelas");
      const searchInput = document.getElementById("searchInput");
      const rows = document.querySelectorAll("tbody tr");

      function applyFilters() {
        const selectedKelas = filterKelas.value.toLowerCase();
        const searchText = searchInput.value.toLowerCase();

        rows.forEach(row => {
          const rowKelas = row.dataset.kelas ? row.dataset.kelas.toLowerCase() : '';
          const rowNama = row.children[0].textContent.toLowerCase();
          const matchKelas = selectedKelas === "all" || rowKelas === selectedKelas;
          const matchSearch = rowNama.includes(searchText);

          if (matchKelas && matchSearch) {
            row.style.display = "";
            row.classList.add('animate-fade-in');
          } else {
            row.style.display = "none";
            row.classList.remove('animate-fade-in');
          }
        });
      }

      filterKelas.addEventListener("change", applyFilters);
      searchInput.addEventListener("keyup", applyFilters);
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
      .animate-fade-in {
          animation: fadeInUp 0.3s ease-out forwards;
      }
      .delay-100 { animation-delay: 0.1s; }
      .delay-200 { animation-delay: 0.2s; }
      .delay-300 { animation-delay: 0.3s; }
  </style>
@endsection