@extends('layouts.app')

@section('content')
<style>
    .overview-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .stat-card .grow {
        min-width: 0;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--card-color, #667eea), var(--card-color-end, #764ba2));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-icon-wrapper {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--icon-bg-start), var(--icon-bg-end));
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-card.users {
        --card-color: #667eea;
        --card-color-end: #764ba2;
        --icon-bg-start: rgba(102, 126, 234, 0.1);
        --icon-bg-end: rgba(118, 75, 162, 0.1);
    }

    .stat-card.hotels {
        --card-color: #10b981;
        --card-color-end: #059669;
        --icon-bg-start: rgba(16, 185, 129, 0.1);
        --icon-bg-end: rgba(5, 150, 105, 0.1);
    }

    .stat-card.bookings {
        --card-color: #f59e0b;
        --card-color-end: #d97706;
        --icon-bg-start: rgba(245, 158, 11, 0.1);
        --icon-bg-end: rgba(217, 119, 6, 0.1);
    }

    .stat-card.roles {
        --card-color: #8b5cf6;
        --card-color-end: #7c3aed;
        --icon-bg-start: rgba(139, 92, 246, 0.1);
        --icon-bg-end: rgba(124, 58, 237, 0.1);
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
        margin: 0.75rem 0 0.25rem 0;
        background: linear-gradient(135deg, var(--card-color), var(--card-color-end));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .stat-meta {
        font-size: 0.75rem;
        color: #9ca3af;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .recent-bookings-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-header-custom h5 {
        margin: 0;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .booking-item {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f3f4f6;
        transition: background-color 0.2s ease;
    }

    .booking-item:last-child {
        border-bottom: none;
    }

    .booking-item:hover {
        background-color: #f9fafb;
    }

    .booking-user {
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.25rem;
    }

    .booking-details {
        font-size: 0.875rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .booking-detail-item {
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .refresh-btn {
        background: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: black;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .refresh-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border-color: white;
        transform: scale(1.05);
    }

    .refresh-btn i {
        transition: transform 0.6s ease;
    }

    .refresh-btn.spinning i {
        transform: rotate(360deg);
    }

    .skeleton-loader {
        background: linear-gradient(90deg, #f3f4f6 0%, #e5e7eb 50%, #f3f4f6 100%);
        background-size: 200% 100%;
        animation: skeleton-loading 1.5s ease-in-out infinite;
        border-radius: 8px;
        height: 1.5rem;
    }

    @keyframes skeleton-loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .quick-actions {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-top: 2rem;
    }

    .quick-action-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quick-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .time-display {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.9);
        margin-top: 0.5rem;
    }

    @media (max-width: 768px) {
        .overview-header {
            padding: 1.5rem;
        }

        .stat-card {
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .booking-details {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }

    .trend-indicator {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .trend-up {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .trend-down {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
    }

    .chart-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .chart-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
    }

    .chart-header {
        padding: 1.5rem;
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chart-header h5 {
        margin: 0;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .chart-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .chart-card.status-chart .chart-icon {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(102, 126, 234, 0.15));
        color: #667eea;
    }

    .chart-card.trend-chart .chart-icon {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(102, 126, 234, 0.15));
        color: #10b981;
    }

    .chart-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.35rem 0.75rem;
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .chart-container {
        padding: 2rem 1.5rem;
        position: relative;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 300px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.5) 0%, rgba(249, 250, 251, 0.8) 100%);
    }

    .chart-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 250px;
    }

    .chart-container canvas {
        max-height: 100%;
    }

    .chart-footer {
        padding: 1rem 1.5rem;
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
        font-size: 0.875rem;
        color: #6b7280;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chart-footer-stat {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .chart-footer-stat strong {
        color: #111827;
        font-weight: 600;
    }

    .chart-loading {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 1rem;
    }

    .chart-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid rgba(102, 126, 234, 0.2);
        border-top-color: #667eea;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .chart-stat-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.75rem;
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .chart-stat-badge.trend-up i {
        animation: slideUp 0.6s ease-in-out;
    }

    @keyframes slideUp {
        0% { transform: translateY(3px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }

    .chart-card.no-data {
        align-items: center;
        justify-content: center;
    }

    .chart-no-data-state {
        text-align: center;
        padding: 2rem;
        color: #9ca3af;
    }

    .chart-no-data-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .chart-responsive-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
    }

    @media (max-width: 768px) {
        .chart-container {
            min-height: 250px;
            padding: 1.5rem 1rem;
        }

        .chart-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .chart-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .chart-header h5 {
            font-size: 1rem;
        }
    }

    /* Chart Animation on Load */
    @keyframes chartFadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chart-card {
        animation: chartFadeIn 0.5s ease-out;
    }

    /* Enhanced Chart.js Styling */
    .chartjs-tooltip {
        background: rgba(0, 0, 0, 0.95) !important;
        border-radius: 8px !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
    }
</style>

<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="overview-header">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
                <h2 class="mb-2">
                    <i class="fa-solid fa-chart-line me-2"></i>
                    Dashboard Overview
                </h2>
                <p class="mb-0 opacity-90">Welcome back! Here's what's happening with StayEase today.</p>
                <div class="time-display" id="currentDateTime">
                    <i class="fa-solid fa-clock me-1"></i>
                    <span id="dateTimeText"></span>
                </div>
            </div>
            <button id="refreshStats" class="refresh-btn">
                <i class="fa-solid fa-rotate-right me-2"></i>
                Refresh Data
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4" id="overviewCards">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card users">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="grow">
                        <div class="stat-label">Total Users</div>
                        <div id="statUsers" class="stat-value">
                            <div class="skeleton-loader" style="width: 80px;"></div>
                        </div>
                        <div class="stat-meta">
                            <i class="fa-solid fa-arrow-up"></i>
                            <span>Active members</span>
                        </div>
                    </div>
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-users fa-2x" style="color: #667eea;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card hotels">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="grow">
                        <div class="stat-label">Total Hotels</div>
                        <div id="statHotels" class="stat-value">
                            <div class="skeleton-loader" style="width: 80px;"></div>
                        </div>
                        <div class="stat-meta">
                            <i class="fa-solid fa-building"></i>
                            <span>Listed properties</span>
                        </div>
                    </div>
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-hotel fa-2x" style="color: #10b981;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card bookings">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="grow">
                        <div class="stat-label">Total Bookings</div>
                        <div id="statBookings" class="stat-value">
                            <div class="skeleton-loader" style="width: 80px;"></div>
                        </div>
                        <div class="stat-meta">
                            <i class="fa-solid fa-hourglass-half"></i>
                            <span>Pending: <strong id="statBookingsPending">0</strong></span>
                        </div>
                    </div>
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-calendar-check fa-2x" style="color: #f59e0b;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card roles">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="grow">
                        <div class="stat-label">User Roles</div>
                        <div id="statRoles" class="stat-value">
                            <div class="skeleton-loader" style="width: 80px;"></div>
                        </div>
                        <div class="stat-meta">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Access levels</span>
                        </div>
                    </div>
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-user-shield fa-2x" style="color: #8b5cf6;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-6">
            <div class="chart-card status-chart">
                <div class="chart-header">
                    <h5>
                        <div class="chart-icon">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        Booking Status Distribution
                    </h5>
                    <span class="chart-badge" id="statusChartBadge">Live</span>
                </div>
                <div class="chart-container" id="statusChartContainer">
                    <div class="chart-loading">
                        <div class="chart-spinner"></div>
                        <span>Loading chart...</span>
                    </div>
                </div>
                <div class="chart-footer" id="statusChartFooter">
                    <div class="chart-footer-stat">
                        <i class="fa-solid fa-calendar"></i>
                        <span>Total Bookings: <strong id="totalBookingsDisplay">0</strong></span>
                    </div>
                    <div class="chart-stat-badge trend-up">
                        <i class="fa-solid fa-arrow-up"></i>
                        <span id="statusTrendDisplay">0%</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="chart-card trend-chart">
                <div class="chart-header">
                    <h5>
                        <div class="chart-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        Monthly Bookings Trend
                    </h5>
                    <span class="chart-badge" id="trendChartBadge">Live</span>
                </div>
                <div class="chart-container" id="trendChartContainer">
                    <div class="chart-loading">
                        <div class="chart-spinner"></div>
                        <span>Loading chart...</span>
                    </div>
                </div>
                <div class="chart-footer" id="trendChartFooter">
                    <div class="chart-footer-stat">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>This Year: <strong id="yearBookingsDisplay">0</strong></span>
                    </div>
                    <div class="chart-stat-badge">
                        <i class="fa-solid fa-info-circle"></i>
                        <span id="trendAverageDisplay">Avg: 0/mo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Section -->
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="recent-bookings-card">
                <div class="card-header-custom">
                    <h5>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        Recent Bookings
                    </h5>
                </div>
                <div id="recentBookings">
                    <div class="booking-item">
                        <div class="skeleton-loader mb-2"></div>
                        <div class="skeleton-loader" style="width: 60%; height: 1rem;"></div>
                    </div>
                    <div class="booking-item">
                        <div class="skeleton-loader mb-2"></div>
                        <div class="skeleton-loader" style="width: 60%; height: 1rem;"></div>
                    </div>
                    <div class="booking-item">
                        <div class="skeleton-loader mb-2"></div>
                        <div class="skeleton-loader" style="width: 60%; height: 1rem;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="col-12 col-lg-4">
            <div class="quick-actions">
                <h5 class="mb-3">
                    <i class="fa-solid fa-bolt me-2"></i>
                    Quick Actions
                </h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('bookings.index') }}" class="quick-action-btn">
                        <i class="fa-solid fa-calendar-plus"></i>
                        New Booking
                    </a>
                    <a href="{{ route('users.index') }}" class="quick-action-btn" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        <i class="fa-solid fa-user-plus"></i>
                        Add Guest
                    </a>
                    <button class="quick-action-btn" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                        <i class="fa-solid fa-file-export"></i>
                        Export Report
                    </button>
                    <button class="quick-action-btn" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                        <i class="fa-solid fa-cog"></i>
                        Settings
                    </button>
                </div>
            </div>

            <!-- System Status -->
            <div class="quick-actions mt-3">
                <h6 class="mb-3">
                    <i class="fa-solid fa-circle-info me-2"></i>
                    System Status
                </h6>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">Server Status</span>
                    <span class="badge bg-success">Online</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">Database</span>
                    <span class="badge bg-success">Connected</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Last Backup</span>
                    <span class="text-muted small">2 hours ago</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script>
(function(){
    const statsUrl = "{{ route('overview.stats') }}";
    let isRefreshing = false;
    let bookingStatusChart = null;
    let monthlyBookingsChart = null;

    // Update date and time
    function updateDateTime() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        document.getElementById('dateTimeText').textContent = now.toLocaleDateString('en-US', options);
    }

    // Fetch statistics
    async function fetchStats(){
        if (isRefreshing) return;
        isRefreshing = true;
        
        const refreshBtn = document.getElementById('refreshStats');
        refreshBtn.classList.add('spinning');
        
        try{
            const res = await fetch(statsUrl, { headers: { 'Accept': 'application/json' } });
            if(!res.ok) throw new Error('Network error: ' + res.status);
            const data = await res.json();
            
            console.log('Stats data received:', data);
            
            // Ensure all values are numbers
            const users = parseInt(data.users) || 0;
            const hotels = parseInt(data.hotels) || 0;
            const bookings = parseInt(data.bookings) || 0;
            const roles = parseInt(data.roles) || 0;
            const bookingsPending = parseInt(data.bookings_pending) || 0;
            
            console.log('Parsed values - users:', users, 'hotels:', hotels, 'bookings:', bookings, 'roles:', roles);
            
            // Animate stat updates
            animateValue('statUsers', 0, users, 800);
            animateValue('statHotels', 0, hotels, 800);
            animateValue('statBookings', 0, bookings, 800);
            animateValue('statRoles', 0, roles, 800);
            
            document.getElementById('statBookingsPending').textContent = bookingsPending;

            // Update charts
            updateBookingStatusChart(data);
            updateMonthlyBookingsChart(data);

            // Fetch recent bookings
            await fetchRecentBookings();
        }catch(err){
            console.error('Error fetching stats:', err);
            showError();
        } finally {
            setTimeout(() => {
                refreshBtn.classList.remove('spinning');
                isRefreshing = false;
            }, 600);
        }
    }

    // Animate number counting
    function animateValue(id, start, end, duration) {
        const element = document.getElementById(id);
        const range = end - start;
        const increment = range / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
                current = end;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 16);
    }

    // Fetch recent bookings
    async function fetchRecentBookings(){
        try{
            const res = await fetch("{{ route('bookings.index') }}", { headers: { 'Accept': 'text/html' } });
            if(!res.ok) throw new Error('Failed to fetch recent bookings');
            const html = await res.text();
            
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const rows = doc.querySelectorAll('table tbody tr');
            
            if(!rows || rows.length === 0){
                showEmptyBookings();
                return;
            }
            
            const container = document.getElementById('recentBookings');
            container.innerHTML = '';
            
            Array.from(rows).slice(0, 5).forEach((row, index) => {
                const cols = row.querySelectorAll('td');
                const user = cols[1]?.textContent.trim() ?? '—';
                const hotel = cols[2]?.textContent.trim() ?? '—';
                const checkIn = cols[3]?.textContent.trim() ?? '—';
                const checkOut = cols[4]?.textContent.trim() ?? '—';
                
                const bookingItem = document.createElement('div');
                bookingItem.className = 'booking-item';
                bookingItem.style.opacity = '0';
                bookingItem.style.transform = 'translateY(10px)';
                bookingItem.innerHTML = `
                    <div class="booking-user">${user}</div>
                    <div class="booking-details">
                        <div class="booking-detail-item">
                            <i class="fa-solid fa-hotel"></i>
                            <span>${hotel}</span>
                        </div>
                        <div class="booking-detail-item">
                            <i class="fa-solid fa-calendar"></i>
                            <span>${checkIn} → ${checkOut}</span>
                        </div>
                    </div>
                `;
                
                container.appendChild(bookingItem);
                
                // Fade in animation
                setTimeout(() => {
                    bookingItem.style.transition = 'all 0.3s ease';
                    bookingItem.style.opacity = '1';
                    bookingItem.style.transform = 'translateY(0)';
                }, index * 50);
            });
            
        }catch(err){
            console.error('Error fetching bookings:', err);
            showEmptyBookings();
        }
    }

    // Show empty state for bookings
    function showEmptyBookings() {
        const container = document.getElementById('recentBookings');
        container.innerHTML = `
            <div class="empty-state">
                <i class="fa-solid fa-calendar-xmark"></i>
                <div>No bookings available</div>
            </div>
        `;
    }

    // Show error state
    function showError() {
        document.getElementById('statUsers').textContent = '—';
    document.getElementById('statHotels').textContent = '—';
        document.getElementById('statBookings').textContent = '—';
        document.getElementById('statRoles').textContent = '—';
    }

    // Initialize Booking Status Chart
    function initBookingStatusChart() {
        const container = document.getElementById('statusChartContainer');
        if (!container || container.querySelector('canvas')) return;

        const canvas = document.createElement('canvas');
        canvas.id = 'bookingStatusChart';
        container.innerHTML = '';
        container.appendChild(canvas);

        bookingStatusChart = new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Confirmed', 'Completed', 'Cancelled'],
                datasets: [{
                    data: [0, 0, 0, 0],
                    backgroundColor: [
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgba(245, 158, 11, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(102, 126, 234, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    hoverOffset: 12,
                    hoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 12, weight: '500' },
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            color: '#6b7280',
                            generateLabels: function(chart) {
                                const data = chart.data;
                                return data.labels.map((label, i) => ({
                                    text: label,
                                    fillStyle: data.datasets[0].backgroundColor[i],
                                    hidden: false,
                                    index: i
                                }));
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        titleColor: '#fff',
                        bodyColor: '#e5e7eb',
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                return `${context.label}: ${context.parsed} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Update Booking Status Chart
    function updateBookingStatusChart(data) {
        if (!bookingStatusChart) {
            initBookingStatusChart();
        }

        if (bookingStatusChart && data.booking_status) {
            const statusData = [
                data.booking_status.pending || 0,
                data.booking_status.confirmed || 0,
                data.booking_status.completed || 0,
                data.booking_status.cancelled || 0
            ];

            bookingStatusChart.data.datasets[0].data = statusData;
            bookingStatusChart.update('active');

            // Update footer stats
            const total = statusData.reduce((a, b) => a + b, 0);
            document.getElementById('totalBookingsDisplay').textContent = total;

            // Calculate trend (percentage of confirmed/completed)
            const completed = (statusData[1] + statusData[2]);
            const trendPercentage = total > 0 ? ((completed / total) * 100).toFixed(0) : 0;
            document.getElementById('statusTrendDisplay').textContent = trendPercentage + '%';
        }
    }

    // Initialize Monthly Bookings Chart
    function initMonthlyBookingsChart() {
        const container = document.getElementById('trendChartContainer');
        if (!container || container.querySelector('canvas')) return;

        const canvas = document.createElement('canvas');
        canvas.id = 'monthlyBookingsChart';
        container.innerHTML = '';
        container.appendChild(canvas);

        monthlyBookingsChart = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Bookings',
                    data: Array(12).fill(0),
                    backgroundColor: [
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(102, 126, 234, 0.75)',
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(102, 126, 234, 0.75)',
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(102, 126, 234, 0.75)',
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(102, 126, 234, 0.75)',
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(102, 126, 234, 0.75)',
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(102, 126, 234, 0.75)'
                    ],
                    borderColor: 'rgba(102, 126, 234, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    hoverBackgroundColor: 'rgba(102, 126, 234, 1)',
                    borderSkipped: false,
                    tension: 0.4
                }]
            },
            options: {
                indexAxis: undefined,
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        titleColor: '#fff',
                        bodyColor: '#e5e7eb',
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y} bookings`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false,
                            lineWidth: 1
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 12, weight: '500' },
                            stepSize: 1,
                            padding: 8
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 12, weight: '500' },
                            padding: 8
                        }
                    }
                }
            }
        });
    }

    // Update Monthly Bookings Chart
    function updateMonthlyBookingsChart(data) {
        if (!monthlyBookingsChart) {
            initMonthlyBookingsChart();
        }

        if (monthlyBookingsChart && data.monthly_bookings) {
            monthlyBookingsChart.data.datasets[0].data = data.monthly_bookings;
            monthlyBookingsChart.update('active');

            // Update footer stats
            const total = data.monthly_bookings.reduce((a, b) => a + b, 0);
            const average = (total / 12).toFixed(1);
            document.getElementById('yearBookingsDisplay').textContent = total;
            document.getElementById('trendAverageDisplay').textContent = `Avg: ${average}/mo`;
        }
    }

    // Event listeners
    document.getElementById('refreshStats').addEventListener('click', fetchStats);

    // Initial load
    updateDateTime();
    initBookingStatusChart();
    initMonthlyBookingsChart();
    fetchStats();
    
    // Update time every minute
    setInterval(updateDateTime, 60000);
    
    // Auto-refresh stats every 30 seconds
    setInterval(fetchStats, 30000);
})();
</script>
@endpush

@endsection
