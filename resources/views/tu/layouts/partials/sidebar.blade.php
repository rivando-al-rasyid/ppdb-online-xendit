<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Admin TU</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('tu.dashboard') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('tu.dashboard') }}">
                    <i class="align-middle" data-feather="briefcase"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>


        </ul>
    </div>
</nav>
