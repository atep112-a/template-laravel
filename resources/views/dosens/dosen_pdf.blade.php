<!DOCTYPE html>
<html>
<head>
    <title>Dosen User Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Dosen Report</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Mata Kuliah</th>
                <th>No Hp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dosens as $dosen)
            <tr>
                <td>{{ $dosen->id }}</td>
                <td>{{ $dosen->nama }}</td>
                <td>{{ $dosen->alamat }}</td>
                <td>{{ $dosen->mata_kuliah }}</td>
                <td>{{ $dosen->no_telp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
