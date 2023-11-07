<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Super Admin</span>
        </a>
        @auth('admin')
            <!-- Content for admin users -->
            <p>Welcome, Admin!</p>
            <!-- Display admin-specific content here -->
        @endauth

        @auth('peserta')
            <!-- Content for peserta users -->
            <p>Welcome, Peserta!</p>
            <!-- Display peserta-specific content here -->
        @endauth

        @guest
            <!-- Content for guests (non-authenticated users) -->
            <p>Welcome, Guest!</p>
            <!-- Display content for non-authenticated users here -->
        @endguest

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="home"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.profile.edit') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.profile.edit') }}">
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.pekerjaan_ortu.index') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.pekerjaan_ortu.index') }}">
                    <i class="align-middle" data-feather="briefcase"></i>
                    <span class="align-middle">Pekerjaan Orang Tua</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.penghasilan_ortu.index') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.penghasilan_ortu.index') }}">
                    <i class="align-middle" data-feather="dollar-sign"></i>
                    <span class="align-middle">Penghasilan Orang Tua</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.kelola_tu.index') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.kelola_tu.index') }}">
                    <i class="align-middle" data-feather="database"></i>
                    <span class="align-middle">Data TU</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
