@extends('Admin.admin-layout')

@section('title', 'Laporan & Statistik Kinerja')

@section('content')
<div class="min-h-screen space-y-8 bg-gray-50/50 p-6 transition-colors duration-300 dark:bg-gray-900">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between animate-fade-in-up">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Laporan Kinerja Sekolah</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Visualisasi tren dan perbandingan performa Guru dan Pembina.</p>
        </div>
        
        <button onclick="window.print()" 
                class="no-print inline-flex items-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-gray-800 shadow-sm transition-all hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18V20a2 2 0 002 2h8a2 2 0 002-2v-2m-5-7l-5 5-5-5m5 5V3"/></svg>
            Cetak Laporan
        </button>
    </div>

    <div class="grid gap-8 lg:grid-cols-2 animate-fade-in-up delay-200">
        
        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800 print:shadow-none print:border-0 print:p-2">
            <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white print:text-base">Benchmarking Nilai Guru</h3>
            <p class="mb-6 text-xs text-gray-500 dark:text-gray-400 print:hidden">Rata-rata nilai siswa yang diampu oleh guru (Top 5).</p>
            <div class="relative h-72 w-full print:h-[250px] print:w-full">
              <canvas id="guruChart"></canvas>
            </div>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800 print:shadow-none print:border-0 print:p-2">
            <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white print:text-base">Benchmarking Partisipasi Pembina</h3>
            <p class="mb-6 text-xs text-gray-500 dark:text-gray-400 print:hidden">Rata-rata tingkat partisipasi di ekskul yang diampu (Top 5).</p>
            <div class="relative h-72 w-full print:h-[250px] print:w-full">
              <canvas id="pembinaChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-4 animate-fade-in-up delay-300">
        
        <div class="flex items-center justify-between rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 print:shadow-none print:border-0">
            <div>
                <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Siswa</p>
                <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $siswaCount }}</h3>
            </div>
            <div class="no-print flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 print:shadow-none print:border-0">
            <div>
                <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Guru</p>
                <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $guruCount }}</h3>
            </div>
            <div class="no-print flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-400">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.952 1.343a.75.75 0 00-1.002-.215l-10.513 5.437a1.5 1.5 0 00-.781 1.365V20.25a.75.75 0 001.2.627l4.774-3.924V14.25A2.25 2.25 0 0115 12h2.25a2.25 2.25 0 002.25-2.25V6.155a.75.75 0 00-.208-.543z" clip-rule="evenodd" /></svg>
            </div>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 print:shadow-none print:border-0">
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Rata-Rata Nilai Sekolah</p>
            <h3 class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ round($rata_rata_semua_siswa, 1) }}</h3>
        </div>
        
        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 print:shadow-none print:border-0">
            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Progress Input Nilai</p>
            <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ round($persentase_guru, 1) }}%</h3>
            <div class="mt-2 h-2 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                <div class="h-2 rounded-full bg-blue-500" style="width: {{ $persentase_guru ?? 0 }}%"></div>
            </div>
        </div>
    </div>
    
    <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-md dark:border-gray-700 dark:bg-gray-800 animate-fade-in-up delay-300 print:shadow-none print:border-0 print:p-2">
        <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white print:text-base">Tren Nilai Sekolah (6 Bulan Terakhir)</h3>
        <p class="mb-6 text-xs text-gray-500 dark:text-gray-400 print:hidden">Melihat perkembangan rata-rata nilai UTS & UAS dari waktu ke waktu.</p>
        <div class="relative h-80 w-full print:h-[300px] print:w-full">
          <canvas id="trenNilaiChart"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const isDark = document.documentElement.classList.contains('dark');
    
    // Data structures are assumed to be passed correctly from Controller
    const topGuruData = @json($topGuruComparison ?? []);
    const topPembinaData = @json($topPembinaComparison ?? []);
    const trenLabels = @json($perkembangan_labels ?? []);
    const trenValues = @json($perkembangan_values ?? []);

    const chartConfig = {
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: true, position: 'bottom', labels: { color: isDark ? '#d1d5db' : '#374151', font: { family: 'Inter' } } } },
            layout: { padding: { top: 10, bottom: 0, left: 0, right: 0 } }, // Reduce padding
            scales: {
                x: { 
                    ticks: { 
                        color: isDark ? '#9ca3af' : '#6b7280',
                        font: { size: 10, family: 'Inter' }
                    },
                    grid: { display: false } 
                },
                y: { 
                    beginAtZero: true, max: 100, 
                    ticks: { color: isDark ? '#9ca3af' : '#6b7280', font: { size: 10, family: 'Inter' } },
                    grid: { color: isDark ? '#374151' : '#e5e7eb', borderDash: [4, 4] }
                }
            },
            animation: { duration: 1000 }
        }
    };

    // 1. Chart Perbandingan Guru (Bar Chart - Horizontal, Optimized)
    const ctxGuru = document.getElementById('guruChart').getContext('2d');
    new Chart(ctxGuru, {
        type: 'bar',
        data: {
            labels: topGuruData.map(d => d.name),
            datasets: [{
                label: 'Rata-rata Nilai Siswa',
                data: topGuruData.map(d => d.score),
                backgroundColor: '#4f46e5', // Indigo-600
                borderRadius: 5,
            }]
        },
        options: { 
            ...chartConfig.options, 
            indexAxis: 'y', // Set to horizontal
            layout: { padding: { top: 10, bottom: 10, left: 0, right: 10 } }, // Slightly more padding on right for cut-off prevention
            scales: {
                x: { 
                    ...chartConfig.options.scales.y, // Value axis
                    max: 100 
                },
                y: { 
                    ...chartConfig.options.scales.x, // Category/Label axis
                    ticks: { 
                        color: isDark ? '#9ca3af' : '#6b7280', 
                        font: { size: 10, family: 'Inter' } // Keep labels tight
                    },
                    // Ensure labels don't push viewport too much:
                    cutoutPercentage: 50 
                }
            }
        }
    });

    // 2. Chart Perbandingan Pembina (Bar Chart - Horizontal, Optimized)
    const ctxPembina = document.getElementById('pembinaChart').getContext('2d');
    new Chart(ctxPembina, {
        type: 'bar',
        data: {
            labels: topPembinaData.map(d => d.name + ' (' + d.ekskul + ')'),
            datasets: [{
                label: 'Rata-rata Partisipasi (%)',
                data: topPembinaData.map(d => d.avg_rate),
                backgroundColor: '#f97316', // Orange-500
                borderRadius: 5,
            }]
        },
        options: { 
            ...chartConfig.options, 
            indexAxis: 'y', // Set to horizontal
            layout: { padding: { top: 10, bottom: 10, left: 0, right: 10 } },
            scales: {
                x: { 
                    ...chartConfig.options.scales.y, 
                    max: 100 
                },
                y: { 
                    ...chartConfig.options.scales.x, 
                    ticks: { color: isDark ? '#9ca3af' : '#6b7280', font: { size: 10 } }, // Font Y diperkecil
                    cutoutPercentage: 50
                }
            }
        }
    });

    // 3. Chart Tren Nilai Sekolah (Line Chart)
    const ctxTren = document.getElementById('trenNilaiChart').getContext('2d');
    new Chart(ctxTren, {
        type: 'line',
        data: {
            labels: trenLabels,
            datasets: [{
                label: 'Rata-rata Sekolah',
                data: trenValues,
                borderColor: '#2563eb', // Blue-600
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                fill: true,
                tension: 0.3,
                pointRadius: 4
            }]
        },
        options: chartConfig.options
    });
</script>

<style>
    /* ------------------------------------------- */
    /* UI/UX FIXES */
    /* ------------------------------------------- */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }

    /* ------------------------------------------- */
    /* PRINT FIXES (To prevent clipping) */
    /* ------------------------------------------- */
    @media print {
        /* 1. Hide non-essential elements */
        .no-print { display: none !important; }
        
        /* 2. Remove fixed sizes and shadows */
        .min-h-screen, .p-6 { 
            padding: 0 !important; 
            margin: 0 !important; 
            box-shadow: none !important; 
            border: none !important;
        }

        /* 3. Force Charts to Scale */
        .rounded-3xl { border-radius: 0 !important; }
        .grid { display: block !important; } /* Stack charts vertically */
        .h-72, .h-80 { height: 300px !important; } /* Set fixed height for print canvas */
        .lg\:grid-cols-2 { grid-template-columns: 1fr !important; }
        
        canvas {
            max-width: 98% !important; 
            margin: 0 auto;
            page-break-inside: avoid;
        }
    }
</style>
@endsection