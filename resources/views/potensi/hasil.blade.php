@extends('layouts.app')

@section('content')
<div class="space-y-10">

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-colors duration-300">
        <h2 class="text-2xl font-bold mb-6">Analisis Potensi: {{ $siswa->nama }}</h2>
        
    {{-- Komponen Potensi Siswa --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-colors duration-300">
        <h3 class="text-xl font-semibold mb-4">Potensi Siswa</h3>
        <div class="flex flex-wrap gap-3">
            @foreach(array_keys($potensiData) as $potensi)
                <span class="bg-green-100 dark:bg-green-700 text-green-800 dark:text-green-200 px-4 py-1 rounded-full text-sm font-medium transition-colors duration-300">
                    {{ $potensi }}
                </span>
            @endforeach
        </div>
    </div>        

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="font-semibold mb-3">Radar Potensi</h3>
                <canvas id="radarPotensi"></canvas>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Grafik Nilai Mapel</h3>
                <canvas id="barTopMapel"></canvas>
            </div>
        </div>
    </div>



    <a href="{{ url('/') }}" class="inline-block mt-6 text-blue-600 dark:text-blue-400 hover:underline">
        &larr; Kembali ke daftar siswa
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Radar Chart
const radarData = {
    labels: {!! json_encode(array_keys($potensiData)) !!},
    datasets: [{
        label: 'Potensi',
        data: {!! json_encode(array_values($potensiData)) !!},
        backgroundColor: 'rgba(59, 130, 246, 0.1)', // Mengurangi opacity background
        borderColor: 'rgba(59, 130, 246, 1)', // Tidak ada perubahan di border
        pointBackgroundColor: 'rgba(59, 130, 246, 0.5)', // Mengurangi opacity point
    }]
};

new Chart(document.getElementById('radarPotensi'), {
    type: 'radar',
    data: radarData,
    options: {
        scales: {
            r: {
                min: 0,
                max: 100
            }
        }
    }
});

    // Bar Chart
    const barData = {
        labels: {!! json_encode($topMapel->pluck('mapel')) !!},
        datasets: [{
            label: 'Nilai',
            data: {!! json_encode($topMapel->pluck('nilai')) !!},
            backgroundColor: 'rgba(255, 99, 132, 0.6)',
        }]
    };

    new Chart(document.getElementById('barTopMapel'), {
        type: 'bar',
        data: barData,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
</script>
@endsection
