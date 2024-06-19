@extends('admin.layouts.app')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid py-4">
        <h1 class="h3 mb-2 text-gray-800">Halaman Informasi Sekolah</h1>
        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ route('admin.kelola_tu.index') }}" class="btn btn-warning mb-3">Back</a>
                <form
                    action="{{ $informasiSekolah ? route('admin.informasi_sekolah.update', $informasiSekolah->id) : route('admin.informasi_sekolah.store') }}"
                    method="POST">
                    @csrf
                    @if ($informasiSekolah)
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label for="tahun_ajar">Tahun Ajar:</label>
                        <input type="number" class="form-control" id="tahun_ajar" name="tahun_ajar"
                            value="{{ old('tahun_ajar', $informasiSekolah->tahun_ajar ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_laporan">Tanggal Laporan:</label>
                        <input type="date" class="form-control" id="tanggal_laporan" name="tanggal_laporan"
                            value="{{ old('tanggal_laporan', $informasiSekolah->tanggal_laporan ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_kepsek">Nama Kepsek:</label>
                        <input type="text" class="form-control" id="nama_kepsek" name="nama_kepsek"
                            value="{{ old('nama_kepsek', $informasiSekolah->nama_kepsek ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nip">NIP:</label>
                        <input type="text" class="form-control" id="nip" name="nip"
                            value="{{ old('nip', $informasiSekolah->nip ?? '') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ $informasiSekolah ? 'Update' : 'Submit' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
