<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
        <div class="header-container d-flex align-items-center">
            <div class="logo mr-auto">
                <h1 class="text-light"><a href="{{ route('landing-page') }}"><span>SMP Negeri 1 Padang Gelugur</span></a>
                </h1>
            </div>
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="{{ request()->routeIs('landing-page') ? 'active' : '' }}"><a
                            href="{{ route('landing-page') }}">Home</a></li>
                    <li class="{{ request()->routeIs('hasil') ? 'active' : '' }}"><a href="{{ route('hasil') }}">Hasil
                            Pendaftaran</a></li>
                    <li class="get-started"><a href="{{ route('login') }}">Login</a></li>
                </ul>
            </nav><!-- .nav-menu -->
        </div><!-- End Header Container -->
    </div>
</header>
