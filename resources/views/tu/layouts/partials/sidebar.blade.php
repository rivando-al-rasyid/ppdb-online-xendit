<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <as class="sidebar-brand" href="index.html">
            <span class="align-middle">Tata Usaha</span>
        </as>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('tu.dashboard') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('tu.dashboard') }}">
                    <i class="align-middle" data-feather="home"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('tu.profile.edit') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('tu.profile.edit') }}">
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">Profile</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('tu.laporan.transaksi') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('tu.laporan.transaksi') }}">
                    <i class="align-middle" data-feather="file-text"></i>
                    <span class="align-middle">Lapooran Transaksi</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
