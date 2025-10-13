@extends('layouts.dashboard')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-4">Dashboard Guru</h1>

    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="font-semibold text-gray-800">Rata-rata Nilai</h2>
            <p class="text-4xl font-bold text-indigo-600 mt-2">89.2</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="font-semibold text-gray-800">Kehadiran</h2>
            <p class="text-4xl font-bold text-green-600 mt-2">98%</p>
        </div>
    </div>
</div>
@endsection
