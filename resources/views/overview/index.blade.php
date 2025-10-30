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
                <p class="mb-0 opacity-90">Welcome back! Here's what's happening with InstaStay today.</p>
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
                    <div class="flex-grow-1">
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
                    <div class="flex-grow-1">
                        <div class="stat-label">Total Hotels</div>
                        <div id="statProducts" class="stat-value">
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
                    <div class="flex-grow-1">
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
                    <div class="flex-grow-1">
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
<script>
(function(){
    const statsUrl = "{{ route('overview.stats') }}";
    let isRefreshing = false;

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
            if(!res.ok) throw new Error('Network error');
            const data = await res.json();
            
            // Animate stat updates
            animateValue('statUsers', 0, data.users, 800);
            animateValue('statProducts', 0, data.products, 800);
            animateValue('statBookings', 0, data.bookings, 800);
            animateValue('statRoles', 0, data.roles, 800);
            
            document.getElementById('statBookingsPending').textContent = data.bookings_pending;

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
        document.getElementById('statProducts').textContent = '—';
        document.getElementById('statBookings').textContent = '—';
        document.getElementById('statRoles').textContent = '—';
    }

    // Event listeners
    document.getElementById('refreshStats').addEventListener('click', fetchStats);

    // Initial load
    updateDateTime();
    fetchStats();
    
    // Update time every minute
    setInterval(updateDateTime, 60000);
    
    // Auto-refresh stats every 30 seconds
    setInterval(fetchStats, 30000);
})();
</script>
@endpush

@endsection
