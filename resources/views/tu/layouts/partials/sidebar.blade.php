<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('tu.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tata Usaha <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    <li class="nav-item{{ request()->routeIs('tu.dashboard') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('tu.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item{{ request()->routeIs('tu.profile.edit') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('tu.profile.edit') }}">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>Profile</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Settings
    </div>

    <!-- Nav Item - Data Master -->
    <li
        class="nav-item{{ // Check if any of these routes are active, then add 'active' class
            request()->routeIs('tu.laporan.siswa.index') ||
            request()->routeIs('tu.laporan.terima.index') ||
            request()->routeIs('tu.laporan.terima.pria') ||
            request()->routeIs('tu.laporan.terima.perempuan') ||
            request()->routeIs('tu.laporan.transaksi')
                ? ' active'
                : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseOne"
            class="collapse {{ // Check if any of these routes are active, then add 'show' class to expand the menu
                request()->routeIs(
                    'tu.laporan.siswa.index',
                    'tu.laporan.terima.index',
                    'tu.laporan.terima.pria',
                    'tu.laporan.terima.perempuan',
                    'tu.laporan.transaksi',
                )
                    ? ' show'
                    : '' }}"
            aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan :</h6>
                <a class="collapse-item{{ request()->routeIs('tu.laporan.siswa.index') ? ' active' : '' }}"
                    href="{{ route('tu.laporan.siswa.index') }}">Laporan Pendaftaran Siswa</a>
                <a class="collapse-item{{ request()->routeIs('tu.laporan.terima.index') ? ' active' : '' }}"
                    href="{{ route('tu.laporan.terima.index') }}">Laporan Siswa Diterima</a>
                <a class="collapse-item{{ request()->routeIs('tu.laporan.terima.pria') ? ' active' : '' }}"
                    href="{{ route('tu.laporan.terima.pria') }}">Laporan Siswa Diterima L</a>
                <a class="collapse-item{{ request()->routeIs('tu.laporan.terima.perempuan') ? ' active' : '' }}"
                    href="{{ route('tu.laporan.terima.perempuan') }}">Laporan Siswa Diterima P</a>
                <a class="collapse-item{{ request()->routeIs('tu.laporan.transaksi') ? ' active' : '' }}"
                    href="{{ route('tu.laporan.transaksi') }}">Laporan Data Pembayaran</a>
            </div>
        </div>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
