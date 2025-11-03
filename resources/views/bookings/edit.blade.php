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

    .page-header p {
        margin: 0.25rem 0 0 0;
        opacity: 0.95;
        font-size: 0.85rem;
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

    .booking-id-badge {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border: 2px solid #667eea;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    .booking-id-badge i {
        color: #667eea;
        font-size: 1rem;
    }

    .booking-id-badge-content {
        flex: 1;
    }

    .booking-id-label {
        font-size: 0.65rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    .booking-id-value {
        font-size: 0.9rem;
        color: #667eea;
        font-weight: 700;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .form-card-header {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .form-card-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-card-body {
        padding: 1.25rem;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.8rem;
        color: #374151;
        margin-bottom: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .form-label i {
        color: #667eea;
        font-size: 0.75rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .form-control::placeholder {
        color: #9ca3af;
        font-size: 0.8rem;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .alert-custom {
        border-radius: 10px;
        border: none;
        padding: 1rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        font-size: 0.85rem;
    }

    .alert-custom strong {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .alert-custom ul {
        margin-bottom: 0;
        padding-left: 1.25rem;
    }

    .alert-custom li {
        margin-bottom: 0.25rem;
        font-size: 0.8rem;
    }

    .btn-submit {
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
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-view {
        background: rgba(59, 130, 246, 0.1);
        border: 2px solid #3b82f6;
        color: #3b82f6;
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

    .btn-view:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .required-indicator {
        color: #ef4444;
        margin-left: 0.125rem;
    }

    .info-badge {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .info-badge i {
        color: #3b82f6;
        font-size: 1rem;
        margin-top: 0.125rem;
    }

    .info-badge-content {
        flex: 1;
    }

    .info-badge-title {
        font-weight: 600;
        font-size: 0.8rem;
        color: #1e40af;
        margin-bottom: 0.25rem;
    }

    .info-badge-text {
        font-size: 0.75rem;
        color: #1e40af;
        margin: 0;
    }

    .status-select {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .status-option {
        position: relative;
    }

    .status-option input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .status-label {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 1rem;
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
        transition: all 0.3s ease;
    }

    .status-label i {
        font-size: 0.75rem;
    }

    .status-option input[type="radio"]:checked + .status-label.confirmed {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%);
        border-color: #10b981;
        color: #059669;
    }

    .status-option input[type="radio"]:checked + .status-label.pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(217, 119, 6, 0.15) 100%);
        border-color: #f59e0b;
        color: #d97706;
    }

    .status-option input[type="radio"]:checked + .status-label.cancelled {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(220, 38, 38, 0.15) 100%);
        border-color: #ef4444;
        color: #dc2626;
    }

    .status-option input[type="radio"]:checked + .status-label.checked-in {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(37, 99, 235, 0.15) 100%);
        border-color: #3b82f6;
        color: #2563eb;
    }

    .status-option input[type="radio"]:checked + .status-label.checked-out {
        background: linear-gradient(135deg, rgba(107, 114, 128, 0.15) 0%, rgba(75, 85, 99, 0.15) 100%);
        border-color: #6b7280;
        color: #4b5563;
    }

    .status-label:hover {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(102, 126, 234, 0.2);
    }

    .date-range-preview {
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.75rem;
        margin-top: 0.5rem;
        display: none;
    }

    .date-range-preview.active {
        display: block;
    }

    .date-range-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: #374151;
    }

    .date-range-info i {
        color: #667eea;
    }

    .nights-count {
        font-weight: 700;
        color: #667eea;
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

        .form-card-body {
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

        .btn-submit,
        .btn-view {
            width: 100%;
            justify-content: center;
        }

        .status-select {
            flex-direction: column;
        }

        .status-label {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .alert-custom {
            padding: 0.875rem;
        }

        .form-control {
            font-size: 0.8rem;
        }
    }
</style>

<div class="container-fluid px-3">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2>
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit Booking
                </h2>
                <p class="mb-0">Update booking information and save your changes</p>
            </div>
            <a class="back-btn" href="{{ route('bookings.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Bookings
            </a>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
            <strong>
                <i class="fa-solid fa-triangle-exclamation"></i>
                Whoops! There were some problems with your input.
            </strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Edit Booking Form -->
    <form method="POST" action="{{ route('bookings.update', $booking->id) }}" id="editBookingForm">
        @csrf
        @method('PUT')

        <!-- Booking ID Badge -->
        <div class="booking-id-badge">
            <i class="fa-solid fa-hashtag"></i>
            <div class="booking-id-badge-content">
                <div class="booking-id-label">Booking ID</div>
                <div class="booking-id-value">#{{ $booking->id }}</div>
            </div>
            @if($booking->user)
            <div class="booking-id-badge-content text-end">
                <div class="booking-id-label">Customer</div>
                <div class="booking-id-value">{{ $booking->user->name }}</div>
            </div>
            @endif
        </div>

        <!-- Hotel Selection -->
        <div class="form-card">
            <div class="form-card-header">
                <h5>
                    <i class="fa-solid fa-hotel"></i>
                    Hotel Information
                </h5>
            </div>
            <div class="form-card-body">
                <div class="info-badge">
                    <i class="fa-solid fa-lightbulb"></i>
                    <div class="info-badge-content">
                        <div class="info-badge-title">Update Hotel</div>
                        <p class="info-badge-text">Change the hotel for this reservation if needed.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label for="product_id" class="form-label">
                            <i class="fa-solid fa-building"></i>
                            Hotel
                        </label>
                        <select name="product_id" id="product_id" class="form-select">
                            <option value="">-- Select Hotel (Optional) --</option>
                            @foreach($hotels as $id => $name)
                                <option value="{{ $id }}" {{ (old('product_id', $booking->product_id) == $id) ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Currently assigned hotel or leave empty
                        </small>
                        @error('product_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Dates & Guests -->
        <div class="form-card">
            <div class="form-card-header">
                <h5>
                    <i class="fa-solid fa-calendar-days"></i>
                    Stay Details
                </h5>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="check_in" class="form-label">
                            <i class="fa-solid fa-calendar-day"></i>
                            Check-in Date
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="check_in" 
                            id="check_in"
                            value="{{ old('check_in', $booking->check_in) }}"
                            class="form-control" 
                            required>
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Guest arrival date
                        </small>
                        @error('check_in')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="check_out" class="form-label">
                            <i class="fa-solid fa-calendar-xmark"></i>
                            Check-out Date
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="check_out" 
                            id="check_out"
                            value="{{ old('check_out', $booking->check_out) }}"
                            class="form-control" 
                            required>
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Guest departure date
                        </small>
                        @error('check_out')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="date-range-preview active" id="dateRangePreview">
                            <div class="date-range-info">
                                <i class="fa-solid fa-moon"></i>
                                <span>Total Stay: <span class="nights-count" id="nightsCount">0</span> night(s)</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="guests" class="form-label">
                            <i class="fa-solid fa-user-group"></i>
                            Number of Guests
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="guests" 
                            id="guests"
                            value="{{ old('guests', $booking->guests) }}"
                            class="form-control" 
                            min="1"
                            max="20"
                            required>
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Total number of people staying
                        </small>
                        @error('guests')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="fa-solid fa-info-circle"></i>
                            Booking Status
                            <span class="required-indicator">*</span>
                        </label>
                        <div class="status-select">
                            <div class="status-option">
                                <input 
                                    type="radio" 
                                    name="status" 
                                    value="pending" 
                                    id="status-pending"
                                    {{ old('status', $booking->status) == 'pending' ? 'checked' : '' }}>
                                <label for="status-pending" class="status-label pending">
                                    <i class="fa-solid fa-clock"></i>
                                    Pending
                                </label>
                            </div>
                            <div class="status-option">
                                <input 
                                    type="radio" 
                                    name="status" 
                                    value="confirmed" 
                                    id="status-confirmed"
                                    {{ old('status', $booking->status) == 'confirmed' ? 'checked' : '' }}>
                                <label for="status-confirmed" class="status-label confirmed">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Confirmed
                                </label>
                            </div>
                            <div class="status-option">
                                <input 
                                    type="radio" 
                                    name="status" 
                                    value="cancelled" 
                                    id="status-cancelled"
                                    {{ old('status', $booking->status) == 'cancelled' ? 'checked' : '' }}>
                                <label for="status-cancelled" class="status-label cancelled">
                                    <i class="fa-solid fa-ban"></i>
                                    Cancelled
                                </label>
                            </div>
                            <div class="status-option">
                                <input 
                                    type="radio" 
                                    name="status" 
                                    value="checked-in" 
                                    id="status-checked-in"
                                    {{ old('status', $booking->status) == 'checked-in' ? 'checked' : '' }}>
                                <label for="status-checked-in" class="status-label checked-in">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    Checked In
                                </label>
                            </div>
                            <div class="status-option">
                                <input 
                                    type="radio" 
                                    name="status" 
                                    value="checked-out" 
                                    id="status-checked-out"
                                    {{ old('status', $booking->status) == 'checked-out' ? 'checked' : '' }}>
                                <label for="status-checked-out" class="status-label checked-out">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    Checked Out
                                </label>
                            </div>
                        </div>
                        <small class="text-muted d-block mt-2" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Update the current booking status
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="form-card">
            <div class="form-card-header">
                <h5>
                    <i class="fa-solid fa-note-sticky"></i>
                    Additional Information
                </h5>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="notes" class="form-label">
                            <i class="fa-solid fa-message"></i>
                            Notes / Special Requests
                        </label>
                        <textarea 
                            class="form-control" 
                            name="notes" 
                            id="notes"
                            rows="4" 
                            placeholder="Add any special requests or notes...">{{ old('notes', $booking->notes) }}</textarea>
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Optional: Special requirements or preferences
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="form-card">
            <div class="form-card-body">
                <div class="d-flex justify-content-end gap-3 flex-wrap">
                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn-view">
                        <i class="fa-solid fa-eye"></i>
                        View Booking
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Update Booking
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Calculate nights between check-in and check-out
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const dateRangePreview = document.getElementById('dateRangePreview');
    const nightsCount = document.getElementById('nightsCount');

    function calculateNights() {
        const checkIn = checkInInput.value;
        const checkOut = checkOutInput.value;

        if (checkIn && checkOut) {
            const checkInDate = new Date(checkIn);
            const checkOutDate = new Date(checkOut);
            const diffTime = checkOutDate - checkInDate;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays > 0) {
                nightsCount.textContent = diffDays;
                dateRangePreview.classList.add('active');
            } else {
                dateRangePreview.classList.remove('active');
            }
        } else {
            dateRangePreview.classList.remove('active');
        }
    }

    checkInInput.addEventListener('change', function() {
        // Update check-out minimum date
        if (this.value) {
            const checkInDate = new Date(this.value);
            checkInDate.setDate(checkInDate.getDate() + 1);
            const minCheckOut = checkInDate.toISOString().split('T')[0];
            checkOutInput.min = minCheckOut;
        }
        calculateNights();
    });

    checkOutInput.addEventListener('change', calculateNights);

    // Form validation
    document.getElementById('editBookingForm').addEventListener('submit', function(e) {
        const checkIn = checkInInput.value;
        const checkOut = checkOutInput.value;
        const guests = document.getElementById('guests').value;

        if (!checkIn) {
            e.preventDefault();
            alert('Please select a check-in date.');
            checkInInput.focus();
            return false;
        }

        if (!checkOut) {
            e.preventDefault();
            alert('Please select a check-out date.');
            checkOutInput.focus();
            return false;
        }

        const checkInDate = new Date(checkIn);
        const checkOutDate = new Date(checkOut);

        if (checkOutDate <= checkInDate) {
            e.preventDefault();
            alert('Check-out date must be after check-in date.');
            checkOutInput.focus();
            return false;
        }

        if (!guests || guests < 1) {
            e.preventDefault();
            alert('Please enter a valid number of guests.');
            document.getElementById('guests').focus();
            return false;
        }
    });

    // Initialize calculation on page load
    window.addEventListener('DOMContentLoaded', calculateNights);
</script>

@endsection
