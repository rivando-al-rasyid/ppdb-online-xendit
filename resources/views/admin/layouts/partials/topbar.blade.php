<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="collapse navbar-collapse" id="navbarNav">
        <!-- User Dropdown Menu -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::guard('admin')->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">{{ __('Profile') }}</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
