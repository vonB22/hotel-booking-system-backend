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
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
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

    .back-btn {
        background: white;
        color: #667eea;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .back-btn:hover {
        background: #f8f9fa;
        color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .booking-hero {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.25rem;
        position: relative;
    }

    .booking-hero-header {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 1.5rem;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .booking-id-section {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .booking-id-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .booking-id-badge i {
        font-size: 1.125rem;
    }

    .booking-id-text {
        font-weight: 700;
        font-size: 1rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .status-badge i {
        font-size: 0.875rem;
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

    .info-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .info-card-header {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .info-card-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-card-header i {
        color: #667eea;
    }

    .info-card-body {
        padding: 1.25rem;
    }

    .user-info-display {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .user-avatar-large {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.25rem;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .user-details-large {
        flex: 1;
    }

    .user-name-large {
        font-size: 1.125rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.25rem;
    }

    .user-email-large {
        font-size: 0.875rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .hotel-info-display {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
    }

    .hotel-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }

    .hotel-details {
        flex: 1;
    }

    .hotel-name {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.25rem;
    }

    .hotel-meta {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .date-range-display {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        gap: 1rem;
        align-items: center;
        padding: 1.25rem;
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        border-radius: 10px;
    }

    .date-box {
        text-align: center;
    }

    .date-label {
        font-size: 0.65rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        margin-bottom: 0.375rem;
    }

    .date-value {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.25rem;
    }

    .date-icon {
        color: #667eea;
        font-size: 0.875rem;
    }

    .date-arrow {
        text-align: center;
        color: #667eea;
        font-size: 1.25rem;
    }

    .nights-display {
        text-align: center;
        padding: 0.75rem;
        background: rgba(102, 126, 234, 0.1);
        border-radius: 8px;
        margin-top: 1rem;
    }

    .nights-label {
        font-size: 0.75rem;
        color: #667eea;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
    }

    .nights-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #667eea;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .info-item {
        padding: 1rem;
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    }

    .info-item-label {
        font-size: 0.7rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .info-item-label i {
        color: #667eea;
    }

    .info-item-value {
        font-size: 1.125rem;
        font-weight: 700;
        color: #111827;
    }

    .notes-display {
        padding: 1rem;
        background: #fffbeb;
        border: 2px solid #fbbf24;
        border-left: 4px solid #f59e0b;
        border-radius: 10px;
        color: #92400e;
        font-size: 0.875rem;
        line-height: 1.6;
        white-space: pre-wrap;
    }

    .no-notes {
        padding: 1rem;
        background: #f9fafb;
        border: 2px dashed #e5e7eb;
        border-radius: 10px;
        text-align: center;
        color: #9ca3af;
        font-style: italic;
        font-size: 0.875rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        border: 2px solid #ef4444;
        color: #ef4444;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-back {
        background: rgba(107, 114, 128, 0.1);
        border: 2px solid #6b7280;
        color: #6b7280;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-back:hover {
        background: #6b7280;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
    }

    .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border-bottom: none;
        padding: 1.25rem;
        border-radius: 12px 12px 0 0;
    }

    .modal-header h5 {
        font-weight: 700;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-body p {
        color: #374151;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .modal-footer {
        border-top: 2px solid #f3f4f6;
        padding: 1rem 1.5rem;
    }

    .btn-modal-cancel {
        background: rgba(107, 114, 128, 0.1);
        border: 2px solid #6b7280;
        color: #6b7280;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .btn-modal-cancel:hover {
        background: #6b7280;
        color: white;
    }

    .btn-modal-confirm {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-modal-confirm:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 1rem;
        }

        .page-header h2 {
            font-size: 1.25rem;
        }

        .booking-hero-header {
            padding: 1rem;
        }

        .info-card-body {
            padding: 1rem;
        }

        .page-header .d-flex {
            flex-direction: column;
            gap: 0.75rem;
        }

        .back-btn {
            width: 100%;
            justify-content: center;
        }

        .action-buttons {
            width: 100%;
        }

        .btn-edit,
        .btn-delete,
        .btn-back {
            flex: 1;
            justify-content: center;
        }

        .date-range-display {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .date-arrow {
            transform: rotate(90deg);
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-fluid px-3">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2>
                    <i class="fa-solid fa-calendar-check"></i>
                    Booking Details
                </h2>
            </div>
            <a class="back-btn" href="{{ route('bookings.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Bookings
            </a>
        </div>
    </div>

    <!-- Booking Hero -->
    <div class="booking-hero">
        <div class="booking-hero-header">
            <div class="booking-id-section">
                <div class="booking-id-badge">
                    <i class="fa-solid fa-hashtag"></i>
                    <span class="booking-id-text">Booking #{{ $booking->id }}</span>
                </div>
            </div>
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
            <span class="status-badge {{ $statusClass }}">
                <i class="fa-solid {{ $statusIcon }}"></i>
                {{ ucfirst($booking->status) }}
            </span>
        </div>
    </div>

    <!-- Customer Information -->
    <div class="info-card">
        <div class="info-card-header">
            <h5>
                <i class="fa-solid fa-user"></i>
                Customer Information
            </h5>
        </div>
        <div class="info-card-body">
            @if($booking->user)
            <div class="user-info-display">
                <div class="user-avatar-large">
                    {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                </div>
                <div class="user-details-large">
                    <div class="user-name-large">{{ $booking->user->name }}</div>
                    <div class="user-email-large">
                        <i class="fa-solid fa-envelope"></i>
                        {{ $booking->user->email }}
                    </div>
                </div>
            </div>
            @else
            <div class="no-notes">
                <i class="fa-solid fa-user-slash me-2"></i>
                No customer information available
            </div>
            @endif
        </div>
    </div>

    <!-- Hotel Information -->
    <div class="info-card">
        <div class="info-card-header">
            <h5>
                <i class="fa-solid fa-hotel"></i>
                Hotel Information
            </h5>
        </div>
        <div class="info-card-body">
            @if($booking->product)
            <div class="hotel-info-display">
                <div class="hotel-icon">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div class="hotel-details">
                    <div class="hotel-name">{{ $booking->product->name }}</div>
                    <div class="hotel-meta">
                        @if(!empty($booking->product->location))
                            <i class="fa-solid fa-location-dot me-1"></i>
                            {{ $booking->product->location }}
                        @endif
                        @if(!empty($booking->product->price))
                            <span class="mx-2">•</span>
                            <i class="fa-solid fa-dollar-sign me-1"></i>
                            ${{ number_format($booking->product->price, 2) }}/night
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="no-notes">
                <i class="fa-solid fa-hotel me-2"></i>
                No hotel assigned to this booking
            </div>
            @endif
        </div>
    </div>

    <!-- Stay Details -->
    <div class="info-card">
        <div class="info-card-header">
            <h5>
                <i class="fa-solid fa-calendar-days"></i>
                Stay Details
            </h5>
        </div>
        <div class="info-card-body">
            <div class="date-range-display">
                <div class="date-box">
                    <div class="date-label">
                        <i class="fa-solid fa-calendar-day date-icon"></i>
                        Check-in
                    </div>
                    <div class="date-value">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</div>
                    <div style="font-size: 0.75rem; color: #6b7280;">
                        {{ \Carbon\Carbon::parse($booking->check_in)->format('l') }}
                    </div>
                </div>
                <div class="date-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div class="date-box">
                    <div class="date-label">
                        <i class="fa-solid fa-calendar-xmark date-icon"></i>
                        Check-out
                    </div>
                    <div class="date-value">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</div>
                    <div style="font-size: 0.75rem; color: #6b7280;">
                        {{ \Carbon\Carbon::parse($booking->check_out)->format('l') }}
                    </div>
                </div>
            </div>

            @php
                $checkIn = \Carbon\Carbon::parse($booking->check_in);
                $checkOut = \Carbon\Carbon::parse($booking->check_out);
                $nights = $checkIn->diffInDays($checkOut);
            @endphp

            <div class="nights-display">
                <div class="nights-label">
                    <i class="fa-solid fa-moon"></i>
                    Total Stay
                </div>
                <div class="nights-value">{{ $nights }} Night{{ $nights != 1 ? 's' : '' }}</div>
            </div>

            <div class="info-grid" style="margin-top: 1rem;">
                <div class="info-item">
                    <div class="info-item-label">
                        <i class="fa-solid fa-user-group"></i>
                        Number of Guests
                    </div>
                    <div class="info-item-value">{{ $booking->guests }} Guest{{ $booking->guests != 1 ? 's' : '' }}</div>
                </div>
                @if($booking->product && !empty($booking->product->price))
                <div class="info-item">
                    <div class="info-item-label">
                        <i class="fa-solid fa-calculator"></i>
                        Estimated Total
                    </div>
                    <div class="info-item-value">${{ number_format($booking->product->price * $nights, 2) }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Notes & Special Requests -->
    <div class="info-card">
        <div class="info-card-header">
            <h5>
                <i class="fa-solid fa-note-sticky"></i>
                Notes & Special Requests
            </h5>
        </div>
        <div class="info-card-body">
            @if(!empty($booking->notes))
            <div class="notes-display">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; font-weight: 700;">
                    <i class="fa-solid fa-message"></i>
                    Special Requests:
                </div>
                {{ $booking->notes }}
            </div>
            @else
            <div class="no-notes">
                <i class="fa-solid fa-message-slash me-2"></i>
                No special requests or notes for this booking
            </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="info-card">
        <div class="info-card-body">
            <div class="action-buttons">
                @if(auth()->user()->hasRole('Admin') || auth()->id() === $booking->user_id)
                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit Booking
                </a>
                <button type="button" class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fa-solid fa-trash-can"></i>
                    Delete Booking
                </button>
                @endif
                <a href="{{ route('bookings.index') }}" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">
                    <strong>Are you sure you want to delete this booking?</strong>
                </p>
                <p class="mb-2">
                    Booking ID: <strong>#{{ $booking->id }}</strong>
                </p>
                <p class="mb-2">
                    Customer: <strong>{{ $booking->user->name ?? 'Unknown' }}</strong>
                </p>
                @if($booking->product)
                <p class="mb-2">
                    Hotel: <strong>{{ $booking->product->name }}</strong>
                </p>
                @endif
                <p class="mb-0 text-danger">
                    <i class="fa-solid fa-exclamation-triangle me-1"></i>
                    This action cannot be undone!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark me-1"></i>
                    Cancel
                </button>
                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-modal-confirm">
                        <i class="fa-solid fa-trash-can me-1"></i>
                        Delete Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
