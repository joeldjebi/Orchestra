<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Orchestra')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* Logo fixe */
        .logo {
            position: fixed;
            top: 30px;
            left: 30px;
            width: 60px;
            height: 60px;
            background: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .logo a {
            text-decoration: none;
            color: inherit;
        }

        /* Hamburger Menu */
        .hamburger-menu {
            position: fixed;
            top: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border: 2px solid rgba(30, 58, 138, 0.1);
        }

        .hamburger-menu:hover {
            background: white;
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .hamburger-menu i {
            font-size: 1.2rem;
            color: #1e3a8a;
            transition: all 0.3s ease;
        }

        .hamburger-menu.active i {
            transform: rotate(90deg);
            color: #dc2626;
        }

        /* Navigation Menu */
        .navigation-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1000;
        }

        .navigation-menu.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navigation-content {
            background: #1e3a8a;
            padding: 40px 60px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 40px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .nav-items {
            display: flex;
            gap: 40px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-items li a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-items li a:hover {
            color: #93c5fd;
        }

        .close-menu {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close-menu:hover {
            background: #f3f4f6;
        }

        .close-menu::before {
            content: "×";
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }

        /* Contenu principal */
        .main-content {
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .navigation-content {
                flex-direction: column;
                padding: 30px;
                gap: 20px;
            }

            .nav-items {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Logo fixe -->
    <div class="logo">
        <a href="/">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#FF2D20"/>
                <path d="M2 17L12 22L22 17" stroke="#FF2D20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 12L12 17L22 12" stroke="#FF2D20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

    <!-- Menu de navigation -->
    <div class="navigation-menu" id="navigationMenu" onclick="closeMenuOnOverlay(event)">
        <div class="navigation-content">
            <ul class="nav-items">
                <li><a href="/">Home</a></li>
                <li><a href="/values">Our Values</a></li>
                <li><a href="/work">Work</a></li>
                <li><a href="/blog">Press</a></li>
                <li><a href="/agencies">Our Agencies</a></li>
                <li><a href="/#contacts">Contacts</a></li>
            </ul>
            <button class="close-menu" onclick="toggleMenu()"></button>
        </div>
    </div>

    <!-- Hamburger Menu -->
    <div class="hamburger-menu" onclick="toggleMenu()">
        <i class="fas fa-bars" id="hamburgerIcon"></i>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        @yield('content')
    </div>

    <script>
        // Fonction pour ouvrir/fermer le menu
        function toggleMenu() {
            const menu = document.getElementById('navigationMenu');
            const hamburger = document.querySelector('.hamburger-menu');
            const icon = document.getElementById('hamburgerIcon');

            menu.classList.toggle('active');
            hamburger.classList.toggle('active');

            // Changer l'icône
            if (hamburger.classList.contains('active')) {
                icon.className = 'fas fa-times';
            } else {
                icon.className = 'fas fa-bars';
            }
        }

        // Fonction pour fermer le menu en cliquant sur l'overlay
        function closeMenuOnOverlay(event) {
            if (event.target === event.currentTarget) {
                toggleMenu();
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
