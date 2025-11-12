<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Siswa</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Data Siswa & Catatan Pembina</h1>

    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nama Ekskul</th>
                <th>Nama Pembina</th>
                <th>Tingkat Partisipasi</th>
                <th>Tingkat Keterampilan</th>
                <th>Catatan</th>
                <th>Potensi</th>
                <th>Rekomendasi Pengembangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{ $row->namaSiswa }}</td>
                    <td>{{ $row->namaKelas }}</td>
                    <td>{{ $row->namaEkskul }}</td>
                    <td>{{ $row->namaPembina }}</td>
                    <td>{{ $row->tingkat_partisipasi }}</td>
                    <td>{{ $row->tingkat_keterampilan }}</td>
                    <td>{{ $row->catatan }}</td>
                    <td>{{ $row->potensi }}</td>
                    <td>{{ $row->rekomendasi_pengembangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
