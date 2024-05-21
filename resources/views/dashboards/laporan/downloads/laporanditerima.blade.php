<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header,
        .footer {
            text-align: center;
            position: fixed;
            width: 100%;
        }

        .header {
            top: 0;
        }

        .footer {
            bottom: 0;
        }

        .content {
            margin: 50px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>PEMERINTAH KABUPATEN PASAMAN</h1>
        <h2>DINAS PENDIDIKAN</h2>
        <h3>SMP NEGERI 1 PADANG GELUGUR</h3>
        <p>Jl. Medan – Padang, Pegang Baru, Km. 202, Kode Pos 26352</p>
    </div>

    <div class="content">
        <h2>DAFTAR CALON PESERTA DIDIK BARU YANG DITERIMA</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kel.</th>
                    <th>No NISN</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Agama</th>
                    <th>RATA RATA</th>
                    <th>Asal Sekolah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->no }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->nisn }}</td>
                        <td>{{ $student->birthplace }}</td>
                        <td>{{ $student->birthdate }}</td>
                        <td>{{ $student->religion }}</td>
                        <td>{{ $student->average }}</td>
                        <td>{{ $student->school_origin }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>KEPALA</p>
        <p>Nama</p>
        <p>NIP. </p>
        <p>TAHUN PELAJARAN 2022 / 2023</p>
    </div>
</body>

</html>
