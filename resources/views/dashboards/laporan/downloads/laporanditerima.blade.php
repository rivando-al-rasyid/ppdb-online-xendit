<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Calon Peserta Didik Baru</title>
    <style>
        .container {
            width: 80%;
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
            <table style="border: none;">
                <tr>
                    <td style="border: none; text-align: left;">
                        <img
                            src='https://akcdn.detik.net.id/community/media/visual/2023/05/02/lambang-tut-wuri-handayani.png?w=700&q=90'>
                    </td>
                    <td style="border: none; text-align: center;">
                        <h1>PEMERINTAH KABUPATEN PASAMAN</h1>
                        <h2>DINAS PENDIDIKAN</h2>
                        <h2>SMP NEGERI 1 PADANG GELUGUR</h2>
                        <p>KECAMATAN PADANG GELUGUR</p>
                        <p>Jl. Medan – Padang, Pegang Baru, Km. 202, Kode Pos 26352</p>

                    </td>
                    <td style="border: none;text-align: right;">
                        <img
                            src='https://akcdn.detik.net.id/community/media/visual/2023/05/02/lambang-tut-wuri-handayani.png?w=700&q=90'>
                    </td>

                </tr>
            </table>
            <hr>

        </header>
        <section>
            <article>
                <h2>DAFTAR CALON PESERTA DIDIK BARU YANG DITERIMA</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>JK</th>
                            <th>No NISN</th>
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
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nisn }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->no_kk }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->tanggal_lahir)) }}</td>
                                <td>{{ $item->tempat_lahir }}</td>
                                <td>{{ $item->agama }}</td>
                                <td>{{ $item->asal_sekolah }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->nilai_rata_rata ?? ' ' }}</td>
                                {{-- <td>{{ $item->tbl_biodata_ortu->nama_ayah }}</td>
                                <td>{{ $item->tbl_biodata_ortu->no_tlp_ayah }}</td>
                                <td>{{ $item->tbl_biodata_ortu->nama_ibu }}</td>
                                <td>{{ $item->tbl_biodata_ortu->no_tlp_ibu }}</td>
                                <td>{{ $item->tbl_biodata_wali->nama_wali ?? ' ' }}</td>
                                <td>{{ $item->tbl_biodata_wali->no_tlp_wali ?? ' ' }}</td> --}}
                                <td>{{ $item->tbl_kartu->kip ?? ' ' }}</td>
                                <td>{{ $item->tbl_kartu->kks ?? ' ' }}</td>
                                <td>{{ $item->tbl_kartu->kps ?? ' ' }}</td>
                                <td>{{ $item->tbl_kartu->pkh ?? ' ' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="16">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </article>

            <aside>
                <table>
                    <tr>
                        <td style="width: 70%;"></td>
                        <td style="width: 30%;">
                            <p>Padang Gelugur, 20 Juni 2022</p>
                            <p style="text-align: center;">KEPALA</p>
                            <p style="text-align: center;"></p>
                            <p style="text-align: center;">NIP. </p>
                            <p style="text-align: center;">TAHUN PELAJARAN 2022 / 2023</p>
                        </td>
                    </tr>
                </table>
            </aside>
        </section>
    </div>
</body>

</html>
