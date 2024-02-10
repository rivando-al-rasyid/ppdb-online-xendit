@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-danger mb-5">Back</a>
        <div class="card">
            <div class="card-body">
                <h4>Data Lengkap Peserta</h4>
                <div class="row">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama</td>
                            <td>{{ $item->tbl_peserta_ppdb->nama_depan }} {{ $item->tbl_peserta_ppdb->nama_belakang }}</td>
                        </tr>

                        <tr>
                            <td>TTL</td>
                            <td>{{ $item->tbl_peserta_ppdb->tempat_lahir }}, {{ $item->tbl_peserta_ppdb->tanggal_lahir }}
                            </td>
                        </tr>
                        <tr>
                            <td>NISN</td>
                            <td>{{ $item->tbl_peserta_ppdb->nisn }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>{{ $item->tbl_peserta_ppdb->nik }}</td>
                        </tr>
                        <tr>
                            <td>Nomor KK</td>
                            <td>{{ $item->tbl_peserta_ppdb->no_kk }}</td>
                        </tr>


                        <tr>
                            <td>Asal Sekolah</td>
                            <td>{{ $item->tbl_peserta_ppdb->asal_sekolah }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $item->tbl_peserta_ppdb->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>{{ $item->tbl_peserta_ppdb->agama }}</td>
                        </tr>

                        <!-- Include the Lightbox2 CSS and JavaScript files in your HTML -->

                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>{{ $item->tbl_peserta_ppdb->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td>Nama Ayah</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->nama_ayah }}</td>
                        </tr>
                        <tr>
                            <td>Nama Ibu</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->nama_ibu }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan Ayah</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->tbl_pekerjaan_ortu->nama_pekerjaan }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan Ibu</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->tbl_pekerjaan_ortu->nama_pekerjaan }}</td>
                        </tr>
                        <tr>
                            <td>No Telepon ayah</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->no_tlp_ayah }}</td>
                        </tr>
                        <tr>
                            <td>No Telepon ibu</td>
                            <td>{{ $item->tbl_peserta_ppdb->tbl_biodata_ortu->no_tlp_ibu }}</td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                        <tr>
                            <td>Aksi</td>
                            <td>
                                @if ($item->status == 'MENUNGGU')
                                    <form method="post" class="d-inline-block"
                                        action="{{ route('admin.peserta.diterima', $item->id) }}">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-success me-2">
                                            TERIMA
                                        </button>
                                    </form>
                                    <form method="post" class="d-inline-block"
                                        action="{{ route('admin.peserta.cadangan', $item->id) }}">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            CADANGAN
                                        </button>
                                    </form>
                                    <form method="post" class="d-inline-block"
                                        action="{{ route('admin.peserta.ditolak', $item->id) }}">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            TOLAK
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-success me-2" disabled>
                                        TERIMA
                                    </button>
                                    <button class="btn btn-danger" disabled>
                                        TOLAK
                                    </button>
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
