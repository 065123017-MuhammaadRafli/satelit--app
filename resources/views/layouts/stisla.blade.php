<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Satelit Monitoring &mdash; App</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/stisla/stisla@master/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/stisla/stisla@master/assets/css/components.css">

    <style>
        /* Perbaikan kecil agar sidebar brand terlihat jelas */
        .main-sidebar .sidebar-brand { line-height: 60px; }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>

            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block text-white">Hi, {{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-sidebar shadow-sm">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('dashboard') }}">SATELIT--APP</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
                        </li>

                        <li class="menu-header">Data Modul</li>
                        <li class="{{ Request::is('ground_stations*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('ground_stations.index') }}"><i class="fas fa-broadcast-tower"></i> <span>Stasiun Bumi</span></a>
                        </li>
                        <li class="{{ Request::is('satellites*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('satellites.index') }}"><i class="fas fa-satellite"></i> <span>Satelit</span></a>
                        </li>
                    </ul>
                </aside>
            </div>

            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2026 <div class="bullet"></div> Satelit Monitoring System
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/stisla/stisla@master/assets/js/stisla.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/stisla/stisla@master/assets/js/scripts.js"></script>
</body>
</html>
