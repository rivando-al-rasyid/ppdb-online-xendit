<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags, title, and stylesheets go here -->
    <!-- For example: -->
    <link href="{{ asset('adminkit/css/app.css') }}" rel="stylesheet">
    @stack('style') <!-- Include additional stylesheets from child views -->
    <!-- Additional stylesheets and meta tags can be added here -->
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar, Navbar, and Main Content go here -->
        <!-- For example: -->
        @include('tu.layouts.partials.sidebar')

        <div class="main">
            @include('tu.layouts.partials.topbar')

            <main class="content">
                <div class="container-fluid p-0">
                    <!-- Content from child views will be placed here -->
                    @yield('content')
                </div>
            </main>

            @include('tu.layouts.partials.footer')
        </div>
    </div>

    <script src="{{ asset('adminkit/js/app.js') }}"></script>
    <!-- Additional scripts can be included here -->
    @stack('script') <!-- Include additional scripts from child views -->
</body>

</html>
