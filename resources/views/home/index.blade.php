@extends('home.app')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
            <h1>Selamat Datang di SMP Negeri 1 Padang Gelugur </h1>
            <h2>Ayo Kita Belajar Bersama</h2>
            <a href="{{ route('daftar') }}" class="btn-get-started scrollto">Daftar Sekarang</a>
        </div>
    </section><!-- End Hero -->
@endsection
