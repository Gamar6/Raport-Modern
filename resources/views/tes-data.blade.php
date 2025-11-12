<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tes Data Relasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="mb-4 text-center">Data Relasi — Tes Seeder</h1>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Nilai UTS</th>
                <th>Nilai UAS</th>
                <th>Catatan Pembina</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswa as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->namaSiswa ?? '-' }}</td>
                    <td>{{ $item->nis }}</td>
                    <td>{{ $item->namaKelas ?? '-' }}</td>
                    <td>{{ $item->nilaiUTS ?? '-' }}</td>
                    <td>{{ $item->nilaiUAS ?? '-' }}</td>
                    <td>{{ $item->catatan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
