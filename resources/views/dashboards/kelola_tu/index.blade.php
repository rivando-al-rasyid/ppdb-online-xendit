@extends('admin.layouts.app')
@push('style')
    <link href="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-between">
                    <h1>Data Tata Usaha</h1>
                </div>
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <a href="{{ route('admin.kelola_tu.create') }}" class="btn btn-primary mb-2">Tambah
                                    Data</a>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama TU</th>
                                            <th>Email</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama TU</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    <a href="{{ route('admin.kelola_tu.edit', $item->id) }}"
                                                        class="btn btn-success me-2">Edit</a>
                                                    @if (count($items) > 1)
                                                        <form method="post" class="d-inline-block"
                                                            action="{{ route('admin.kelola_tu.destroy', $item->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <!-- Page level plugins -->
        <script src="{{ asset('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('sbadmin/js/demo/admin.js') }}"></script>
    @endpush
