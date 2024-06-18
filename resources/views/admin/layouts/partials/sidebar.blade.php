<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Super Admin <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    <li class="nav-item{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item{{ request()->routeIs('admin.profile.edit') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.profile.edit') }}">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>Profile</span></a>
    </li>
    <li class="nav-item{{ request()->routeIs('admin.kelola_tu.index') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.kelola_tu.index') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Kelola Data TU</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Settings
    </div>

    <!-- Nav Item - Data Master -->
    <li
        class="nav-item{{ request()->routeIs('admin.pekerjaan_ortu.index') || request()->routeIs('admin.biaya.index') ? ' active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseOne"
            class="collapse {{ request()->routeIs('admin.pekerjaan_ortu.index') || request()->routeIs('admin.biaya.index') || request()->routeIs('admin.informasi_sekolah.manage') ? ' show' : '' }}"
            aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Data:</h6>
                <a class="collapse-item{{ request()->routeIs('admin.pekerjaan_ortu.index') ? ' active' : '' }}"
                    href="{{ route('admin.pekerjaan_ortu.index') }}">Pekerjaan Orang Tua</a>
                <a class="collapse-item{{ request()->routeIs('admin.admin.informasi_sekolah.manage') ? ' active' : '' }}"
                    href="{{ route('admin.admin.informasi_sekolah.manage') }}">Informasi Sekolah</a>

            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
