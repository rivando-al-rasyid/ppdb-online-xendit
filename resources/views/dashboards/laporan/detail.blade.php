@extends('admin.layouts.app')

@push('style')
    <link href="{{ asset('adminkit/lightbox2/css/lightbox.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-danger mb-5">Back</a>
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Data Lengkap Peserta</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama</td>
                            <td>{{ $item->peserta->nama }}</td>
                        </tr>
                        <tr>
                            <td>TTL</td>
                            <td>{{ $item->peserta->tempat_lahir }}, {{ $item->peserta->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <td>Asal Sekolah</td>
                            <td>{{ $item->peserta->asal_sekolah }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $item->peserta->alamat }}</td>
                        </tr>
                        <tr>
                            <td>No Telepon</td>
                            <td>{{ $item->peserta->no_telp }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>{{ $item->peserta->agama }}</td>
                        </tr>
                        <tr>
                            <td>ijasah</td>
                            <td>
                                @if ($item->peserta->ijasah)
                                    <a href="{{ asset('storage/' . $item->peserta->ijasah) }}" data-lightbox="ijasah"
                                        class="btn btn-primary">View Ijasah</a>
                                @else
                                    No ijasah available
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>kk</td>
                            <td>
                                @if ($item->peserta->kk)
                                    <a href="{{ asset('storage/' . $item->peserta->kk) }}" data-lightbox="kk"
                                        class="btn btn-primary">View KK</a>
                                @else
                                    No KK available
                                @endif
                            </td>
                        </tr>

                        <!-- Include the Lightbox2 CSS and JavaScript files in your HTML -->

                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>{{ $item->peserta->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td>Nama Ayah</td>
                            <td>{{ $item->peserta->orang_tua->nama_ayah }}</td>
                        </tr>
                        <tr>
                            <td>Nama Ibu</td>
                            <td>{{ $item->peserta->orang_tua->nama_ibu }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan Ayah</td>
                            <td>{{ $item->peserta->orang_tua->pekerjaan_ayah->nama_pekerjaan }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan Ibu</td>
                            <td>{{ $item->peserta->orang_tua->pekerjaan_ibu->nama_pekerjaan }}</td>
                        </tr>
                        <tr>
                            <td>No Telepon Ortu</td>
                            <td>{{ $item->peserta->orang_tua->no_tlp }}</td>
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
@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('adminkit/lightbox2/js/lightbox-plus-jquery.min.js') }}"></script>
@endpush
