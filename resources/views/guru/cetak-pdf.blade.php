<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Guru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            vertical-align: middle; /* Agar foto berada di tengah vertikal */
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .foto-siswa {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%; /* Opsional: membuat foto bulat */
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Data Guru</h2>
        <p>Aplikasi Kasir Sekolah</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 10%">Foto</th> <th>NIP</th>
                <th>Nama Guru</th>
                <th>Mata Pelajaran</th>
                <th>Jurusan</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gurus as $index => $guru)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">
                    @if($guru->foto)
                        {{-- Gunakan public_path agar DOMPDF bisa membaca file lokal --}}
                        {{-- Asumsi kamu menyimpan file di folder public/storage/fotos atau sejenisnya --}}
                        <img src="{{ public_path('storage/' . $guru->foto) }}" class="foto-guru" alt="Foto">
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>{{ $guru->nip }}</td>
                <td>{{ $guru->nama_guru }}</td>
                <td>{{ $guru->mata_pelajaran }}</td>
                <td>{{ $guru->jurusan }}</td>
                <td>{{ $guru->email ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html
