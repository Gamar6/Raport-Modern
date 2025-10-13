@extends('layouts.dashboard')

@section('title', 'Dashboard OrangTua dan Siswa')

@section('content')
<div class="space-y-8 ">
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

  <!-- Grid Konten -->
  <div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-6">
      <!-- Performa Akademik -->
      <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Performa Akademik</h3>
        <p class="text-sm text-gray-500 mb-4">Nilai per mata pelajaran semester ini</p>

        <div class="space-y-4">
          <div>
            <div class="flex justify-between text-sm font-medium text-gray-700"><span>Matematika</span><span class="text-purple-700">85</span></div>
            <div class="w-full bg-purple-50 h-2 rounded-full"><div class="bg-purple-600 h-2 rounded-full w-[85%]"></div></div>
          </div>
          <div>
            <div class="flex justify-between text-sm font-medium text-gray-700"><span>IPA</span><span class="text-purple-700">90</span></div>
            <div class="w-full bg-purple-50 h-2 rounded-full"><div class="bg-purple-600 h-2 rounded-full w-[90%]"></div></div>
          </div>
          <div>
            <div class="flex justify-between text-sm font-medium text-gray-700"><span>Bahasa Indonesia</span><span class="text-purple-700">88</span></div>
            <div class="w-full bg-purple-50 h-2 rounded-full"><div class="bg-purple-600 h-2 rounded-full w-[88%]"></div></div>
          </div>
          <div>
            <div class="flex justify-between text-sm font-medium text-gray-700"><span>Bahasa Inggris</span><span class="text-purple-700">92</span></div>
            <div class="w-full bg-purple-50 h-2 rounded-full"><div class="bg-purple-600 h-2 rounded-full w-[92%]"></div></div>
          </div>
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

    <!-- Sisi Kanan -->
    <div class="space-y-6">
      <!-- Statistik -->
      <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Statistik</h3>
        <div class="space-y-3">
          <div class="flex justify-between bg-purple-50 p-3 rounded-md">
            <span class="text-sm text-gray-700">Total Kehadiran</span>
            <span class="font-semibold text-purple-700">96%</span>
          </div>
          <div class="flex justify-between bg-purple-50 p-3 rounded-md">
            <span class="text-sm text-gray-700">Tugas Selesai</span>
            <span class="font-semibold text-purple-700">98%</span>
          </div>
          <div class="flex justify-between bg-purple-50 p-3 rounded-md">
            <span class="text-sm text-gray-700">Keaktifan Kelas</span>
            <span class="font-semibold text-purple-700">95%</span>
          </div>
        </div>
      </div>

      <!-- Potensi & Badge -->
      <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Potensi & Badge</h3>
        <div class="flex flex-wrap gap-2">
          <span class="inline-flex items-center px-3 py-1.5 bg-purple-100 text-purple-700 text-sm font-medium rounded-full">Kreativitas Tinggi</span>
          <span class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-700 text-sm font-medium rounded-full">Inovatif</span>
          <span class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 text-sm font-medium rounded-full">Komunikatif</span>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
