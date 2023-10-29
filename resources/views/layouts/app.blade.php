<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('user/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('user/css/styles.min.css') }}" />
</head>

<body>
    @include('sweetalert::alert')

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.partials.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.partials.header')

            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                @yield('content')
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
                            class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a
                            href="https://themewagon.com">ThemeWagon</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('user/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('user/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('user/js/app.min.js') }}"></script>
    <script src="{{ asset('user/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('user/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('user/js/dashboard.js') }}"></script>
</body>

</html>
