@extends('app')

@section('title', 'Dashboard Admin')

@section('content')
  <div class="p-6">

    {{-- ------------- RINGKASAN DATA ------------- --}}
    <h1 class="mb-4 text-2xl font-bold text-gray-800">Dashboard Admin</h1>

    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-4">

      {{-- Card Jumlah Siswa --}}
      <div class="rounded-xl border bg-white p-5 shadow">
        <h3 class="text-sm text-gray-500">Jumlah Siswa</h3>
        <p class="text-3xl font-bold text-blue-500">{{ $total_siswa }}</p>
      </div>

      {{-- Card Jumlah Guru --}}
      <div class="rounded-xl border bg-white p-5 shadow">
        <h3 class="text-sm text-gray-500">Jumlah Guru</h3>
        <p class="text-3xl font-bold text-green-500">{{ $total_guru }}</p>
      </div>

      {{-- Card Jumlah Pembina --}}
      <div class="rounded-xl border bg-white p-5 shadow">
        <h3 class="text-sm text-gray-500">Jumlah Pembina</h3>
        <p class="text-3xl font-bold text-yellow-500">{{ $total_pembina }}</p>
      </div>

      {{-- Card Jumlah Ekskul --}}
      <div class="rounded-xl border bg-white p-5 shadow">
        <h3 class="text-sm text-gray-500">Jumlah Ekskul</h3>
        <p class="text-3xl font-bold text-red-500">{{ $total_ekskul }}</p>
      </div>
    </div>

    {{-- Rata-Rata Nilai per Mapel --}}
    <div class="mb-6 grid space-y-3 rounded-xl border bg-white p-5 shadow dark:bg-gray-800">
      <h3 class="mb-3 font-bold text-gray-700 dark:text-gray-300">
        Rata-Rata Nilai per Mapel
      </h3>

      <div>
        @foreach ($nilai_mapel as $mapel => $rata)
          <div class="flex justify-between text-sm font-medium text-gray-700 dark:text-gray-300">
            <span>{{ $mapel }}</span>
            <span class="text-purple-700 dark:text-purple-300">{{ number_format($rata, 2) }}</span>
          </div>

          <div class="h-2 w-full rounded-full bg-purple-100 dark:bg-purple-900">
            <div class="h-2 rounded-full bg-purple-500 transition-all duration-300" style="width: {{ $rata }}%">
            </div>
          </div>
        @endforeach
      </div>
    </div>


    {{-- ----------- ROW: 3 CHART ----------- --}}
    <div class="w-2xl grid grid-cols-1 gap-6 lg:grid-cols-2">

      {{-- Progress Pengisian Nilai --}}
      <div class="rounded-xl border bg-white p-5 shadow">
        <h3 class="mb-3 font-bold text-gray-700">Progress Pengisian Nilai (Guru & Pembina)</h3>
        <canvas id="progressChart" height="250"></canvas>
      </div>
    </div>
  </div>

  <script>
    // -------------------- Progress Nilai (Pie) ----------------------
    const progressCtx = document.getElementById('progressChart');
    new Chart(progressCtx, {
      type: 'pie',
      data: {
        labels: ['Guru (%)', 'Pembina (%)'],
        datasets: [{
          data: [
            {{ $persentase_guru }},
            {{ $persentase_pembina }}
          ],
          backgroundColor: ['#3b82f6', '#f59e0b'],
        }],
      }
    });
  </script>
@endsection
