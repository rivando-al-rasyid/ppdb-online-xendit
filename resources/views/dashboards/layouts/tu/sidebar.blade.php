<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <!-- Sidebar content goes here -->
        <!-- Example sidebar content from your provided code -->
        <a class="sidebar-brand" href="{{ url('/') }}">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <!-- Sidebar menu items go here -->
            <!-- Example menu items from your provided code -->
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <!-- Add more sidebar items as needed -->
        </ul>

        <!-- Sidebar CTA section goes here -->
        <!-- Example CTA section from your provided code -->
        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <div class="d-grid">
                    <a href="{{ url('upgrade-to-pro') }}" class="btn btn-primary">Upgrade to Pro</a>
                </div>
            </div>
        </div>
    </div>
</nav>
