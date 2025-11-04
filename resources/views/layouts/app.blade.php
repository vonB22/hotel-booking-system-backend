<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'StayEase') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700,800&family=Playfair+Display:700" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --dark-secondary: #1e293b;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border-color: #e2e8f0;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --navbar-height: 68px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary) 100%);
        }

        /* Selection color */
        ::selection {
            background: rgba(99, 102, 241, 0.2);
            color: var(--text-primary);
        }

        /* ============================================
           PREMIUM NAVBAR STYLES
        ============================================ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--navbar-height);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(20px) saturate(180%);
            background: rgba(255, 255, 255, 0.9) !important;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            z-index: 1050;
            transition: var(--transition);
        }

        .navbar.scrolled {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.95) !important;
        }

        /* Glass navbar for auth pages */
        .auth-navbar {
            background: rgba(15, 23, 42, 0.6) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 100%;
        }

        /* Brand - Premium Design */
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.75rem;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 60%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.625rem;
            position: relative;
            cursor: pointer;
        }

        .navbar-brand:hover {
            transform: translateY(-1px);
            filter: brightness(1.1);
        }

        .navbar-brand-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            /* background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); */
            border-radius: 10px;
            color: white;
            font-size: 1.25rem;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            position: relative;
            overflow: hidden;
        }

        .navbar-brand-icon::before {
            content: '';
            position: absolute;
            inset: 0;
            /* background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.2) 100%); */
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .navbar-brand:hover .navbar-brand-icon::before {
            transform: translateX(100%);
        }

        .auth-navbar .navbar-brand {
            -webkit-text-fill-color: white;
        }

        /* Center Navigation */
        .navbar-center {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-center .nav-link {
            font-weight: 500;
            font-size: 0.9375rem;
            color: var(--text-secondary) !important;
            padding: 0.625rem 1rem !important;
            border-radius: 10px;
            transition: var(--transition);
            position: relative;
            white-space: nowrap;
        }

        .navbar-center .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0.25rem;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 2px;
            transition: transform 0.3s ease;
        }

        .navbar-center .nav-link:hover {
            color: var(--primary) !important;
            background: rgba(99, 102, 241, 0.05);
        }

        .navbar-center .nav-link:hover::before {
            transform: translateX(-50%) scaleX(1);
        }

        .navbar-center .nav-link.active-link {
            color: var(--primary) !important;
            font-weight: 600;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
        }

        .navbar-center .nav-link.active-link::before {
            transform: translateX(-50%) scaleX(1);
        }

        .auth-navbar .navbar-center .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        .auth-navbar .navbar-center .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
        }

        /* Right Actions */
        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .navbar-actions .nav-link {
            font-weight: 600;
            color: var(--light-bg) !important;
            padding: 0.5rem 1rem;
            transition: var(--transition);
        }

        .navbar-actions .nav-link:hover {
            color: var(--primary) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            padding: 0.625rem 1.75rem;
            font-weight: 600;
            border-radius: 12px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
            position: relative;
            overflow: hidden;
            color: white !important;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 100%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .btn-primary:hover::before {
            transform: translateX(100%);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .auth-navbar .btn-primary {
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary) !important;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
        }

        .auth-navbar .btn-primary:hover {
            background: #fff;
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            transition: var(--transition);
            cursor: pointer;
            font-weight: 600;
            color: var(--text-primary);
        }

        .user-dropdown-toggle:hover {
            background: rgba(99, 102, 241, 0.05);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.2);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 0.75rem);
            right: 0;
            min-width: 220px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 14px;
            box-shadow: var(--shadow-xl);
            padding: 0.5rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 2000;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            font-weight: 500;
            color: var(--text-secondary);
            border-radius: 10px;
            transition: var(--transition);
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
            color: var(--primary);
            transform: translateX(2px);
        }

        .dropdown-item i {
            width: 18px;
            font-size: 1rem;
        }

        /* Mobile Toggle */
        .navbar-toggler {
            border: none;
            padding: 0.625rem;
            color: var(--text-primary);
            transition: var(--transition);
            width: 44px;
            height: 44px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            border-radius: 10px;
            cursor: pointer;
            background: transparent;
        }

        .navbar-toggler span {
            width: 24px;
            height: 2px;
            background: var(--text-primary);
            border-radius: 2px;
            transition: var(--transition);
        }

        .navbar-toggler:hover {
            background: rgba(99, 102, 241, 0.08);
        }

        .navbar-toggler.active span:nth-child(1) {
            transform: rotate(45deg) translateY(7px);
        }

        .navbar-toggler.active span:nth-child(2) {
            opacity: 0;
        }

        .navbar-toggler.active span:nth-child(3) {
            transform: rotate(-45deg) translateY(-7px);
        }

        .auth-navbar .navbar-toggler span {
            background: white;
        }

        /* ============================================
           SIDEBAR STYLES
        ============================================ */
        aside {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #ffffff 0%, #fefefe 100%);
            border-right: 1px solid var(--border-color);
            padding: 1.5rem 0;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 900;
            transition: var(--transition);
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.04);
        }

        aside::-webkit-scrollbar {
            width: 4px;
        }

        aside::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 2px;
        }

        /* Sidebar Header */
        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 1.5rem;
        }

        .sidebar-title {
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            padding: 0 1rem;
        }

        .sidebar-section {
            margin-bottom: 2rem;
        }

        .sidebar-section-title {
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            padding: 0 0.75rem;
            margin-bottom: 0.75rem;
        }

        aside .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem !important;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.9375rem;
            color: var(--text-secondary) !important;
            margin-bottom: 0.375rem;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        aside .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 0 4px 4px 0;
            transform: scaleY(0);
            transition: var(--transition);
        }

        aside .nav-link i {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
            transition: var(--transition);
        }

        aside .nav-link span {
            flex: 1;
            transition: var(--transition);
        }

        aside .nav-link .nav-badge {
            font-size: 0.6875rem;
            padding: 0.25rem 0.5rem;
            background: var(--light-bg);
            color: var(--text-secondary);
            border-radius: 6px;
            font-weight: 600;
        }

        aside .nav-link:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.06) 0%, rgba(139, 92, 246, 0.06) 100%);
            color: var(--primary) !important;
            transform: translateX(4px);
        }

        aside .nav-link:hover i {
            transform: scale(1.1);
        }

        aside .nav-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff !important;
            box-shadow: 0 4px 16px rgba(99, 102, 241, 0.3);
        }

        aside .nav-link.active::before {
            transform: scaleY(1);
        }

        aside .nav-link.active i {
            color: white;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        aside .nav-link.active .nav-badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* Sidebar Toggle Button */
        #toggleSidebar {
            position: fixed;
            top: calc(var(--navbar-height) + 1rem);
            left: 1rem;
            z-index: 1000;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0.875rem 1rem;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
        }

        #toggleSidebar:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }

        #toggleSidebar i {
            font-size: 1.125rem;
        }

        /* ============================================
           MAIN CONTENT STYLES
        ============================================ */
        main {
            min-height: 100vh;
            padding-top: var(--navbar-height);
            transition: var(--transition);
        }

        section {
            padding: 2rem;
            transition: var(--transition);
        }

        section.with-sidebar {
            margin-left: var(--sidebar-width);
        }

        /* ============================================
           CARDS & COMPONENTS
        ============================================ */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            transition: var(--transition);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        /* Table Styles */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table thead th {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.04) 0%, rgba(139, 92, 246, 0.04) 100%);
            font-weight: 600;
            font-size: 0.8125rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-primary);
            padding: 1rem;
            border-bottom: 2px solid var(--border-color);
            white-space: nowrap;
        }

        .table tbody td {
            padding: 1rem;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background: rgba(99, 102, 241, 0.02);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Buttons */
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 10px;
            transition: var(--transition);
            border: none;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.25);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
        }

        /* Badge status */
        .badge {
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8125rem;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .badge-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.12) 0%, rgba(5, 150, 105, 0.12) 100%);
            color: var(--success);
        }

        .badge-warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.12) 0%, rgba(217, 119, 6, 0.12) 100%);
            color: var(--warning);
        }

        .badge-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.12) 0%, rgba(220, 38, 38, 0.12) 100%);
            color: var(--danger);
        }

        /* Empty state */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
        }

        .empty-state i {
            opacity: 0.4;
            margin-bottom: 1.5rem;
            animation: float-icon 3s ease-in-out infinite;
        }

        @keyframes float-icon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* ============================================
           PAGE LOADER
        ============================================ */
        .page-loader {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.96) 0%, rgba(30, 41, 59, 0.96) 100%);
            backdrop-filter: blur(10px);
            z-index: 99999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .page-loader.show {
            opacity: 1;
            visibility: visible;
        }

        .page-loader-inner {
            text-align: center;
            max-width: 400px;
            width: calc(100% - 3rem);
            padding: 3rem 2rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(20px);
        }

        .loader-brand i {
            font-size: 3rem;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pulse 2s ease-in-out infinite;
        }

        .loader-spinner {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.1);
            border-top-color: var(--primary-light);
            border-right-color: var(--secondary);
            animation: spin 1s linear infinite;
            margin: 1.5rem auto;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(0.95); }
        }

        .loader-text {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            line-height: 1.6;
        }

        /* ============================================
           RESPONSIVE DESIGN
        ============================================ */
        @media (min-width: 992px) {
            #toggleSidebar {
                display: none;
            }

            aside {
                transform: translateX(0);
            }

            .navbar-toggler {
                display: none;
            }
        }

        @media (max-width: 991px) {
            :root {
                --navbar-height: 64px;
            }

            .navbar {
                padding: 0 1rem;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            .navbar-brand-icon {
                width: 32px;
                height: 32px;
                font-size: 1.125rem;
            }

            .navbar-center {
                position: fixed;
                top: var(--navbar-height);
                left: 0;
                right: 0;
                background: white;
                border-bottom: 1px solid var(--border-color);
                box-shadow: var(--shadow-lg);
                padding: 1rem;
                flex-direction: column;
                align-items: stretch;
                transform: translateY(-100%);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                z-index: 1040;
            }

            .navbar-center.show {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }

            .navbar-center .nav-link {
                width: 100%;
                justify-content: flex-start;
            }

            aside {
                transform: translateX(-100%);
                box-shadow: none;
            }

            aside.show {
                transform: translateX(0);
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            }

            section.with-sidebar {
                margin-left: 0 !important;
            }

            section {
                padding: 1.5rem 1rem;
            }

            .dropdown-menu {
                position: fixed !important;
                right: 1rem;
                left: auto;
                top: calc(var(--navbar-height) - 5px) !important;
            }
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table {
                min-width: 600px;
            }
        }

        @media (max-width: 576px) {
            :root {
                --navbar-height: 60px;
            }

            .navbar {
                padding: 0 0.75rem;
            }

            .navbar-brand {
                font-size: 1.25rem;
            }

            .navbar-brand-icon {
                width: 30px;
                height: 30px;
                font-size: 1rem;
            }

            section {
                padding: 1rem 0.75rem;
            }

            aside {
                width: 85vw;
                max-width: 320px;
            }

            .card {
                border-radius: 12px;
                padding: 1rem !important;
            }

            .btn-sm {
                padding: 0.375rem 0.75rem;
                font-size: 0.8125rem;
            }

            .table {
                font-size: 0.875rem;
            }

            .table thead th,
            .table tbody td {
                padding: 0.75rem 0.5rem;
            }

            #toggleSidebar {
                padding: 0.75rem 0.875rem;
            }
        }

        /* Backdrop for mobile sidebar */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 899;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-backdrop.show {
            display: block;
            opacity: 1;
        }

        /* Utility classes */
        .gap-2 {
            gap: 0.5rem !important;
        }

        .text-muted {
            color: var(--text-secondary) !important;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Premium Navbar -->
        <nav class="navbar {{ request()->routeIs('login') || request()->routeIs('register') ? 'auth-navbar' : '' }}">
            <div class="navbar-container">
                <!-- Brand -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="navbar-brand-icon">
                        <i class="fa-solid fa-hotel"></i>
                    </div>
                    StayEase
                </a>

                @php
                $hideNav = isset($hideNav) ? $hideNav : (view()->shared('hideNav') ?? false);
                $showCentered = !$hideNav && !(request()->routeIs('login') || request()->routeIs('register'));
                $isAdmin = auth()->check() && method_exists(auth()->user(), 'hasRole') && auth()->user()->hasRole('Admin');
                @endphp

                <!-- Center Navigation -->
                @if($showCentered && !$isAdmin)
                <div class="navbar-center" id="navbarCenter">
                    <a class="nav-link" href="#home">Home</a>
                    <a class="nav-link" href="#hotels">Hotels</a>
                    <a class="nav-link" href="#myBookings">My Bookings</a>
                    <a class="nav-link" href="#about">About</a>
                    <a class="nav-link" href="#contact">Contact</a>
                </div>
                @endif

                <!-- Right Actions -->
                <div class="navbar-actions">
                    @guest
                        @if (Route::has('login') && empty($hideNav))
                        <a data-skip-loader="true" class="nav-link" href="{{ route('login') }}">
                            Login
                        </a>
                        @endif
                        @if (Route::has('register') && empty($hideNav))
                        <a data-skip-loader="true" class="btn btn-primary" href="{{ route('register') }}">
                            Sign Up
                        </a>
                        @endif
                    @else
                    <div class="user-dropdown">
                        <div class="user-dropdown-toggle" id="userDropdown">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem;"></i>
                        </div>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </div>
                    @endguest

                    <!-- Mobile Toggle -->
                    @if($showCentered && !$isAdmin)
                    <button class="navbar-toggler" id="navbarToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            @php
            $showAdminSidebar = auth()->check() && method_exists(auth()->user(), 'hasRole') && auth()->user()->hasRole('Admin');
            @endphp

            @if($showAdminSidebar)
            <!-- Sidebar Toggle (Mobile) -->
            <button id="toggleSidebar">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Premium Sidebar -->
            <aside id="adminSidebar">
                <div class="sidebar-header">
                    <div class="sidebar-title">
                        <span>Admin Panel</span>
                    </div>
                </div>

                <div class="sidebar-nav">
                    <!-- Main Section -->
                    <div class="sidebar-section">
                        <div class="sidebar-section-title">Main</div>
                        <a href="{{ route('overview.index') }}"
                            class="nav-link {{ request()->routeIs('overview.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-line"></i>
                            <span>Overview</span>
                        </a>
                    </div>

                    <!-- Management Section -->
                    <div class="sidebar-section">
                        <div class="sidebar-section-title">Management</div>
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i>
                            <span>Users</span>
                        </a>
                        <a href="{{ route('roles.index') }}"
                            class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-shield"></i>
                            <span>Roles</span>
                        </a>
                        <a href="{{ route('hotels.index') }}"
                            class="nav-link {{ request()->routeIs('hotels.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-building"></i>
                            <span>Hotels</span>
                        </a>
                        <a href="{{ route('bookings.index') }}"
                            class="nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-calendar-check"></i>
                            <span>Bookings</span>
                        </a>
                    </div>

                    <!-- Other Section -->
                    <div class="sidebar-section">
                        <div class="sidebar-section-title">Other</div>
                        <a href="{{ route('public.home') }}" target="_blank" rel="noopener" class="nav-link">
                            <i class="fa-solid fa-globe"></i>
                            <span>View Website</span>
                            <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem; margin-left: auto;"></i>
                        </a>
                    </div>
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

    {{-- My Bookings Section --}}
    @auth
        @unless($isAdmin)
            @php
                $myBookings = \App\Models\Booking::with('hotel')->where('user_id', auth()->id())->latest()->get();
            @endphp
            <section id="myBookings">
                <div class="container py-5">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="mb-1 fw-bold">My Bookings</h4>
                                <p class="text-muted mb-0">Manage your upcoming reservations</p>
                            </div>
                            <span class="badge badge-success">{{ $myBookings->count() }} Total</span>
                        </div>

                        @if($myBookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hotel</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Guests</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myBookings as $booking)
                                    <tr>
                                        <td><strong>#{{ $booking->id }}</strong></td>
                                        <td>{{ optional($booking->hotel)->name ?? ($booking->product_name ?? '—') }}</td>
                                        <td>{{ $booking->check_in ? \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') : '—' }}</td>
                                        <td>{{ $booking->check_out ? \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') : '—' }}</td>
                                        <td>{{ $booking->guests ?? '—' }}</td>
                                        <td>
                                            <span class="badge badge-{{ ($booking->status ?? 'pending') === 'confirmed' ? 'success' : 'warning' }}">
                                                {{ ucfirst($booking->status ?? 'pending') }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                @if(($booking->status ?? 'pending') !== 'confirmed')
                                                <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fa-solid fa-check me-1"></i>Confirm
                                                    </button>
                                                </form>
                                                @endif

                                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel this booking?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa-solid fa-times me-1"></i>Cancel
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="empty-state">
                            <i class="fa-solid fa-calendar-xmark fa-3x text-muted"></i>
                            <h5 class="text-muted mb-2">No bookings yet</h5>
                            <p class="text-muted mb-4">Start exploring our hotels and make your first reservation!</p>
                            <a href="#hotels" class="btn btn-primary">
                                <i class="fa-solid fa-hotel me-2"></i>Browse Hotels
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
        @endunless
    @endauth

    <!-- Page Loader -->
    <div id="pageLoader" class="page-loader" aria-hidden="true" aria-live="polite">
        <div class="page-loader-inner" role="status">
            <div class="loader-brand">
                <i class="fa-solid fa-hotel"></i>
            </div>
            <div class="loader-spinner" aria-hidden="true"></div>
            <div class="loader-text">Preparing your experience...</div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar Toggle
            const toggleBtn = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.createElement('div');
            backdrop.className = 'sidebar-backdrop';
            document.body.appendChild(backdrop);

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    sidebar.classList.toggle('show');
                    backdrop.classList.toggle('show');
                    document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
                });

                backdrop.addEventListener('click', () => {
                    sidebar.classList.remove('show');
                    backdrop.classList.remove('show');
                    document.body.style.overflow = '';
                });
            }

            sidebar?.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        sidebar.classList.remove('show');
                        backdrop.classList.remove('show');
                        document.body.style.overflow = '';
                    }
                });
            });

            // User Dropdown
            const userDropdown = document.getElementById('userDropdown');
            const dropdownMenu = document.getElementById('dropdownMenu');

            userDropdown?.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });

            document.addEventListener('click', (e) => {
                if (!userDropdown?.contains(e.target)) {
                    dropdownMenu?.classList.remove('show');
                }
            });

            // Mobile Navbar Toggle
            const navbarToggle = document.getElementById('navbarToggle');
            const navbarCenter = document.getElementById('navbarCenter');

            navbarToggle?.addEventListener('click', () => {
                navbarToggle.classList.toggle('active');
                navbarCenter?.classList.toggle('show');
            });

            navbarCenter?.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    navbarToggle?.classList.remove('active');
                    navbarCenter.classList.remove('show');
                });
            });

            // Smooth Scroll
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href !== '#' && href !== '') {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            const navbarHeight = 70;
                            const targetPosition = target.offsetTop - navbarHeight - 20;
                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });

            // Navbar Scroll Effect
            window.addEventListener('scroll', () => {
                const navbar = document.querySelector('.navbar');
                if (window.pageYOffset > 50) {
                    navbar?.classList.add('scrolled');
                } else {
                    navbar?.classList.remove('scrolled');
                }
            });
        });

        /* Page Loader */
        (function () {
            const loader = document.getElementById('pageLoader');
            if (!loader) return;

            let active = false;

            function showLoader() {
                if (active) return;
                active = true;
                requestAnimationFrame(() => loader.classList.add('show'));
            }

            function hideLoader() {
                if (!active) return;
                active = false;
                loader.classList.remove('show');
            }

            function isAuthPath(pathname) {
                return /(^|\/)\b(login|register)\b(\/|$)/i.test(pathname || '');
            }

            document.addEventListener('click', (e) => {
                const a = e.target.closest('a');
                if (!a) return;
                const href = a.getAttribute('href');
                if (!href || href.startsWith('#')) return;
                if (a.target && a.target !== '' && a.target !== '_self') return;
                if (a.hasAttribute('download')) return;
                
                let url;
                try {
                    url = new URL(a.href, location.href);
                    if (url.origin !== location.origin) return;
                    if (url.pathname === location.pathname && url.search === location.search) return;
                } catch (err) {
                    return;
                }

                if (a.hasAttribute('data-skip-loader')) return;
                if (isAuthPath(url.pathname)) return;
                showLoader();
            }, { capture: true });

            document.addEventListener('submit', (e) => {
                const form = e.target;
                if (!form || !(form instanceof HTMLFormElement)) return;
                if (form.hasAttribute('data-ajax')) return;
                
                let action = form.getAttribute('action') || location.pathname;
                if (form.hasAttribute('data-skip-loader')) return;
                if (isAuthPath(action)) return;
                showLoader();
            }, { capture: true });

            window.addEventListener('beforeunload', () => {
                if (isAuthPath(location.pathname)) return;
                showLoader();
            });

            window.addEventListener('load', () => setTimeout(hideLoader, 150));
            document.addEventListener('DOMContentLoaded', () => setTimeout(hideLoader, 100));
        })();
    </script>
    @stack('scripts')
</body>

</html>
