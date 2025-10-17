@extends('app')  

@section('content')
  <div class="container">
    <h2>Daftar Nilai</h2>
    <table class="table-bordered table-striped border-2 w-full text-left">
      <thead>
        <tr>
          <th>Nama Siswa</th>
          <th>Guru</th>
          <th>Mata Pelajaran</th>
          <th>Jenis Nilai</th>
          <th>Nilai</th>
          <th>CATATAN JEMBUD</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($semuaNilai as $n)
          <tr>
            <td>{{ $n->siswa->nama ?? '-' }}</td>
            <td>{{ $n->guru->user->nama ?? '-' }}</td>
            <td>{{ $n->mapel }}</td>
            <td>{{ $n->jenis_nilai }}</td>
            <td>{{ $n->nilai }}</td>
            <td>{{ $n->catatan ?? '-' }}</td>
            <td>{{ $n->tanggal_input ?? $n->created_at->format('Y-m-d') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
