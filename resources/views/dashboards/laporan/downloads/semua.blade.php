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
            font-size: 11px;
            /* Set font size to 12px */
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
            font-weight: bold;
            border: 2px solid black;
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
            <h2 style="text-align: center;">DAFTAR CALON PESERTA DIDIK BARU</h2>
            <h3 style="text-align: center;">TAHUN PELAJARAN {{ $tentang->tahun_ajar }} /
                {{ $tentang->tahun_ajar + 1 }}
            </h3>

            <table>
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama Siswa</th>
                        <th rowspan="2">JK</th>
                        <th rowspan="2">No Pendf</th>
                        <th rowspan="2">NISN</th>
                        <th rowspan="2">NIK</th>
                        <th rowspan="2">No.KK</th>
                        <th rowspan="2">Tempat Lahir</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Agama</th>
                        <th colspan="3">Ayah</th>
                        <th colspan="3">Ibu</th>
                        <th colspan="3">Wali</th>
                        <th rowspan="2">Alamat</th>
                        <th rowspan="2">Rata-rata</th>
                        <th rowspan="2">Asal Sekolah</th>
                        <th colspan="4">Memiliki Kartu</th>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <th>Pekerjaan</th>
                        <th>No.HP</th>
                        <th>Nama</th>
                        <th>Pekerjaan</th>
                        <th>No.HP</th>
                        <th>Nama</th>
                        <th>Pekerjaan</th>
                        <th>No.HP</th>
                        <th>NO.KPS</th>
                        <th>NO.KKS</th>
                        <th>NO.KIP</th>
                        <th>NO.PKH</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->nama_depan ?? '' }}
                                {{ $item->tbl_peserta_ppdb->nama_belakang ?? '' }}
                            </td>
                            <td>{{ $item->tbl_peserta_ppdb->jenis_kelamin ?? '' }}</td>
                            <td>P{{ sprintf('%03d', $item->id) ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->nisn ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->nik ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->no_kk ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->tempat_lahir ?? '' }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->tbl_peserta_ppdb->tanggal_lahir)) ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->agama ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->nama_ayah ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->tbl_pekerjaan_ortu->nama_pekerjaan ?? '' }}
                            </td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->no_tlp_ayah ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->nama_ibu ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->tbl_pekerjaan_ortu->nama_pekerjaan ?? '' }}
                            </td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->no_tlp_ibu ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_wali->nama_wali ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->pekerjaan_wali->tbl_pekerjaan_ortu->nama_pekerjaan ?? '' }}
                            </td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_wali->no_tlp_wali ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->alamat ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->nilai_rata_rata ?? (' ' ?? '') }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->asal_sekolah ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->no_kps ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->no_kks ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->no_kip ?? '' }}</td>
                            <td>{{ $item->tbl_peserta_ppdb->no_pkh ?? '' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="31">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <aside>
                <table>
                    <tr>
                        <td style="width: 80%;"></td>
                        <td style="width: 20%;">
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
            </aside>
        </section>
    </div>
</body>

</html>
