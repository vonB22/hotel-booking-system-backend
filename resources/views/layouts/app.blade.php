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
        /* Page transition loader */
        .page-loader {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, rgba(10,11,13,0.65), rgba(17,24,39,0.75));
            color: #fff;
            z-index: 99999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 220ms ease, visibility 220ms ease;
        }

        .page-loader.show {
            opacity: 1;
            visibility: visible;
        }

        .page-loader-inner {
            text-align: center;
            max-width: 360px;
            width: calc(100% - 48px);
            padding: 28px 20px;
            border-radius: 12px;
            background: rgba(255,255,255,0.03);
            box-shadow: 0 10px 30px rgba(2,6,23,0.6);
            backdrop-filter: blur(6px);
        }

        .loader-spinner {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 5px solid rgba(255,255,255,0.08);
            border-top-color: #fff;
            animation: spin 900ms linear infinite;
            margin: 10px auto 6px;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .loader-text {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.95);
            margin-top: 6px;
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
                        <li class="nav-item px-2"><a class="nav-link" href="#home">Home</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="#hotels">Hotels</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                    @endif
                </div>

                {{-- Right Section --}}
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        @if (Route::has('login') && empty($hideNav))
                        <li class="nav-item me-2">
                            <a data-skip-loader="true" class="nav-link text-dark fw-semibold {{ request()->routeIs('login') ? 'active-link' : '' }}"
                                href="{{ route('login') }}">Login</a>
                        </li>
                        @endif
                        @if (Route::has('register') && empty($hideNav))
                        <li class="nav-item">
                            <a data-skip-loader="true" class="nav-link btn btn-sm btn-primary text-white px-3 fw-semibold shadow-sm rounded-pill {{ request()->routeIs('register') ? 'active-btn' : '' }}"
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
                            <a href="{{ route('overview.index') }}"
                                class="nav-link {{ request()->routeIs('overview.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-chart-pie"></i>Overview
                            </a>
                        </li>
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
                            <a href="{{ route('bookings.index') }}"
                                class="nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-check me-2"></i>Bookings
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="{{ route('public.home') }}" target="_blank" rel="noopener" class="nav-link">
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

        <!-- Page loader (global) -->
        <div id="pageLoader" class="page-loader" aria-hidden="true" aria-live="polite">
            <div class="page-loader-inner" role="status">
                <div class="loader-brand">
                    <!-- <i class="fa-solid fa-hotel fa-3x"></i> -->
                    <div style="text-align:center">
                        <div style="font-size:1rem;color:rgba(255,255,255,0.7)">Loading…</div>
                    </div>
                </div>
                <div class="loader-spinner" aria-hidden="true"></div>
                <div class="loader-text">Preparing your page — this usually takes a second.</div>
            </div>
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
    <script>
        /* Page loader controller */
        (function () {
            const loader = document.getElementById('pageLoader');
            if (!loader) return;

            let active = false;

            function showLoader() {
                if (active) return;
                active = true;
                // small delay so quick navigations don't flash the loader
                requestAnimationFrame(() => loader.classList.add('show'));
            }

            function hideLoader() {
                if (!active) return;
                active = false;
                loader.classList.remove('show');
            }

            function isAuthPath(pathname) {
                // match if the path contains /login or /register as a segment
                return /(^|\/)\b(login|register)\b(\/|$)/i.test(pathname || '');
            }

            // Show on internal link clicks (non-hash, same-origin), except auth routes
            document.addEventListener('click', (e) => {
                const a = e.target.closest('a');
                if (!a) return;
                const href = a.getAttribute('href');
                if (!href) return;
                // ignore anchors and fragments
                if (href.startsWith('#')) return;
                // ignore links that open in new tab or have download attribute
                if (a.target && a.target !== '' && a.target !== '_self') return;
                if (a.hasAttribute('download')) return;
                // ignore external links
                let url;
                try {
                    url = new URL(a.href, location.href);
                    if (url.origin !== location.origin) return;
                    // if same path but only different hash, don't show
                    if (url.pathname === location.pathname && url.search === location.search) return;
                } catch (err) {
                    return; // malformed href
                }

                // if link explicitly opts out (login/register buttons), don't show loader
                if (a.hasAttribute('data-skip-loader')) return;
                // skip if navigating to login/register paths (fallback)
                if (isAuthPath(url.pathname)) return;

                // show loader for navigations
                showLoader();
            }, { capture: true });

            // Show on form submissions, except auth forms (login/register) or data-ajax forms
            document.addEventListener('submit', (e) => {
                const form = e.target;
                if (!form || !(form instanceof HTMLFormElement)) return;
                // if form uses AJAX (has data-ajax) skip
                if (form.hasAttribute('data-ajax')) return;
                // determine action
                let action = form.getAttribute('action') || location.pathname;
                try {
                    const url = new URL(action, location.href);
                    action = url.pathname;
                } catch (err) {
                    // keep action as-is if malformed
                }
                // if the form explicitly opts out (e.g., auth forms), don't show loader
                if (form.hasAttribute('data-skip-loader')) return;
                if (isAuthPath(action)) return;
                showLoader();
            }, { capture: true });

            // Show when page is unloading (back/forward / refresh)
            window.addEventListener('beforeunload', (e) => {
                // don't show on auth pages unload because auth UI already shows its loader
                if (isAuthPath(location.pathname)) return;
                showLoader();
            });

            // Hide on initial page load
            window.addEventListener('load', () => {
                // small timeout to let any last paint complete
                setTimeout(hideLoader, 120);
            });

            // hide if the DOM is ready quickly
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(hideLoader, 80);
            });
        })();
    </script>
    @stack('scripts')
</body>

</html>