@extends('app')

@section('content')
  <div class="container mx-auto py-8">
    <h2 class="mb-6 text-2xl font-bold text-gray-800">Dashboard Pembina</h2>

    {{-- Jika belum punya ekskul --}}
    @if (!$ekskul)
      <div class="rounded border-l-4 border-yellow-500 bg-yellow-100 p-4 text-yellow-700">
        {{ $message ?? 'Anda belum memiliki ekskul binaan.' }}
      </div>
    @else
      <div class="mb-6 rounded-lg bg-white p-6 shadow">
        <h3 class="text-xl font-semibold text-gray-700">Ekskul: {{ $ekskul->nama }}</h3>
        <p class="mt-1 text-gray-500">Pembina: {{ auth()->user()->nama }}</p>
      </div>

      {{-- Daftar siswa --}}
      <div class="rounded-lg bg-white p-6 shadow">
        <h4 class="mb-4 text-lg font-semibold text-gray-700">Daftar Siswa Ekskul</h4>

        @if ($siswaEkskul->isEmpty())
          <p class="text-gray-500">Belum ada siswa yang terdaftar.</p>
        @else
          <form action="{{ route('pembina.simpanPenilaian') }}" method="POST">
            @csrf

            <table class="mt-4 w-full table-auto border">
              <thead class="bg-gray-100">
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>Partisipasi</th>
                  <th>Bakat</th>
                  <th>Kerjasama</th>
                  <th>Disiplin</th>
                  <th>Catatan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($siswaEkskul as $index => $item)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->siswa->nama ?? 'Nama tidak ditemukan' }}</td>

                    {{-- input hidden untuk id siswa --}}
                    <input type="hidden" name="siswa_id[]" value="{{ $item->siswa_id }}">

                    <td>
                      <select name="partisipasi[{{ $item->id }}]">
                        <option value="aktif" {{ $item->partisipasi === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="cukup aktif" {{ $item->partisipasi === 'cukup aktif' ? 'selected' : '' }}>Cukup
                          Aktif</option>
                        <option value="kurang aktif" {{ $item->partisipasi === 'kurang aktif' ? 'selected' : '' }}>Kurang
                          Aktif</option>
                      </select>
                    </td>

                    <td><input type="number" name="bakat[]" step="0.1" class="w-full rounded border px-2 py-1"></td>
                    <td><input type="number" name="kerjasama[]" step="0.1" class="w-full rounded border px-2 py-1">
                    </td>
                    <td><input type="number" name="disiplin[]" step="0.1" class="w-full rounded border px-2 py-1">
                    </td>
                    <td>
                      <textarea name="catatan[]" class="w-full rounded border px-2 py-1"></textarea>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            <div class="mt-4 text-right">
              <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                Simpan Penilaian
              </button>
            </div>
          </form>
        @endif
      </div>
    @endif
  </div>
@endsection
