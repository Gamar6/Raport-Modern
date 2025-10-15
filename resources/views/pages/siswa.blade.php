@extends('app')

@section('title', 'Dashboard OrangTua dan Siswa')

@section('content')
<div class="space-y-8">
  <!-- Header -->
  <div>
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Profil Siswa</h1>
    <p class="text-sm text-gray-500">Ringkasan lengkap progres dan potensi siswa</p>
  </div>

  <!-- Profil Utama -->
  <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
    <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
      <div class="h-24 w-24 rounded-full bg-purple-100 flex items-center justify-center text-4xl font-bold text-purple-700 shadow-sm">SF</div>
      <div class="flex-1 space-y-2">
        <h2 class="text-2xl font-semibold text-gray-800">Siti Nurhaliza</h2>
        <div class="flex flex-wrap gap-2 text-sm text-gray-500">
          <span>Kelas 10A</span><span>•</span><span>NIS: 12345</span><span>•</span><span>Semester 2 - 2024</span>
        </div>
        <div class="flex flex-wrap gap-2 pt-2">
          <span class="inline-flex items-center rounded-full bg-purple-100 text-purple-700 px-3 py-0.5 text-xs font-medium">Siswa Aktif</span>
          <span class="inline-flex items-center rounded-full bg-green-100 text-green-700 px-3 py-0.5 text-xs font-medium">Prestasi Tinggi</span>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4 text-center">
        <div class="p-3 rounded-lg bg-purple-50">
          <p class="text-3xl font-bold text-purple-700">90</p>
          <p class="text-xs text-gray-500">Rata-rata</p>
        </div>
        <div class="p-3 rounded-lg bg-purple-50">
          <p class="text-3xl font-bold text-green-700">4.8</p>
          <p class="text-xs text-gray-500">Rating</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Potensi & Minat -->
  <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-2">Potensi & Minat</h3>
    <p class="text-sm text-gray-500 mb-4">Badge yang menunjukkan kecenderungan potensi siswa</p>
    <div class="flex flex-wrap gap-3">
      <span class="inline-flex items-center rounded-full border border-transparent bg-purple-600 text-white hover:bg-purple-700 gap-2 px-4 py-2 text-sm font-medium shadow-sm transition-colors">
        💡 Kepemimpinan
      </span>
      <span class="inline-flex items-center rounded-full border border-transparent bg-pink-600 text-white hover:bg-pink-700 gap-2 px-4 py-2 text-sm font-medium shadow-sm transition-colors">
        🎨 Kreativitas Tinggi
      </span>
      <span class="inline-flex items-center rounded-full border border-transparent bg-green-600 text-white hover:bg-green-700 gap-2 px-4 py-2 text-sm font-medium shadow-sm transition-colors">
        🚀 Inovatif
      </span>
      <span class="inline-flex items-center rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 gap-2 px-4 py-2 text-sm font-medium shadow-sm transition-colors">
        👥 Komunikasi Baik
      </span>
    </div>
  </div>

  <!-- Grid Konten -->
  <div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-6">
      <!-- Performa Akademik -->
      <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Performa Akademik</h3>
        <p class="text-sm text-gray-500 mb-4">Nilai per mata pelajaran semester ini</p>

        <div class="space-y-4">
          @foreach ([['Matematika', 85], ['IPA', 90], ['Bahasa Indonesia', 88], ['Bahasa Inggris', 92]] as [$mapel, $nilai])
            <div>
              <div class="flex justify-between text-sm font-medium text-gray-700">
                <span>{{ $mapel }}</span><span class="text-purple-700">{{ $nilai }}</span>
              </div>
              <div class="w-full bg-purple-50 h-2 rounded-full">
                <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $nilai }}%"></div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Ekstrakurikuler -->
      <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Ekstrakurikuler</h3>
        <p class="text-sm text-gray-500 mb-4">Kegiatan dan tingkat partisipasi siswa</p>

        <div class="space-y-4">
          <div class="p-4 rounded-lg bg-purple-50">
            <div class="flex justify-between mb-2 font-medium text-gray-700">
              <span>Basket</span><span class="text-purple-700">95%</span>
            </div>
            <div class="w-full bg-purple-100 h-2 rounded-full"><div class="bg-purple-600 h-2 rounded-full w-[95%]"></div></div>
          </div>
          <div class="p-4 rounded-lg bg-purple-50">
            <div class="flex justify-between mb-2 font-medium text-gray-700">
              <span>Jurnalistik</span><span class="text-purple-700">98%</span>
            </div>
            <div class="w-full bg-purple-100 h-2 rounded-full"><div class="bg-purple-600 h-2 rounded-full w-[98%]"></div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- 🔄 Ganti Statistik dengan Radar Chart -->
    <div class="space-y-6">
      <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Statistik Siswa</h3>
        <canvas id="studentRadarChart" height="250"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Script Chart.js -->
<canvas id="studentRadarChart" height="250"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('studentRadarChart');
new Chart(ctx, {
  type: 'radar',
  data: {
    labels: ['Kehadiran', 'Tugas Selesai', 'Keaktifan Kelas', 'Disiplin', 'Kreativitas'],
    datasets: [{
      label: 'Statistik Semester Ini',
      data: [
        {{ $stats->kehadiran ?? 0 }},
        {{ $stats->tugas_selesai ?? 0 }},
        {{ $stats->keaktifan ?? 0 }},
        {{ $stats->disiplin ?? 0 }},
        {{ $stats->kreativitas ?? 0 }}
      ],
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
        suggestedMax: 100
      }
    }
  }
});
</script>
@endsection