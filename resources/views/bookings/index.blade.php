@extends('layouts.app')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 1.25rem;
        color: white;
        margin-bottom: 1.25rem;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .page-header h2 {
        margin: 0;
        font-weight: 700;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        z-index: 1;
    }

    .page-header p {
        margin: 0.25rem 0 0 0;
        opacity: 0.95;
        font-size: 0.85rem;
        position: relative;
        z-index: 1;
    }

    .create-btn {
        background: white;
        color: #667eea;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .create-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: #667eea;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        border: 2px solid #10b981;
        border-radius: 12px;
        color: #059669;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: slideDown 0.4s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stats-bar {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 0.875rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 10px;
        flex: 1;
        min-width: 120px;
    }

    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.9rem;
    }

    .stat-content {
        display: flex;
        flex-direction: column;
    }

    .stat-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.65rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 0.125rem;
    }

    .search-section {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input {
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        padding: 0.5rem 0.75rem 0.5rem 2.5rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .search-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
    }

    .filter-select {
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .table-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #9ca3af;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }

    .table {
        margin-bottom: 0;
        min-width: 900px;
    }

    .table thead {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table thead th {
        border-bottom: 2px solid #e5e7eb;
        color: #374151;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.65rem;
        letter-spacing: 0.05em;
        padding: 0.875rem 0.75rem;
        white-space: nowrap;
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f3f4f6;
    }

    .table tbody tr:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.03) 0%, rgba(118, 75, 162, 0.03) 100%);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
    }

    .table tbody td {
        padding: 0.875rem 0.75rem;
        vertical-align: middle;
        font-size: 0.8rem;
    }

    /* Mobile Card View */
    .booking-card-mobile {
        display: none;
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
    }

    .booking-card-mobile:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .booking-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.875rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f3f4f6;
    }

    .booking-card-body {
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
        margin-bottom: 0.875rem;
    }

    .booking-card-field {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .booking-card-label {
        font-size: 0.65rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    .booking-card-value {
        font-size: 0.8rem;
        color: #111827;
        font-weight: 500;
    }

    .booking-card-actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid #f3f4f6;
    }

    .booking-card-actions .action-btn {
        flex: 1;
        justify-content: center;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.85rem;
        box-shadow: 0 3px 8px rgba(102, 126, 234, 0.3);
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.05rem;
        font-size: 0.85rem;
    }

    .user-email {
        font-size: 0.7rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.375rem 0.75rem;
        border-radius: 14px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-badge i {
        font-size: 0.65rem;
    }

    .status-confirmed {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%);
        color: #059669;
        border: 2px solid rgba(5, 150, 105, 0.3);
    }

    .status-pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(217, 119, 6, 0.15) 100%);
        color: #d97706;
        border: 2px solid rgba(217, 119, 6, 0.3);
    }

    .status-cancelled {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(220, 38, 38, 0.15) 100%);
        color: #dc2626;
        border: 2px solid rgba(220, 38, 38, 0.3);
    }

    .status-checked-in {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(37, 99, 235, 0.15) 100%);
        color: #2563eb;
        border: 2px solid rgba(37, 99, 235, 0.3);
    }

    .status-checked-out {
        background: linear-gradient(135deg, rgba(107, 114, 128, 0.15) 0%, rgba(75, 85, 99, 0.15) 100%);
        color: #4b5563;
        border: 2px solid rgba(75, 85, 99, 0.3);
    }

    .action-btn {
        border-radius: 8px;
        padding: 0.5rem 0.875rem;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid;
    }

    .btn-view {
        background: rgba(59, 130, 246, 0.1);
        border-color: #3b82f6;
        color: #3b82f6;
    }

    .btn-view:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-edit {
        background: rgba(102, 126, 234, 0.1);
        border-color: #667eea;
        color: #667eea;
    }

    .btn-edit:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        border-color: #ef4444;
        color: #ef4444;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 1.5rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        padding: 1.5rem;
        border-top: 1px solid #f3f4f6;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        opacity: 0.5;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-state h4 {
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .no-actions {
        color: #9ca3af;
        font-style: italic;
        font-size: 0.875rem;
    }

    .delete-warning {
        background: rgba(239, 68, 68, 0.1);
        border-left: 4px solid #ef4444;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
    }

    .delete-warning i {
        color: #ef4444;
    }

    @media (max-width: 992px) {
        .table {
            min-width: 800px;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 1rem;
        }

        .page-header h2 {
            font-size: 1.25rem;
        }

        .page-header p {
            font-size: 0.75rem;
        }

        .stats-bar {
            flex-direction: column;
            gap: 0.75rem;
        }

        .stat-item {
            min-width: auto;
        }

        .action-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.65rem;
        }

        .search-section .row {
            gap: 0.75rem;
        }

        /* Hide table, show cards on mobile */
        .table-responsive {
            display: none !important;
        }

        .booking-card-mobile {
            display: block !important;
        }

        .table-card .p-4 {
            padding: 1rem !important;
        }
    }

    @media (max-width: 576px) {
        .create-btn {
            width: 100%;
            justify-content: center;
        }

        .page-header .d-flex {
            flex-direction: column;
            gap: 1rem;
        }

        .booking-card-actions {
            flex-direction: column;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>
                    <i class="fa-solid fa-calendar-check"></i>
                    Bookings Management
                </h2>
                <p>Manage hotel bookings, check statuses, and track reservations</p>
            </div>
            <a href="{{ route('bookings.create') }}" class="create-btn">
                <i class="fa-solid fa-plus"></i>
                New Booking
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @session('success')
    <div class="alert-success">
        <i class="fa-solid fa-circle-check fa-lg"></i>
        <span>{{ $value }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endsession

    <!-- Statistics Bar -->
    @php
        $totalBookings = $bookings->total();
        $confirmedCount = \App\Models\Booking::where('status', 'confirmed')->count();
        $pendingCount = \App\Models\Booking::where('status', 'pending')->count();
        $cancelledCount = \App\Models\Booking::where('status', 'cancelled')->count();
        $checkedInCount = \App\Models\Booking::where('status', 'checked-in')->count();
    @endphp
    <div class="stats-bar">
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalBookings }}</div>
                <div class="stat-label">Total Bookings</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $confirmedCount }}</div>
                <div class="stat-label">Confirmed</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $pendingCount }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                <i class="fa-solid fa-right-to-bracket"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $checkedInCount }}</div>
                <div class="stat-label">Checked In</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <i class="fa-solid fa-ban"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $cancelledCount }}</div>
                <div class="stat-label">Cancelled</div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="row g-3">
            <div class="col-md-8">
                <div class="search-input-wrapper">
                    <i class="fa-solid fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search by user, hotel, or status...">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select filter-select" id="statusFilter">
                    <option value="">All Statuses</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="checked-in">Checked In</option>
                    <option value="checked-out">Checked Out</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Desktop Table View -->
    @if($bookings->count() > 0)
    <div class="table-card">
        <div class="table-responsive">
            <table class="table" id="bookingsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Hotel</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    @php
                        $status = strtolower($booking->status);
                        $statusClass = 'status-' . $status;
                        $statusIcon = match($status) {
                            'confirmed' => 'fa-circle-check',
                            'pending' => 'fa-clock',
                            'cancelled' => 'fa-ban',
                            'checked-in' => 'fa-right-to-bracket',
                            'checked-out' => 'fa-right-from-bracket',
                            default => 'fa-question',
                        };
                    @endphp
                    <tr data-user="{{ strtolower($booking->user->name ?? '') }}" 
                        data-hotel="{{ strtolower($booking->product->name ?? '') }}" 
                        data-status="{{ $status }}">
                        <td><strong>#{{ $booking->id }}</strong></td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($booking->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <div class="user-name">{{ $booking->user->name ?? '—' }}</div>
                                    <div class="user-email">
                                        <i class="fa-solid fa-envelope"></i>
                                        {{ $booking->user->email ?? '—' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fa-solid fa-hotel" style="color: #667eea;"></i>
                                <span style="font-weight: 600;">{{ $booking->product->name ?? '—' }}</span>
                            </div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.375rem;">
                                <i class="fa-solid fa-user-group" style="color: #667eea; font-size: 0.75rem;"></i>
                                <strong>{{ $booking->guests }}</strong>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge {{ $statusClass }}">
                                <i class="fa-solid {{ $statusIcon }}"></i>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('bookings.show', $booking->id) }}" 
                                   class="btn action-btn btn-view"
                                   title="View Details">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @if(auth()->user()->hasRole('Admin') || auth()->id() === $booking->user_id)
                                <a href="{{ route('bookings.edit', $booking->id) }}" 
                                   class="btn action-btn btn-edit"
                                   title="Edit Booking">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" 
                                        class="btn action-btn btn-delete"
                                        title="Delete Booking"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-booking-id="{{ $booking->id }}"
                                        data-user-name="{{ $booking->user->name ?? 'Unknown' }}"
                                        data-delete-url="{{ route('bookings.destroy', $booking->id) }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($bookings->hasPages())
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted" style="font-size: 0.875rem;">
                    Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} bookings
                </div>
                <div>
                    {!! $bookings->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Mobile Card View -->
    @foreach($bookings as $booking)
    @php
        $status = strtolower($booking->status);
        $statusClass = 'status-' . $status;
        $statusIcon = match($status) {
            'confirmed' => 'fa-circle-check',
            'pending' => 'fa-clock',
            'cancelled' => 'fa-ban',
            'checked-in' => 'fa-right-to-bracket',
            'checked-out' => 'fa-right-from-bracket',
            default => 'fa-question',
        };
    @endphp
    <div class="booking-card-mobile" 
         data-user="{{ strtolower($booking->user->name ?? '') }}" 
         data-hotel="{{ strtolower($booking->product->name ?? '') }}" 
         data-status="{{ $status }}">
        <div class="booking-card-header">
            <div>
                <div style="font-weight: 700; font-size: 0.9rem; color: #111827; margin-bottom: 0.25rem;">
                    Booking #{{ $booking->id }}
                </div>
                <div style="font-size: 0.75rem; color: #6b7280;">
                    {{ $booking->user->name ?? 'Unknown User' }}
                </div>
            </div>
            <span class="status-badge {{ $statusClass }}">
                <i class="fa-solid {{ $statusIcon }}"></i>
                {{ ucfirst($booking->status) }}
            </span>
        </div>
        
        <div class="booking-card-body">
            <div class="booking-card-field">
                <div class="booking-card-label">Hotel</div>
                <div class="booking-card-value">
                    <i class="fa-solid fa-hotel me-1" style="color: #667eea;"></i>
                    {{ $booking->product->name ?? '—' }}
                </div>
            </div>
            <div class="booking-card-field">
                <div class="booking-card-label">Check-in</div>
                <div class="booking-card-value">
                    {{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}
                </div>
            </div>
            <div class="booking-card-field">
                <div class="booking-card-label">Check-out</div>
                <div class="booking-card-value">
                    {{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}
                </div>
            </div>
            <div class="booking-card-field">
                <div class="booking-card-label">Guests</div>
                <div class="booking-card-value">{{ $booking->guests }}</div>
            </div>
        </div>

        <div class="booking-card-actions">
            <a href="{{ route('bookings.show', $booking->id) }}" class="btn action-btn btn-view">
                <i class="fa-solid fa-eye me-1"></i> View
            </a>
            @if(auth()->user()->hasRole('Admin') || auth()->id() === $booking->user_id)
            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn action-btn btn-edit">
                <i class="fa-solid fa-pen-to-square me-1"></i> Edit
            </a>
            <button type="button" 
                    class="btn action-btn btn-delete"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal"
                    data-booking-id="{{ $booking->id }}"
                    data-user-name="{{ $booking->user->name ?? 'Unknown' }}"
                    data-delete-url="{{ route('bookings.destroy', $booking->id) }}">
                <i class="fa-solid fa-trash me-1"></i> Delete
            </button>
            @endif
        </div>
    </div>
    @endforeach

    @else
    <!-- Empty State -->
    <div class="table-card">
        <div class="empty-state">
            <i class="fa-solid fa-calendar-xmark"></i>
            <h4>No bookings found</h4>
            <p>There are no bookings in the system yet.</p>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Create Your First Booking
            </a>
        </div>
    </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Are you sure you want to delete booking <strong id="bookingId"></strong> for <strong id="userName"></strong>?</p>
                <div class="delete-warning">
                    <i class="fa-solid fa-exclamation-circle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. The booking will be permanently removed from the system.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash me-1"></i>Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Search and filter functionality
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const tableRows = document.querySelectorAll('#bookingsTable tbody tr');
    const mobileCards = document.querySelectorAll('.booking-card-mobile');

    function filterBookings() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedStatus = statusFilter.value.toLowerCase();

        // Filter table rows
        tableRows.forEach(row => {
            const user = row.getAttribute('data-user');
            const hotel = row.getAttribute('data-hotel');
            const status = row.getAttribute('data-status');
            
            const matchesSearch = user.includes(searchTerm) || hotel.includes(searchTerm) || status.includes(searchTerm);
            const matchesStatus = !selectedStatus || status === selectedStatus;
            
            row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
        });

        // Filter mobile cards
        mobileCards.forEach(card => {
            const user = card.getAttribute('data-user');
            const hotel = card.getAttribute('data-hotel');
            const status = card.getAttribute('data-status');
            
            const matchesSearch = user.includes(searchTerm) || hotel.includes(searchTerm) || status.includes(searchTerm);
            const matchesStatus = !selectedStatus || status === selectedStatus;
            
            card.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterBookings);
    }

    if (statusFilter) {
        statusFilter.addEventListener('change', filterBookings);
    }

    // Delete modal functionality
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const bookingId = button.getAttribute('data-booking-id');
            const userName = button.getAttribute('data-user-name');
            const deleteUrl = button.getAttribute('data-delete-url');
            
            const form = document.getElementById('deleteForm');
            const bookingIdDisplay = document.getElementById('bookingId');
            const userNameDisplay = document.getElementById('userName');
            
            form.action = deleteUrl || '';
            bookingIdDisplay.textContent = '#' + bookingId;
            userNameDisplay.textContent = userName;
        });
    }
</script>

@endsection
