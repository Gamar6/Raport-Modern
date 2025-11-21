@extends('app')

@section('title', 'Dashboard Guru')

@section('content')
  <div class="min-h-screen space-y-8 bg-gray-50 p-6 transition-colors duration-300 dark:bg-gray-900">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard Akademik</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Selamat datang kembali, <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $nama }}</span>. Berikut ringkasan aktivitas kelasmu.
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
            <p class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-400">Mata Pelajaran</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $mapel }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path opacity="0.4" d="M4 19V6.2C4 5.0799 4 4.51984 4.21799 4.09202C4.40973 3.71569 4.71569 3.40973 5.09202 3.21799C5.51984 3 6.07989 3 7.2 3H16.8C17.9201 3 18.4802 3 18.908 3.21799C19.2843 3.40973 19.5903 3.71569 19.782 4.09202C20 4.51984 20 5.07989 20 6.2V17H6C4.89543 17 4 17.8954 4 19ZM4 19C4 20.1046 4.89543 21 6 21H20M9 7H15M9 11H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-400">Total Kelas</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalKelas }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-400">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path opacity="0.4" d="M3 7C3 5.89543 3.89543 5 5 5H19C20.1046 5 21 5.89543 21 7V15C21 16.1046 20.1046 17 19 17H5C3.89543 17 3 16.1046 3 15V7Z" stroke="currentColor" stroke-width="2"/>
              <path d="M7 17V21M17 17V21M12 17V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-400">Total Siswa</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalSiswa }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path opacity="0.4" d="M2 21V17C2 15.8954 2.89543 15 4 15H14C15.1046 15 16 15.8954 16 17V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55667C18.7122 5.26263 19.0104 6.13638 19.0104 7.045C19.0104 7.95362 18.7122 8.82737 18.1676 9.53333C17.623 10.2393 16.8604 10.7397 16 10.96M16 15C19.0001 15.0001 21.4376 17.2582 21.9169 20.2275" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Input Nilai UTS -->
    <div class="grid gap-8 lg:grid-cols-2"> 
      <div class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-6 flex items-center text-lg font-bold text-gray-800 dark:text-gray-100">
          <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
          </div>
          Input Nilai UTS
        </h3>
        <form action="{{ route('guru.uts.store') }}" method="POST" class="space-y-4">
          @csrf
          <div>
            <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Pilih Siswa</label>
            <select name="siswa_id" required class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
              <option value="">-- Cari nama siswa --</option>
              @foreach ($semuaSiswa as $siswa)
                <option value="{{ $siswa->id }}">{{ $siswa->namaSiswa }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Nilai (0-100)</label>
            <input type="number" name="nilai" min="0" max="100" placeholder="Contoh: 85" class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200" />
          </div>
          <div>
            <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Catatan Guru</label>
            <textarea name="catatan" rows="3" placeholder="Berikan evaluasi singkat..." class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200"></textarea>
          </div>
          <button type="submit" class="w-full rounded-lg bg-blue-600 py-2.5 text-sm font-semibold text-white transition-all hover:bg-blue-700 hover:shadow-lg dark:bg-blue-700">
            Simpan Nilai UTS
          </button>
        </form>
      </div>

      <div class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-6 flex items-center text-lg font-bold text-gray-800 dark:text-gray-100">
          <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" /></svg>
          </div>
          Input Nilai UAS
        </h3>
        <form action="{{ route('guru.uas.store') }}" method="POST" class="space-y-4">
          @csrf
          <div>
            <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Pilih Siswa</label>
            <select name="siswa_id" required class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
              <option value="">-- Cari nama siswa --</option>
              @foreach ($semuaSiswa as $siswa)
                <option value="{{ $siswa->id }}">{{ $siswa->namaSiswa }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Nilai (0-100)</label>
            <input type="number" name="nilai" min="0" max="100" placeholder="Contoh: 90" class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200" />
          </div>
          <div>
            <label class="mb-1 block text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Catatan Guru</label>
            <textarea name="catatan" rows="3" placeholder="Berikan evaluasi singkat..." class="w-full rounded-lg border-gray-200 bg-gray-50 p-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200"></textarea>
          </div>
          <button type="submit" class="w-full rounded-lg bg-indigo-600 py-2.5 text-sm font-semibold text-white transition-all hover:bg-indigo-700 hover:shadow-lg dark:bg-indigo-700">
            Simpan Nilai UAS
          </button>
        </form>
      </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
      <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-4 flex items-center justify-between">
          <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Analisis UTS</h3>
          <svg class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
        </div>
        <div class="relative h-64 w-full">
          <canvas id="utsChart"></canvas>
        </div>
      </div>

      <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-4 flex items-center justify-between">
          <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Analisis UAS</h3>
          <svg class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" /></svg>
        </div>
        <div class="relative h-64 w-full">
          <canvas id="uasChart"></canvas>
        </div>
      </div>
    </div>

    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <div class="border-b border-gray-100 p-6 dark:border-gray-700">
        <h3 class="mb-4 text-xl font-bold text-gray-800 dark:text-gray-100">Daftar Siswa & Potensi</h3>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
          
          <div class="relative">
             <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
             </div>
            <select id="filterKelas" class="w-full appearance-none rounded-xl border-gray-200 bg-gray-50 pl-10 pr-8 py-2.5 text-sm font-medium text-gray-700 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 md:w-48">
              <option value="all">Semua Kelas</option>
              @foreach ($kelasList as $kelas)
                <option value="{{ $kelas->namaKelas }}">{{ $kelas->namaKelas }}</option>
              @endforeach
            </select>
          </div>

          <div class="relative w-full md:w-64">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" id="searchInput" placeholder="Cari nama siswa..." class="w-full rounded-xl border-gray-200 bg-gray-50 py-2.5 pl-10 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
          </div>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500 dark:bg-gray-700/50 dark:text-gray-300">
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
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-xs font-bold text-gray-600 ring-1 ring-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:ring-gray-600">
                      {{ substr($siswa->namaSiswa, 0, 1) }}
                    </div>
                    <div>
                        <span class="font-medium text-gray-900 dark:text-gray-100 block">{{ $siswa->namaSiswa }}</span>
                        <span class="text-xs text-gray-400">{{ $siswa->kelas_nama }}</span>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4">
                  @if($siswa->rataRataNilai)
                    <span class="inline-flex items-center rounded-full {{ $siswa->rataRataNilai >= 75 ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }} px-2.5 py-0.5 text-xs font-medium dark:bg-opacity-10">
                      {{ $siswa->rataRataNilai }}
                    </span>
                  @else
                    <span class="text-gray-400">-</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $siswa->potensi ?? '-' }}</td>
                <td class="max-w-xs truncate px-6 py-4 text-gray-500 dark:text-gray-400" title="{{ $siswa->catatanutsGuru }}">{{ $siswa->catatanutsGuru ?? '-' }}</td>
                <td class="max-w-xs truncate px-6 py-4 text-gray-500 dark:text-gray-400" title="{{ $siswa->catatanuasGuru }}">{{ $siswa->catatanuasGuru ?? '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- Script Chart.js tetap sama --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Script tetap menggunakan kode yang sama dengan sebelumnya
    const kelasLabels = @json($kelasLabels);
    const utsData = @json($utsRataRata);
    const uasData = @json($uasRataRata);

    const getColors = (count, alpha = 0.7) => {
        const colors = [];
        for(let i = 0; i < count; i++) {
            const hue = (i * 360 / count) % 360;
            colors.push(`hsla(${hue}, 70%, 60%, ${alpha})`);
        }
        return colors;
    }

    const commonOptions = {
      indexAxis: 'y',
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
            backgroundColor: 'rgba(17, 24, 39, 0.9)',
            titleFont: { size: 13 },
            bodyFont: { size: 13 },
            padding: 10,
            cornerRadius: 8,
            displayColors: false
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
    };

    new Chart(document.getElementById('utsChart'), {
      type: 'bar',
      data: {
        labels: kelasLabels,
        datasets: [{
          label: 'Rata-rata UTS',
          data: utsData,
          backgroundColor: 'rgba(59, 130, 246, 0.7)',
          borderColor: 'rgba(59, 130, 246, 1)',
          borderWidth: 1,
          borderRadius: 4,
          barPercentage: 0.6
        }]
      },
      options: commonOptions
    });

    new Chart(document.getElementById('uasChart'), {
      type: 'bar',
      data: {
        labels: kelasLabels,
        datasets: [{
          label: 'Rata-rata UAS',
          data: uasData,
          backgroundColor: 'rgba(99, 102, 241, 0.7)',
          borderColor: 'rgba(99, 102, 241, 1)',
          borderWidth: 1,
          borderRadius: 4,
          barPercentage: 0.6
        }]
      },
      options: commonOptions
    });

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
            row.style.animation = "fadeIn 0.3s ease-in";
          } else {
            row.style.display = "none";
          }
        });
      }

      filterKelas.addEventListener("change", applyFilters);
      searchInput.addEventListener("keyup", applyFilters);
    });
  </script>
  <style>
      @keyframes fadeIn {
          from { opacity: 0; transform: translateY(5px); }
          to { opacity: 1; transform: translateY(0); }
      }
  </style>
@endsection