<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Calon Peserta Didik Baru</title>
    <style>
        .container {
            margin: auto;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
        }

        .center {
            text-align: center;
            flex-grow: 1;
        }

        header img {
            height: 6em;
        }

        header h1,
        header h2,
        header p {
            margin: 5px 0;
        }

        header h1 {
            font-size: 20px;
        }

        header h2 {
            font-size: 16px;
        }

        header p {
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
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

        header th {
            background-color: white;
            /* Sets background color to white */
            font-weight: bold;
            /* Makes the text bold */
            border: 2px solid black;
            /* Sets thicker border */
        }

        aside table {
            width: 100%;
        }

        aside td {
            border: none;
        }

        hr {
            border: 1px solid black;
            margin: 20px 0;
            /* Adjust as needed */
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <table style="border: none; width: 100%;">
                <tr>
                    <td style="border: none; text-align: left; width: 20%;">
                        <img src="https://i.ibb.co.com/ystrkWy/gambar2.png" alt="Left Image">
                    </td>
                    <td style="border: none; text-align: center; width: 60%;">
                        <h1>PEMERINTAH KABUPATEN PASAMAN</h1>
                        <h2>DINAS PENDIDIKAN</h2>
                        <h2>SMP NEGERI 1 PADANG GELUGUR</h2>
                        <p>KECAMATAN PADANG GELUGUR</p>
                        <p>Jl. Medan – Padang, Pegang Baru, Km. 202, Kode Pos 26352</p>
                    </td>
                    <td style="border: none; text-align: right; width: 20%;">
                        <img src="https://i.ibb.co.com/tPsNHHm/gambar1.png" alt="Right Image">
                    </td>
                </tr>
            </table>
            <hr>

        </header>
        <section>
            <h2 style="text-align: center;">DAFTAR CALON PESERTA DIDIK BARU YANG DITERIMA</h2>
            <h3 style="text-align: center;">TAHUN PELAJARAN {{ $tentang->first()->tahun_ajar }} /
                {{ $tentang->first()->tahun_ajar + 1 }}
            </h3>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>JK</th>
                        <th>No Pendf</th>
                        <th>NISN</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>RATA RATA</th>
                        <th>Asal Sekolah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->nama_depan ?? '' }}
                                {{ $item->tbl_peserta_ppdb->nama_belakang ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->jenis_kelamin ?? '' }}</td>
                            <td>P{{ sprintf('%03d', $item->id) ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->nisn ?? '' }}</td>
                            td>
                            <td>{{ date('d-m-Y', strtotime($item->tanggal_lahir)) ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->tempat_lahir ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->agama ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->nilai_rata_rata ?? (' ' ?? '') }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->asal_sekolah ?? '' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="16">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <aside>
                <table>
                    <tr>
                        <td style="width: 70%;"></td>
                        <td style="width: 30%;">
                            <p>Padang Gelugur, {{ \Carbon\Carbon::parse($tentang->tanggal_laporan)->format('d-m-Y') }}
                            </p>
                            <p style="text-align: center;">KEPALA</p>
                            <br>
                            <br>
                            <br>
                            <p style="text-align: center;">{{ $tentang->nama_kepsek }} </p>
                            <p style="text-align: center;">NIP. {{ $tentang->nip }}</p>
                        </td>
                    </tr>
                </table>
        </section>
    </div>
</body>

</html>
