<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Data Ekskul</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 10px 14px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Data Ekskul</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Ekskul</th>
                <th>Nama Pembina</th>
                <th>Nama Anggota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->namaEkskul }}</td>
                    <td>{{ $item->namaPembina }}</td>
                    <td>{{ $item->namaAnggota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
