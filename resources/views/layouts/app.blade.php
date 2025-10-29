<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'StayEase') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Poppins:400,500,600,700" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        :root {
            --primary: #0077ff;
            --light-bg: #f9fafb;
            --text-dark: #1f2937;
            --radius: 12px;
            --sidebar-width: 240px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            margin: 0;
        }

        /* Navbar */
        .navbar {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.9) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            z-index: 1050;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary) !important;
        }

        /* Fix dropdown overlap on mobile */
        .dropdown-menu {
            position: absolute !important;
            top: 100%;
            right: 0;
            left: auto;
            z-index: 2000 !important;
            transform: translateY(5px);
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Sidebar */
        aside {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: #fff;
            border-right: 1px solid #e5e7eb;
            padding-top: 80px;
            overflow-y: auto;
            z-index: 900;
            transition: transform 0.3s ease;
        }

        aside .nav-link {
            display: flex;
            align-items: center;
            border-radius: 8px;
            padding: 10px 12px;
            font-weight: 500;
            color: #374151;
            transition: background 0.2s, color 0.2s;
        }

        aside .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 8px;
        }

        aside .nav-link:hover,
        aside .nav-link.active {
            background: var(--primary);
            color: #fff !important;
        }

        /* Content */
        main {
            min-height: 100vh;
            padding-top: 80px;
        }

        section {
            padding: 20px 20px 0;
            transition: margin-left 0.3s ease;
        }

        /* Desktop: sidebar always visible */
        @media (min-width: 992px) {
            section.with-sidebar {
                margin-left: var(--sidebar-width);
            }

            #toggleSidebar {
                display: none;
            }

            aside {
                transform: translateX(0);
            }
        }

        /* Mobile: collapsible sidebar */
        @media (max-width: 991px) {
            aside {
                transform: translateX(-100%);
                position: fixed;
                height: 100vh;
                background: #fff;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            aside.show {
                transform: translateX(0);
            }

            #toggleSidebar {
                display: block;
                position: fixed;
                top: 80px;
                left: 15px;
                z-index: 1000;
            }

            section.with-sidebar {
                margin-left: 0 !important;
            }

            .dropdown-menu {
                position: fixed !important;
                right: 10px;
                left: auto;
                top: 60px;
            }
        }

    
        /* Shared navbar basics */
        .navbar {
            padding: 0.9rem 1.5rem;
            transition: all 0.3s ease;
            z-index: 1050;
        }

        .navbar-brand {
            font-size: 1.25rem;
            color: #1e1e1e;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #4f46e5;
        }

        .nav-link {
            font-weight: 500;
            color: #4b5563;
            transition: color 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active-link {
            color: #4f46e5;
        }

        /* Gradient background for normal pages */
        .main-navbar {
            background: #fff;
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.05);
        }

        /* Glass navbar for auth (login/register) pages */
        .auth-navbar {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        }

        .auth-navbar .navbar-brand {
            color: #fff;
        }

        .auth-navbar .nav-link {
            color: rgba(255, 255, 255, 0.9);
        }

        .auth-navbar .nav-link:hover {
            color: #fff;
            text-decoration: underline;
        }

        .auth-navbar .btn-primary {
            background: rgba(255, 255, 255, 0.9);
            color: #4f46e5 !important;
            border: none;
        }

        .auth-navbar .btn-primary:hover {
            background: #fff;
            color: #4338ca !important;
            transform: translateY(-1px);
        }

        .navbar-toggler {
            color: #fff;
        }

        .dropdown-menu {
            border: none;
            padding: 0.4rem 0;
        }

        .dropdown-item {
            font-weight: 500;
            color: #4b5563;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .dropdown-item:hover {
            background: #f3f4f6;
            color: #4338ca;
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Navbar -->
        <nav
            class="navbar navbar-expand-lg fixed-top {{ request()->routeIs('login') || request()->routeIs('register') ? 'auth-navbar' : 'main-navbar' }}">
            <div class="container-fluid">
                {{-- Brand --}}
                <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
                    <i class="fa-solid fa-hotel me-2"></i>StayEase
                </a>

                {{-- Mobile Toggle --}}
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>

                @php
                $hideNav = isset($hideNav) ? $hideNav : (view()->shared('hideNav') ?? false);
                $showCentered = !$hideNav && !(request()->routeIs('login') || request()->routeIs('register'));
                $isAdmin = auth()->check() && method_exists(auth()->user(), 'hasRole') &&
                auth()->user()->hasRole('Admin');
                @endphp

                {{-- Centered Links --}}
                <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                    @if($showCentered && !$isAdmin)
                    <ul class="navbar-nav align-items-lg-center">
                        <li class="nav-item px-2"><a class="nav-link" href="#Home">Home</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="#Hotels">Hotels</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="#About">About</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="#Contact">Contact</a></li>
                    </ul>
                    @endif
                </div>

                {{-- Right Section --}}
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        @if (Route::has('login') && empty($hideNav))
                        <li class="nav-item me-2">
                            <a class="nav-link text-dark fw-semibold {{ request()->routeIs('login') ? 'active-link' : '' }}"
                                href="{{ route('login') }}">Login</a>
                        </li>
                        @endif
                        @if (Route::has('register') && empty($hideNav))
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-primary text-white px-3 fw-semibold shadow-sm rounded-pill {{ request()->routeIs('register') ? 'active-btn' : '' }}"
                                href="{{ route('register') }}">
                                Sign Up
                            </a>
                        </li>
                        @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center fw-semibold"
                            href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-user-circle me-2"></i>{{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow-sm rounded-3">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <!-- Main Body -->
        <main>
            @php
            $showAdminSidebar = auth()->check() && method_exists(auth()->user(), 'hasRole') &&
            auth()->user()->hasRole('Admin');
            @endphp

            @if($showAdminSidebar)
            <!-- Sidebar Toggle (Mobile only) -->
            <button class="btn btn-sm" id="toggleSidebar">
                <i class="fa-solid fa-bars"></i>
            </button>

            <aside id="adminSidebar" class="shadow-sm">
                <div class="p-3">
                    <h6 class="text-muted text-uppercase mb-3">Admin Panel</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-1">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users me-2"></i>Users
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="{{ route('roles.index') }}"
                                class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-shield me-2"></i>Roles
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="{{ route('products.index') }}"
                                class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-hotel me-2"></i>Hotels
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="{{ url('/') }}" target="_blank" class="nav-link">
                                <i class="fa-solid fa-globe me-2"></i>View Site
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>

            <section class="with-sidebar">
                <div class="container-fluid py-3">
                    @yield('content')
                </div>
            </section>
            @else
            <section>
                <div class="container py-3">
                    @yield('content')
                </div>
            </section>
            @endif
        </main>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('adminSidebar');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('show');
                });
            }

            // Close sidebar when a link is clicked (mobile only)
            sidebar?.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) sidebar.classList.remove('show');
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>