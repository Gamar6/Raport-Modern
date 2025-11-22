@extends('Admin.admin-layout')

@section('title', 'Dashboard Admin')

@section('content')
  <div class="min-h-screen space-y-8 bg-gray-50/50 p-6 transition-colors duration-300 dark:bg-gray-900">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between animate-fade-in-up">
      <div>
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Dashboard Admin</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
          Ringkasan data akademik dan ekstrakurikuler sekolah.
        </p>
      </div>
      
      <div class="hidden md:flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-1.5 text-xs font-medium text-gray-600 shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <span>{{ now()->translatedFormat('l, d F Y') }}</span>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 animate-fade-in-up delay-100">
      
      <div class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Jumlah Siswa</p>
            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $total_siswa }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Jumlah Guru</p>
            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $total_guru }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Jumlah Pembina</p>
            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $total_pembina }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-600 text-white shadow-lg shadow-purple-600/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Jumlah Ekskul</p>
            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $total_ekskul }}</h3>
          </div>
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-500 text-white shadow-lg shadow-orange-500/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <div class="grid w-full grid-cols-1 gap-8 lg:grid-cols-2 animate-fade-in-up delay-200">
      
      <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Rata-Rata Nilai per Mapel</h3>
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
            </div>
        </div>
        <div class="relative h-80 w-full">
          <canvas id="chartRataMapel"></canvas>
        </div>
      </div>

      <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Partisipasi per Ekskul</h3>
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-50 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" /></svg>
            </div>
        </div>
        <div class="relative h-80 w-full">
          <canvas id="chartPartisipasiEkskul"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const isDark = document.documentElement.classList.contains('dark');

    // Common Config
    const commonOptions = {
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
        x: {
          ticks: {
            font: { size: 11, family: "'Inter', sans-serif" },
            color: isDark ? '#9ca3af' : '#6b7280'
          },
          grid: { display: false }
        },
        y: {
          beginAtZero: true,
          max: 100,
          ticks: {
            font: { weight: '600', family: "'Inter', sans-serif" },
            color: isDark ? '#d1d5db' : '#374151'
          },
          grid: {
            color: isDark ? '#374151' : '#f3f4f6',
            borderDash: [4, 4]
          }
        }
      },
      animation: { duration: 1000, easing: 'easeOutQuart' }
    };

    // 1. Chart Rata-rata Mapel (Indigo Theme)
    const ctxMapel = document.getElementById('chartRataMapel').getContext('2d');
    const mapelLabels = @json(array_keys($nilai_mapel));
    const mapelValues = @json(array_values($nilai_mapel));

    new Chart(ctxMapel, {
      type: 'bar',
      data: {
        labels: mapelLabels,
        datasets: [{
          label: 'Rata-Rata Nilai',
          data: mapelValues,
          backgroundColor: '#4f46e5', // Indigo-600 Solid
          borderRadius: 6,
          barPercentage: 0.6,
          categoryPercentage: 0.8
        }]
      },
      options: commonOptions
    });

    // 2. Chart Partisipasi Ekskul (Orange/Blue Theme)
    const ctxEkskul = document.getElementById('chartPartisipasiEkskul').getContext('2d');
    const ekskulLabels = @json(array_keys($rata_partisipasi_per_ekskul));
    const ekskulValues = @json(array_values($rata_partisipasi_per_ekskul));

    new Chart(ctxEkskul, {
      type: 'bar',
      data: {
        labels: ekskulLabels,
        datasets: [{
          label: 'Partisipasi (%)',
          data: ekskulValues,
          backgroundColor: function(context) {
            const value = context.parsed.y; // Note: 'y' karena bar chart vertical
            if (value >= 80) return '#10b981'; // Emerald-500
            if (value >= 50) return '#3b82f6'; // Blue-500
            return '#f97316'; // Orange-500
          },
          borderRadius: 6,
          barPercentage: 0.6,
          categoryPercentage: 0.8
        }]
      },
      options: commonOptions
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
  </style>
@endsection