<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags, title, and stylesheets go here -->
    <!-- For example: -->
    <title>@yield('title', 'AdminKit Demo')</title>
    <link href="{{ asset('adminkit/css/app.css') }}" rel="stylesheet">

    <!-- Additional stylesheets and meta tags can be added here -->
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar, Navbar, and Main Content go here -->
        <!-- For example: -->
        @include('dashboards.layouts.admin.sidebar')

        <div class="main">
            @include('dashboards.layouts.admin.topbar')

            <main class="content">
                <div class="container-fluid p-0">
                    <!-- Content from child views will be placed here -->
                    @yield('content')
                </div>
            </main>

            @include('dashboards.layouts.footer')
        </div>
    </div>

    <script src="{{ asset('adminkit/js/app.js') }}"></script>
    <!-- Additional scripts can be included here -->
</body>

</html>
