@extends('layouts.app')

@section('content')
<style>
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 1.5rem;
        color: white;
        margin-bottom: 1.5rem;
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
        font-size: 1.75rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        z-index: 1;
    }

    .page-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.95;
        font-size: 0.9rem;
        position: relative;
        z-index: 1;
    }

    .back-btn {
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

    .back-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: #667eea;
    }

    /* Alert Styles */
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

    .alert-info {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
        border: 2px solid #3b82f6;
        border-radius: 12px;
        color: #1d4ed8;
        padding: 2rem;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        animation: slideDown 0.4s ease;
    }

    .alert-info i {
        font-size: 3rem;
        opacity: 0.6;
    }

    .alert-info p {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 500;
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

    /* Stats Bar */
    .stats-bar {
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 10px;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .stat-content {
        display: flex;
        flex-direction: column;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.7rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 0.25rem;
    }

    /* Table Card */
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
        font-size: 0.7rem;
        letter-spacing: 0.05em;
        padding: 1rem 0.875rem;
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
        padding: 1rem 0.875rem;
        vertical-align: middle;
        font-size: 0.875rem;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.875rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .status-pending {
        background: linear-gradient(135deg, rgba(251, 191, 36, 0.15) 0%, rgba(245, 158, 11, 0.15) 100%);
        color: #d97706;
        border: 1px solid rgba(251, 191, 36, 0.3);
    }

    .status-confirmed {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-cancelled {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(220, 38, 38, 0.15) 100%);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    /* Action Buttons */
    .action-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        text-decoration: none;
        cursor: pointer;
    }

    .action-btn-view {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
        color: #2563eb;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .action-btn-view:hover {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        color: #2563eb;
    }

    .action-btn-cancel {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .action-btn-cancel:hover {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        color: #dc2626;
    }

    .action-btn-edit {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        color: #667eea;
        border: 1px solid rgba(102, 126, 234, 0.3);
    }

    .action-btn-edit:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.2) 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        color: #667eea;
    }

    .action-btn-delete {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .action-btn-delete:hover {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        border-bottom: none;
        padding: 1.25rem 1.5rem;
    }

    .modal-header .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-header .btn-close:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 1.5rem;
        font-size: 0.9375rem;
        line-height: 1.6;
    }

    .modal-body strong {
        color: #374151;
        font-weight: 600;
        display: inline-block;
        min-width: 100px;
    }

    .modal-footer {
        border-top: 1px solid #e5e7eb;
        padding: 1.25rem 1.5rem;
        background: #f9fafb;
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .modal-footer .btn {
        border-radius: 8px;
        padding: 0.625rem 1.5rem;
        font-weight: 600;
        font-size: 0.9375rem;
    }

    .modal-footer .btn-secondary {
        background: #6b7280;
        border: none;
    }

    .modal-footer .btn-secondary:hover {
        background: #4b5563;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
    }

    .modal-footer .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        border: none;
    }

    .modal-footer .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    /* Mobile Card View */
    .booking-card-mobile {
        display: none;
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .booking-card-mobile:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        transform: translateX(4px);
    }

    .booking-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
        padding-bottom: 0.875rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .booking-card-id {
        font-size: 0.875rem;
        font-weight: 700;
        color: #667eea;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .booking-card-body {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.875rem;
        margin-bottom: 1rem;
    }

    .booking-card-field {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .booking-card-field.full-width {
        grid-column: 1 / -1;
    }

    .booking-card-label {
        font-size: 0.7rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .booking-card-value {
        font-size: 0.875rem;
        color: #111827;
        font-weight: 600;
    }

    .booking-card-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        padding-top: 0.875rem;
        border-top: 2px solid #f3f4f6;
    }

    .booking-card-actions .action-btn {
        flex: 1;
        min-width: 120px;
        justify-content: center;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }

    .empty-state-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .empty-state-text {
        font-size: 0.9375rem;
        color: #6b7280;
        margin-bottom: 1.5rem;
    }

    .empty-state-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .empty-state-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .table-card {
            display: none;
        }

        .booking-card-mobile {
            display: block;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 1.25rem;
        }

        .page-header h2 {
            font-size: 1.5rem;
        }

        .page-header p {
            font-size: 0.8125rem;
        }

        .stats-bar {
            grid-template-columns: 1fr;
        }

        .back-btn {
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
        }

        .booking-card-body {
            grid-template-columns: 1fr;
        }

        .booking-card-actions .action-btn {
            min-width: 100%;
        }
    }

    @media (max-width: 576px) {
        .page-header h2 {
            font-size: 1.25rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .stat-item {
            padding: 0.75rem;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            font-size: 0.9rem;
        }

        .stat-value {
            font-size: 1.25rem;
        }
    }
</style>

<div class="container py-4">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h2>
                    <i class="fa-solid fa-calendar-check"></i>
                    My Bookings
                </h2>
                <p>Manage and view all your hotel reservations</p>
            </div>
            <a href="{{ url('/') }}" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Go Back
            </a>
        </div>
    </div>

    {{-- Status Message --}}
    @if(session('status'))
        <div class="alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @if($bookings->isEmpty())
        {{-- Empty State --}}
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="fa-regular fa-calendar-xmark"></i>
            </div>
            <h3 class="empty-state-title">No Bookings Yet</h3>
            <p class="empty-state-text">You haven't made any hotel reservations. Start exploring amazing stays!</p>
            <a href="{{ url('/') }}" class="empty-state-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
                Browse Hotels
            </a>
        </div>
    @else
        {{-- Stats Bar --}}
        @php
            $totalBookings = $bookings->count();
            $confirmedBookings = $bookings->where('status', 'confirmed')->count();
            $pendingBookings = $bookings->where('status', 'pending')->count();
            $cancelledBookings = $bookings->where('status', 'cancelled')->count();
        @endphp

        <div class="stats-bar">
            <div class="stat-item">
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fa-solid fa-list-check"></i>
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
                    <div class="stat-value">{{ $confirmedBookings }}</div>
                    <div class="stat-label">Confirmed</div>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $pendingBookings }}</div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                    <i class="fa-solid fa-ban"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $cancelledBookings }}</div>
                    <div class="stat-label">Cancelled</div>
                </div>
            </div>
        </div>

        {{-- Desktop Table View --}}
        <div class="table-card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-hashtag me-1"></i> ID</th>
                            <th><i class="fa-solid fa-hotel me-1"></i> Hotel</th>
                            <th><i class="fa-solid fa-calendar-check me-1"></i> Check-in</th>
                            <th><i class="fa-solid fa-calendar-xmark me-1"></i> Check-out</th>
                            <th><i class="fa-solid fa-users me-1"></i> Guests</th>
                            <th><i class="fa-solid fa-dollar-sign me-1"></i> Price</th>
                            <th><i class="fa-solid fa-info-circle me-1"></i> Status</th>
                            <th><i class="fa-solid fa-bolt me-1"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td><strong>#{{ $booking->id }}</strong></td>
                            <td>
                                <strong>{{ $booking->hotel_name ?? ($booking->hotel->name ?? '—') }}</strong>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</td>
                            <td>
                                <span class="d-inline-flex align-items-center gap-1">
                                    <i class="fa-solid fa-user"></i>
                                    {{ $booking->guests ?? 1 }}
                                </span>
                            </td>
                            <td>
                                <strong style="color: #10b981;">${{ number_format($booking->price ?? 0, 2) }}</strong>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $booking->status ?? 'pending' }}">
                                    @if(($booking->status ?? 'pending') === 'confirmed')
                                        <i class="fa-solid fa-circle-check"></i>
                                    @elseif(($booking->status ?? 'pending') === 'pending')
                                        <i class="fa-solid fa-clock"></i>
                                    @else
                                        <i class="fa-solid fa-ban"></i>
                                    @endif
                                    {{ ucfirst($booking->status ?? 'pending') }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2 flex-wrap">
                                    @if(($booking->status ?? 'pending') === 'pending')
                                        <form action="{{ route('userbookings.confirm', $booking->id) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="action-btn action-btn-edit">
                                                <i class="fa-solid fa-check"></i>
                                                Confirm
                                            </button>
                                        </form>
                                        <button type="button" class="action-btn action-btn-cancel" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $booking->id }}">
                                            <i class="fa-solid fa-xmark"></i>
                                            Cancel
                                        </button>
                                    @elseif(($booking->status ?? 'pending') === 'confirmed')
                                        <button type="button" class="action-btn action-btn-cancel" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $booking->id }}">
                                            <i class="fa-solid fa-xmark"></i>
                                            Cancel
                                        </button>
                                    @endif
                                    @can('manage bookings')
                                        <a href="{{ route('bookings.edit', $booking->id) }}" class="action-btn action-btn-edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="action-btn action-btn-delete">
                                                <i class="fa-solid fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile Card View --}}
        <div class="mobile-cards-container">
            @foreach($bookings as $booking)
                <div class="booking-card-mobile">
                    <div class="booking-card-header">
                        <div class="booking-card-id">
                            <i class="fa-solid fa-hashtag"></i>
                            {{ $booking->id }}
                        </div>
                        <span class="status-badge status-{{ $booking->status ?? 'pending' }}">
                            @if(($booking->status ?? 'pending') === 'confirmed')
                                <i class="fa-solid fa-circle-check"></i>
                            @elseif(($booking->status ?? 'pending') === 'pending')
                                <i class="fa-solid fa-clock"></i>
                            @else
                                <i class="fa-solid fa-ban"></i>
                            @endif
                            {{ ucfirst($booking->status ?? 'pending') }}
                        </span>
                    </div>

                    <div class="booking-card-body">
                        <div class="booking-card-field full-width">
                            <div class="booking-card-label">
                                <i class="fa-solid fa-hotel"></i>
                                Hotel Name
                            </div>
                            <div class="booking-card-value">{{ $booking->hotel_name ?? ($booking->hotel->name ?? '—') }}</div>
                        </div>

                        <div class="booking-card-field">
                            <div class="booking-card-label">
                                <i class="fa-solid fa-calendar-check"></i>
                                Check-in
                            </div>
                            <div class="booking-card-value">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</div>
                        </div>

                        <div class="booking-card-field">
                            <div class="booking-card-label">
                                <i class="fa-solid fa-calendar-xmark"></i>
                                Check-out
                            </div>
                            <div class="booking-card-value">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</div>
                        </div>

                        <div class="booking-card-field">
                            <div class="booking-card-label">
                                <i class="fa-solid fa-users"></i>
                                Guests
                            </div>
                            <div class="booking-card-value">{{ $booking->guests ?? 1 }} Guest(s)</div>
                        </div>

                        <div class="booking-card-field">
                            <div class="booking-card-label">
                                <i class="fa-solid fa-dollar-sign"></i>
                                Total Price
                            </div>
                            <div class="booking-card-value" style="color: #10b981;">${{ number_format($booking->price ?? 0, 2) }}</div>
                        </div>
                    </div>

                    <div class="booking-card-actions">
                        @if(($booking->status ?? 'pending') === 'pending')
                            <form action="{{ route('userbookings.confirm', $booking->id) }}" method="POST" style="display:inline-block; width: 100%;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="action-btn action-btn-edit" style="width: 100%;">
                                    <i class="fa-solid fa-check"></i>
                                    Confirm
                                </button>
                            </form>
                            <button type="button" class="action-btn action-btn-cancel" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $booking->id }}">
                                <i class="fa-solid fa-xmark"></i>
                                Cancel
                            </button>
                        @elseif(($booking->status ?? 'pending') === 'confirmed')
                            <button type="button" class="action-btn action-btn-cancel" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $booking->id }}">
                                <i class="fa-solid fa-xmark"></i>
                                Cancel
                            </button>
                        @endif
                        @can('manage bookings')
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="action-btn action-btn-edit" style="width: 100%;">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit
                            </a>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block; width: 100%;" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                @csrf
                                @method('DELETE')
                                <button class="action-btn action-btn-delete" style="width: 100%;">
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Cancel Modals --}}
        @foreach($bookings as $booking)
            <div class="modal fade" id="cancelModal{{ $booking->id }}" tabindex="-1" aria-labelledby="cancelModalLabel{{ $booking->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelModalLabel{{ $booking->id }}">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                Cancel Booking
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-3">Are you sure you want to cancel this booking?</p>
                            <div class="mb-2">
                                <strong>Hotel:</strong> {{ $booking->hotel_name ?? ($booking->hotel->name ?? '—') }}
                            </div>
                            <div class="mb-2">
                                <strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}
                            </div>
                            <div class="mb-2">
                                <strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}
                            </div>
                            <div>
                                <strong>Total Price:</strong> <span style="color: #10b981;">${{ number_format($booking->price ?? 0, 2) }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fa-solid fa-xmark me-1"></i>
                                Close
                            </button>
                            <form action="{{ route('userbookings.cancel', $booking->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-ban me-1"></i>
                                    Confirm Cancellation
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
