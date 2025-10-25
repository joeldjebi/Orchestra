<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Orchestra')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8fafc;
            color: #334155;
            line-height: 1.6;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            width: 250px;
            background: #1e293b;
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .admin-sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #334155;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 700;
            color: #3b82f6;
        }

        .sidebar-logo i {
            font-size: 2rem;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #334155;
            color: white;
            border-left-color: #3b82f6;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .sidebar-collapsed .nav-link span {
            display: none;
        }

        /* Main Content */
        .admin-main {
            flex: 1;
            margin-left: 250px;
            transition: all 0.3s ease;
        }

        .admin-main.sidebar-collapsed {
            margin-left: 70px;
        }

        .admin-header {
            background: white;
            padding: 20px 30px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #64748b;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: #f1f5f9;
            color: #334155;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-menu {
            position: relative;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: #f8fafc;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-info:hover {
            background: #e2e8f0;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-name {
            font-weight: 500;
            color: #334155;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            z-index: 1000;
            display: none;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            padding: 12px 16px;
            color: #334155;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: #f8fafc;
        }

        .dropdown-divider {
            height: 1px;
            background: #e2e8f0;
            margin: 8px 0;
        }

        /* Content */
        .admin-content {
            padding: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-header {
                padding: 15px 20px;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-cogs"></i>
                    <span>Admin Panel</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/admin/carousel" class="nav-link {{ request()->is('admin/carousel*') ? 'active' : '' }}">
                        <i class="fas fa-images"></i>
                        <span>Carousel</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/admin/leadership" class="nav-link {{ request()->is('admin/leadership*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Leadership</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/admin/contact" class="nav-link {{ request()->is('admin/contact*') ? 'active' : '' }}">
                        <i class="fas fa-address-book"></i>
                        <span>Contacts</span>
                    </a>
                </div>
            <div class="nav-item">
                <a href="/admin/blog" class="nav-link {{ request()->is('admin/blog*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Blog</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="/admin/value" class="nav-link {{ request()->is('admin/value*') ? 'active' : '' }}">
                    <i class="fas fa-heart"></i>
                    <span>Valeurs</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="/admin/work" class="nav-link {{ request()->is('admin/work*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span>Projets</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="/admin/agency" class="nav-link {{ request()->is('admin/agency*') ? 'active' : '' }}">
                    <i class="fas fa-building"></i>
                    <span>Agences</span>
                </a>
            </div>
                <div class="nav-item">
                    <a href="/admin/users" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Utilisateurs</span>
                    </a>
                </div>
                {{-- <div class="nav-item">
                    <a href="/admin/settings" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        <span>Paramètres</span>
                    </a>
                </div> --}}
                <div class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Retour au site</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main" id="adminMain">
            <!-- Header -->
            <header class="admin-header">
                <div class="header-left">
                    <button class="sidebar-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="header-right">
                    <div class="user-menu">
                        <div class="user-info" onclick="toggleUserMenu()">
                            <div class="user-avatar">
                                {{ substr(Auth::user()->prenoms, 0, 1) }}{{ substr(Auth::user()->nom, 0, 1) }}
                            </div>
                            <div class="user-name">{{ Auth::user()->full_name }}</div>
                            <i class="fas fa-chevron-down"></i>
                        </div>

                        <div class="dropdown-menu" id="userDropdown">
                            <a href="/admin/profile" class="dropdown-item">
                                <i class="fas fa-user"></i> Profil
                            </a>
                            <a href="/admin/settings" class="dropdown-item">
                                <i class="fas fa-cog"></i> Paramètres
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="admin-content">
                <!-- Messages de session -->
                @if(session('success'))
                    <div class="alert alert-success" style="background: #d1fae5; border: 1px solid #a7f3d0; color: #065f46; padding: 15px; border-radius: 8px; margin: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger" style="background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626; padding: 15px; border-radius: 8px; margin: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="/logout" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Toggle sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const main = document.getElementById('adminMain');

            sidebar.classList.toggle('collapsed');
            main.classList.toggle('sidebar-collapsed');
        }

        // Toggle user menu
        function toggleUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.querySelector('.user-menu');
            const dropdown = document.getElementById('userDropdown');

            if (!userMenu.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Mobile sidebar toggle
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            sidebar.classList.toggle('show');
        }
    </script>
    @yield('scripts')
</body>
</html>
