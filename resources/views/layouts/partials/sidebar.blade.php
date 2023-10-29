<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('user/images/logos/dark-logo.svg') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <br>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link " href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link " href="{{ route('profile.edit') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-circle"></i>
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    {{-- <a class="sidebar-link " href="{{ route('pembayaran.hasil') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file"></i>
                        </span>
                        <span class="hide-menu">Lihat Invoice</span>
                    </a> --}}
                </li>

                <!-- Other sidebar items... -->
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
