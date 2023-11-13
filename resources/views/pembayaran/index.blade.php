@extends('layouts.app')

@push('style')
    <link href="{{ asset('adminkit/datatables/dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid py-4">
        <h1 class="h3 mb-2 text-gray-800">TU</h1>
        <p class="mb-4">List data TU</p>

        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ route('admin.kelola_tu.create') }}" class="btn btn-primary mb-2">Tambah Data</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama TU</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $i }}</td>
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
                                <?php $i++; ?>
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
    <script src="{{ asset('adminkit/datatables/jquery.min.js') }}"></script>
    <script src="{{ asset('adminkit/datatables/dataTables.min.js') }}"></script>
@endpush
