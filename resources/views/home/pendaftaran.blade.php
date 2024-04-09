@extends('home.app')

@push('add-styles')
    <link href="{{ asset('assets/css/daftar.css') }}" rel="stylesheet">
@endpush
@section('content')
    <main id="main">
        <div class="container" style="margin-top: 150px;">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <h2 class="text-center mt-5 mb-3">Tata Cara PPDB Online</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card h-100 d-flex">
                        <div class="card-body text-center">
                            <h4>Daftar</h4>
                            <p>Calon peserta didik baru akses laman situs PPDB online</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 d-flex">
                        <div class="card-body text-center">
                            <h4>Memberikan Bukti Berkas</h4>
                            <p>Calon peserta didik mempersiapkan beberapa dokumen penting yang dibutuhkan untuk
                                memverifikasi data</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 d-flex">
                        <div class="card-body text-center">
                            <h4>Verifikasi Data</h4>
                            <p>Operator akan melakukan verifikasi pengajuan akun dan berkas secara online</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 d-flex">
                        <div class="card-body text-center">
                            <h4>Hasil</h4>
                            <p>Calon peserta didik baru akan mengecek apakah mereka telah lulus atau tidak di halaman
                                <strong>"Hasil Pendaftaran"</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mt-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('daftar.kirim') }}" id="signup-form" class="signup-form"
                        enctype="multipart/form-data">
                        @csrf
                        <h3></h3>
                        <fieldset>
                            <span class="step-current"></span>
                            <h2>Biodata Calon Siswa</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Depan</label>
                                        <input type="text" name="nama_depan" class="form-control" autocomplete="off"
                                            autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Belakang</label>
                                        <input type="text" name="nama_belakang" class="form-control" autocomplete="off"
                                            autofocus>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>NISN</label>
                                        <input type="number" name="nisn" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input type="number" name="nik" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor KK</label>
                                        <input type="number" name="no_kk" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <select name="agama" class="form-control">
                                            <option value="islam">ISLAM</option>
                                            <option value="kristen">KRISTEN</option>
                                            <option value="hindu">HINDU</option>
                                            <option value="buddha">BUDDHA</option>
                                            <option value="khonghucu">KHONGHUCU</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                            autocomplete="off">
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Asal Sekolah</label>
                                        <input type="text" name="asal_sekolah" class="form-control" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h3></h3>
                        <fieldset>
                            <span class="step-current"></span>
                            <h2>Biodata Orang Tua</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Orang Ayah</label>
                                        <input type="text" name="nama_ayah" class="form-control" autocomplete="off"
                                            autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pekerjaan Ayah</label>
                                        <select name="id_pekerjaan_ayah" class="form-control">
                                            @forelse ($pekerjaan_ortu as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_pekerjaan }}</option>
                                            @empty
                                                <option value="">NO Data</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>No telepon ayah</label>
                                        <input type="number" name="no_telp_ayah" class="form-control"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Ibu</label>
                                        <input type="text" name="nama_ibu" class="form-control" autocomplete="off"
                                            autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pekerjaan Ibu</label>
                                        <select name="id_pekerjaan_ibu" class="form-control">
                                            @forelse ($pekerjaan_ortu as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_pekerjaan }}</option>
                                            @empty
                                                <option value="">NO Data</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>No Telepon Ibu</label>
                                        <input type="number" name="no_telp_ibu" class="form-control"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <h2>Biodata Wali (Diisi bila memiliki)</h2>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Orang Wali</label>
                                        <input type="text" name="nama_wali" class="form-control" autocomplete="off"
                                            autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pekerjaan Wali</label>
                                        <select name="id_pekerjaan_wali" class="form-control">
                                            <option value="">kosong</option>
                                            @forelse ($pekerjaan_ortu as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_pekerjaan }}</option>
                                            @empty
                                                <option value="">NO Data</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>No telepon Wali</label>
                                        <input type="number" name="no_telp_wali" class="form-control"
                                            autocomplete="off">
                                    </div>
                                </div>


                            </div>

                        </fieldset>

                        <h3></h3>
                        <fieldset>
                            <span class="step-current"></span>
                            <h2>Pengiriman File data</h2>
                            <div class="form-group">
                                <label for="rapor_semester_9">Rapor Kelas 5 semester 1 (PDF):</label>
                                <input type="file" name="rapor_semester_9" id="rapor_semester_9"
                                    accept="application/pdf">
                            </div>
                            <div class="form-group">
                                <label for="rapor_semester_10">Rapor Kelas 5 semester 2 (PDF):</label>
                                <input type="file" name="rapor_semester_10" id="rapor_semester_10"
                                    accept="application/pdf">
                            </div>
                            <div class="form-group">
                                <label for="rapor_semester_11">Rapor Kelas 6 semester 1 (PDF):</label>
                                <input type="file" name="rapor_semester_11" id="rapor_semester_11"
                                    accept="application/pdf">
                            </div>
                            <div class="form-group">
                                <label for="sertifikat_tpq">Sertifikat TPQ:</label>
                                <input type="file" name="sertifikat_tpq" id="sertifikat_tpq"
                                    accept="application/pdf">
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto (Gambar):</label>
                                <input type="file" name="foto" id="foto" accept="image/*">
                            </div>
                        </fieldset>
                        <h3></h3>
                        <fieldset>
                            <span class="step-current"></span>
                            <h2>Kartu Bantuan (Diisi bila memiliki)</h2>
                            <div class="form-group">
                                <label for="nomor_kps">Nomor KPS:</label>
                                <input type="text" class="form-control" name="nomor_kps" id="nomor_kps">

                                <label for="nomor_kks">Nomor KKS:</label>
                                <input type="text" class="form-control" name="nomor_kks" id="nomor_kks">

                                <label for="nomor_kip">Nomor KIP:</label>
                                <input type="text" class="form-control" name="nomor_kip" id="nomor_kip">

                                <label for="nomor_pkh">Nomor PKH:</label>
                                <input type="text" class="form-control" name="nomor_pkh" id="nomor_pkh">
                            </div>
                        </fieldset>

                    </form>

                </div>
            </div>
        </div>
    </main>
    <!-- End #main -->
@endsection
@push('add-scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/js/daftar.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tanggal_lahir').on('change', function() {
                var inputValue = $(this).val();
                if (inputValue) {
                    var date = new Date(inputValue);
                    var formattedDate = ("0" + date.getDate()).slice(-2) + "-" + ("0" + (date.getMonth() +
                        1)).slice(-2) + "-" + date.getFullYear();
                    $(this).attr('value', formattedDate);
                }
            });
        });
    </script>
@endpush
