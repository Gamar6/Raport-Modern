@extends('app')

@section('title', 'Dashboard Guru')
@section('content')
  <div class="min-h-screen space-y-8 rounded-2xl bg-white p-6 transition-colors duration-300 dark:bg-gray-900">

    <!-- Header -->
    <div>
      <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard Guru | {{ $nama }}</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400">Kelola nilai, catatan, dan potensi siswa</p>
    </div>

    <!-- Ringkasan Mata Pelajaran & Kelas -->
    <div class="grid gap-6 lg:grid-cols-3">
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Mata Pelajaran</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $mapel }}</h3>
      </div>
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Kelas</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $totalKelas }}</h3>
      </div>
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Siswa</p>
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $totalSiswa }}</h3>
      </div>
    </div>

    {{-- Chart perbandingan --}}
    <div class="flex gap-6">
      <!-- Chart UTS -->
      <div class="flex-1 rounded-xl border border-gray-100 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-3 text-xl font-semibold text-gray-800 dark:text-gray-100">Rata-rata UTS</h3>
        <canvas id="utsChart" style="height:200px;"></canvas>
      </div>

      <!-- Chart UAS -->
      <div class="flex-1 rounded-xl border border-gray-100 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-3 text-xl font-semibold text-gray-800 dark:text-gray-100">Rata-rata UAS</h3>
        <canvas id="uasChart" style="height:200px;"></canvas>
      </div>
    </div>

    <!-- Ringkasan Siswa -->
    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <h3 class="mb-4 text-2xl font-semibold text-gray-800 dark:text-gray-100">Daftar Siswa</h3>
      <div class="mb-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">

        <!-- Filter Kelas -->
        <div>
          <select id="filterKelas"
            class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
            <option value="all">Semua Kelas</option>
            @foreach ($kelasList as $kelas)
              <option value="{{ $kelas->namaKelas }}">{{ $kelas->namaKelas }}</option>
            @endforeach
          </select>
        </div>
        <!-- Search -->
        <div>
          <input type="text" id="searchInput" placeholder="Cari nama siswa..."
            class="w-60 rounded-lg border-gray-300 px-3 py-2 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
          <thead class="bg-gray-50 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
            <tr>
              <th class="px-4 py-2">Nama</th>
              <th class="px-4 py-2">Rata-rata Nilai</th>
              <th class="px-4 py-2">Potensi</th>
              <th class="px-4 py-2">Catatan UTS</th>
              <th class="px-4 py-2">Catatan UAS</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($semuaSiswa as $siswa)
              <tr data-kelas="{{ $siswa->kelas_nama }}">
                <td class="px-4 py-2">{{ $siswa->namaSiswa }}</td>
                <td class="px-4 py-2">{{ $siswa->rataRataNilai ?? '-' }}</td>
                <td class="px-4 py-2">{{ $siswa->potensi ?? '-' }}</td>
                <td class="px-4 py-2">{{ $siswa->catatanutsGuru ?? '-' }}</td>
                <td class="px-4 py-2">{{ $siswa->catatanuasGuru ?? '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Form Input Nilai UTS & UAS -->
    <div class="grid gap-6 lg:grid-cols-2">
      <!-- Input Nilai UTS -->
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-1 text-2xl font-semibold text-gray-800 dark:text-gray-100">Input Nilai UTS</h3>
        <form action="{{ route('guru.uts.store') }}" method="POST" class="space-y-4">
          @csrf
          <div>
            <label>Nama Siswa</label>
            <select name="siswa_id" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="">Pilih siswa</option>
              @foreach ($semuaSiswa as $siswa)
                <option value="{{ $siswa->id }}">{{ $siswa->namaSiswa }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label>Nilai (0-100)</label>
            <input type="number" name="nilai" min="0" max="100" placeholder="90"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200" />
          </div>
          <div>
            <label>Catatan</label>
            <textarea name="catatan"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
          </div>
          <button type="submit"
            class="w-full rounded-md bg-blue-600 py-2 text-white hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">Simpan
            Nilai</button>
        </form>
      </div>

      <!-- Input Nilai UAS -->
      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-1 text-2xl font-semibold text-gray-800 dark:text-gray-100">Input Nilai UAS</h3>
        <form action="{{ route('guru.uas.store') }}" method="POST" class="space-y-4">
          @csrf
          <div>
            <label>Nama Siswa</label>
            <select name="siswa_id" required
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200">
              <option value="">Pilih siswa</option>
              @foreach ($semuaSiswa as $siswa)
                <option value="{{ $siswa->id }}">{{ $siswa->namaSiswa }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label>Nilai (0-100)</label>
            <input type="number" name="nilai" min="0" max="100" placeholder="90"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200" />
          </div>
          <div>
            <label>Catatan</label>
            <textarea name="catatan"
              class="mt-1 w-full rounded-md border border-gray-200 bg-blue-50 p-2 text-sm dark:border-gray-600 dark:bg-blue-950/15 dark:text-blue-200"></textarea>
          </div>
          <button type="submit"
            class="w-full rounded-md bg-blue-600 py-2 text-white hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">Simpan
            Nilai</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Generate warna random untuk tiap kelas
    const kelasLabels = @json($kelasLabels);
    const utsData = @json($utsRataRata);
    const uAsData = @json($uasRataRata);

    const colors = kelasLabels.map(() =>
      `hsl(${Math.floor(Math.random() * 360)}, 70%, 60%)`
    );

    // Chart UTS
    new Chart(document.getElementById('utsChart'), {
      type: 'bar',
      data: {
        labels: kelasLabels,
        datasets: [{
          label: 'Rata-rata UTS',
          data: utsData,
          backgroundColor: colors,
          borderWidth: 1
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        animation: {
          duration: 1200,
          easing: 'easeOutQuart'
        },
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          x: {
            beginAtZero: true,
            max: 100
          }
        }
      }
    });

    // Chart UAS
    new Chart(document.getElementById('uasChart'), {
      type: 'bar',
      data: {
        labels: kelasLabels,
        datasets: [{
          label: 'Rata-rata UAS',
          data: uAsData,
          backgroundColor: colors, // warna sama biar kelas konsisten
          borderWidth: 1
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        animation: {
          duration: 1200,
          easing: 'easeOutQuart'
        },
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          x: {
            beginAtZero: true,
            max: 100
          }
        }
      }
    });

    document.addEventListener("DOMContentLoaded", function() {
      const filterKelas = document.getElementById("filterKelas");
      const searchInput = document.getElementById("searchInput");
      const rows = document.querySelectorAll("tbody tr");

      function applyFilters() {
        const selectedKelas = filterKelas.value.toLowerCase();
        const searchText = searchInput.value.toLowerCase();

        rows.forEach(row => {
          const rowKelas = row.dataset.kelas.toLowerCase();
          const rowNama = row.children[0].textContent.toLowerCase();

          const matchKelas = selectedKelas === "all" || rowKelas === selectedKelas;
          const matchSearch = rowNama.includes(searchText);

          row.style.display = (matchKelas && matchSearch) ? "" : "none";
        });
      }

      filterKelas.addEventListener("change", applyFilters);
      searchInput.addEventListener("keyup", applyFilters);
    });
  </script>
@endsection
