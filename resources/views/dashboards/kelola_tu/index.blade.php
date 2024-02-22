@extends('admin.layouts.app')
@push('style')
    <link href="{{ url('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kelola TU</h1>
        <p class="mb-4">
            List data TU
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <a href="{{ route('admin.pekerjaan_ortu.create') }}" class="btn btn-primary mb-2">Tambah Data</a>
                <div class="table-responsive">
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
@endsection
@push('script')
    <!-- Page level plugins -->
    <script src="{{ url('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('sbadmin/js/demo/admin.js') }}"></script>
@endpush
