<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Daftar Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            table-layout: fixed;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: left;
            word-wrap: break-word; 
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Daftar Pegawai - Unit: {{ $unit }}</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Alamat</th>
                <th>Tgl Lahir</th>
                <th>L/P</th>
                <th>Golongan</th>
                <th>Eselon</th>
                <th>Jabatan</th>
                <th>Tempat Tugas</th>
                <th>Agama</th>
                <th>Unit Kerja</th>
                <th>No HP</th>
                <th>NPWP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawais as $index => $pegawai)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pegawai->nip }}</td>
                    <td>{{ $pegawai->nama }}</td>
                    <td>{{ $pegawai->tempat_lahir }}</td>
                    <td>{{ $pegawai->alamat }}</td>
                    <td>{{ $pegawai->tanggal_lahir }}</td>
                    <td>{{ $pegawai->jenis_kelamin }}</td>
                    <td>{{ $pegawai->golongan->name }}</td>
                    <td>{{ $pegawai->eselon->name }}</td>
                    <td>{{ $pegawai->jabatan }}</td>
                    <td>{{ $pegawai->tempat_tugas }}</td>
                    <td>{{ $pegawai->agama }}</td>
                    <td>{{ $pegawai->unitKerja->name }}</td>
                    <td>{{ $pegawai->no_hp }}</td>
                    <td>{{ $pegawai->npwp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
