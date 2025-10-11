@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Daftar Siswa</h2>
    <ul class="space-y-4">
        @foreach($siswas as $siswa)
        <li class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md flex justify-between items-center transition-colors duration-300">
            <span class="text-lg font-medium">{{ $siswa->nama }}</span>
            <a href="{{ route('analisis', $siswa->id) }}" class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 text-white px-4 py-2 rounded transition-colors duration-300">
                Lihat Potensi
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endsection
