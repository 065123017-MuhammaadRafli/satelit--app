<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-satellite-dish text-primary"></i> SATELIT--APP
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">SA</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fire"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Data Modul</li>

            <li class="{{ Request::is('ground_stations*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('ground_stations.index') }}">
                    <i class="fas fa-broadcast-tower"></i> <span>Ground Stations</span>
                </a>
            </li>

            <li class="{{ Request::is('satellites') || Request::is('satellites/create') || Request::is('satellites/*/edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('satellites.index') }}">
                    <i class="fas fa-satellite"></i> <span>Satellites Fleet</span>
                </a>
            </li>

            <li class="{{ Request::is('satellites/global/track') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('satellites.global') }}">
                    <i class="fas fa-globe-asia text-danger"></i> <span>Global Tracking</span>
                    <span class="badge badge-danger">LIVE</span>
                </a>
            </li>

            <li class="menu-header">Reports</li>
            <li>
                <a class="nav-link" href="{{ route('satellites.pdf') }}">
                    <i class="fas fa-file-pdf"></i> <span>Export PDF Report</span>
                </a>
            </li>

            <li class="menu-header">Settings</li>
            <li class="{{ Request::is('profile*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user-cog"></i> <span>User Profile</span>
                </a>
            </li>

            <li class="mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </form>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <div class="card bg-primary text-white text-center p-2" style="border-radius: 10px;">
                <small>Version 1.2.0</small>
            </div>
        </div>
    </aside>
</div>
