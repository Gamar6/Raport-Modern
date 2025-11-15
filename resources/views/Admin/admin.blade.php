@extends('Admin.admin-layout')

@section('title', 'Dashboard Admin')

@section('content')
  <div class="min-h-screen bg-gray-50 p-6 dark:bg-gray-900">

    {{-- ------------- RINGKASAN DATA ------------- --}}
    <h1 class="mb-4 text-2xl font-bold text-gray-800 dark:text-gray-200">Dashboard Admin</h1>

    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-4">
      {{-- Card Jumlah Siswa --}}
      <div class="rounded-xl border border-gray-200 bg-white p-5 shadow dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Jumlah Siswa</h3>
        <p class="text-3xl font-bold text-blue-500 dark:text-blue-400">{{ $total_siswa }}</p>
      </div>

      {{-- Card Jumlah Guru --}}
      <div class="rounded-xl border border-gray-200 bg-white p-5 shadow dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Jumlah Guru</h3>
        <p class="text-3xl font-bold text-green-500 dark:text-green-400">{{ $total_guru }}</p>
      </div>

      {{-- Card Jumlah Pembina --}}
      <div class="rounded-xl border border-gray-200 bg-white p-5 shadow dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Jumlah Pembina</h3>
        <p class="text-3xl font-bold text-yellow-500 dark:text-yellow-400">{{ $total_pembina }}</p>
      </div>

      {{-- Card Jumlah Ekskul --}}
      <div class="rounded-xl border border-gray-200 bg-white p-5 shadow dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Jumlah Ekskul</h3>
        <p class="text-3xl font-bold text-red-500 dark:text-red-400">{{ $total_ekskul }}</p>
      </div>
    </div>

    <div class="grid w-full grid-cols-1 gap-6 lg:grid-cols-2">
      {{-- Rata-Rata Nilai per Mapel --}}
      <div
        class="mb-6 flex w-full flex-col rounded-xl border border-gray-200 bg-white p-5 shadow dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-3 font-bold text-gray-700 dark:text-gray-300">Rata-Rata Nilai per Mapel</h3>
        <div class="flex-1">
          <canvas id="chartRataMapel"></canvas>
        </div>
      </div>

      {{-- Rata-Rata Partisipasi per Ekskul --}}
      <div
        class="mb-6 flex w-full flex-col rounded-xl border border-gray-200 bg-white p-5 shadow dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-3 font-bold text-gray-700 dark:text-gray-300">Rata-Rata Partisipasi per Ekskul</h3>
        <div class="flex-1">
          <canvas id="chartPartisipasiEkskul"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    const isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

    // Chart rata-rata Nilai per-Mapel
    const ctx = document.getElementById('chartRataMapel').getContext('2d');

    const labels = @json(array_keys($nilai_mapel));
    const dataValues = @json(array_values($nilai_mapel));

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Rata-Rata Nilai',
          data: dataValues,
          backgroundColor: 'rgba(168, 85, 247, 0.7)',
          borderColor: 'rgba(126, 34, 206, 1)',
          borderWidth: 1,
          hoverBackgroundColor: 'rgba(192, 132, 252, 0.9)'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            labels: {
              color: isDarkMode ? '#FFFFFF' : '#374151'
            }
          }
        },
        scales: {
          x: {
            ticks: {
              color: isDarkMode ? '#FFFFFF' : '#374151'
            }
          },
          y: {
            beginAtZero: true,
            max: 100,
            ticks: {
              color: isDarkMode ? '#FFFFFF' : '#374151'
            }
          }
        }
      }
    });

    // Chart Rata-Rata Partisipasi Per Ekskul
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
          backgroundColor: 'rgba(168, 85, 247, 0.7)',
          borderColor: 'rgba(126, 34, 206, 1)',
          borderWidth: 1,
          hoverBackgroundColor: 'rgba(192, 132, 252, 0.9)'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            labels: {
              color: isDarkMode ? '#FFFFFF' : '#374151'
            }
          }
        },
        scales: {
          x: {
            ticks: {
              color: isDarkMode ? '#FFFFFF' : '#374151'
            }
          },
          y: {
            beginAtZero: true,
            max: 100,
            ticks: {
              color: isDarkMode ? '#FFFFFF' : '#374151'
            }
          }
        }
      }
    });
  </script>
@endsection
