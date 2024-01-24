@extends('home.app')
@push('add-styles')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <main id="main">
        <div class="container" style="margin-top: 150px;">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Asal Sekolah</th>
                                    <th>Orang Tua</th>
                                    <th>Status</th>
                                    <!-- Remove the "Action" column -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Asal Sekolah</th>
                                    <th>Orang Tua</th>
                                    <th>Status</th>
                                    <!-- Remove the "Action" column -->
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->peserta->nama }}</td>
                                        <td>{{ $item->peserta->asal_sekolah }}</td>
                                        <td>{{ $item->orang_tua->nama_ayah }}</td>
                                        <td>
                                            @if ($item->status == 'MENUNGGU')
                                                <div class="font-weight-bold text-warning">MENUNGGU</div>
                                            @endif
                                            @if ($item->status == 'DITOLAK')
                                                <div class="font-weight-bold text-danger">DITOLAK</div>
                                            @endif
                                            @if ($item->status == 'CADANGAN')
                                                <div class="font-weight-bold text-primary">CADANGAN</div>
                                            @endif
                                            @if ($item->status == 'DITERIMA')
                                                <div class="font-weight-bold text-success">DITERIMA</div>
                                            @endif
                                        </td>
                                        <!-- Remove the "Action" column -->
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="7"> Tidak Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End #main -->
@endsection
@push('add-scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endpush
