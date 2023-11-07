<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="briefcase"></i>
                    <span class="align-middle">Dashboard</span>
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

            <!-- More admin-specific menu items can be added here -->

            {{-- @auth('tu')
                <!-- More TU-specific menu items can be added here -->
            @endauth

            @guest
                <!-- Handle guest user (not authenticated) menu items here -->
            @endguest --}}
        </ul>
    </div>
</nav>
