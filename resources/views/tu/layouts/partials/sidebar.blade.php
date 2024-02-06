<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('tu.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Super Admin <sup></sup></div>
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
    <li <li
        class="nav-item{{ request()->routeIs('tu.laporan.index') || request()->routeIs('tu.laporan.dataortu') ? ' active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan :</h6>
                <a class="collapse-item{{ request()->routeIs('tu.laporan.index') ? ' active' : '' }}"
                    href="{{ route('tu.laporan.index') }}">Laporan Data siswa</a>
                <a class="collapse-item{{ request()->routeIs('tu.laporan.dataortu') ? ' active' : '' }}"
                    href="{{ route('tu.laporan.dataortu') }}">laporan Data orang tua</a>
                <a class="collapse-item{{ request()->routeIs('tu.update.invoices') ? ' active' : '' }}"
                    href="{{ route('tu.update.invoices') }}">laporan Data Pembayaran</a>

            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
