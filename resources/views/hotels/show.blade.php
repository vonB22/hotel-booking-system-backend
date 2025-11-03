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

    .hotel-hero {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.25rem;
        position: relative;
    }

    .hotel-hero-image {
        width: 100%;
        height: 380px;
        object-fit: cover;
        display: block;
    }

    .hotel-hero-placeholder {
        width: 100%;
        height: 380px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 1rem;
    }

    .hotel-hero-placeholder i {
        font-size: 4rem;
        color: #9ca3af;
    }

    .hotel-hero-placeholder p {
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 600;
        margin: 0;
    }

    .hotel-id-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 8px;
        padding: 0.5rem 0.875rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        z-index: 10;
    }

    .hotel-id-badge i {
        color: #667eea;
        font-size: 0.85rem;
    }

    .hotel-id-text {
        font-size: 0.75rem;
        font-weight: 700;
        color: #667eea;
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

    .hotel-title-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .hotel-name {
        font-size: 1.75rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
        line-height: 1.2;
    }

    .rating-display {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        color: white;
        box-shadow: 0 4px 10px rgba(251, 191, 36, 0.3);
    }

    .rating-stars {
        display: flex;
        gap: 0.125rem;
    }

    .rating-stars i {
        font-size: 0.875rem;
    }

    .rating-number {
        font-weight: 700;
        font-size: 0.875rem;
        border-left: 2px solid rgba(255, 255, 255, 0.3);
        padding-left: 0.5rem;
    }

    .hotel-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #374151;
    }

    .meta-item i {
        font-size: 1rem;
        color: #667eea;
    }

    .meta-item strong {
        color: #111827;
        font-weight: 700;
    }

    .description-text {
        color: #6b7280;
        line-height: 1.7;
        font-size: 0.875rem;
        margin: 0;
    }

    .amenities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.75rem;
    }

    .amenity-badge {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.625rem 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #374151;
        transition: all 0.3s ease;
    }

    .amenity-badge:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(102, 126, 234, 0.15);
    }

    .amenity-badge i {
        color: #10b981;
        font-size: 0.75rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 0.875rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .stat-icon.purple {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .stat-icon.yellow {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
    }

    .stat-icon.green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .stat-content {
        flex: 1;
    }

    .stat-label {
        font-size: 0.7rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        margin-bottom: 0.125rem;
    }

    .stat-value {
        font-size: 1.125rem;
        font-weight: 800;
        color: #111827;
    }

    .no-data-badge {
        background: #fef3c7;
        border: 2px solid #fbbf24;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: #92400e;
        font-weight: 600;
    }

    .no-data-badge i {
        color: #f59e0b;
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

    /* Delete Confirmation Modal Styles */
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

        .hotel-hero-image,
        .hotel-hero-placeholder {
            height: 240px;
        }

        .hotel-name {
            font-size: 1.5rem;
        }

        .hotel-title-section {
            flex-direction: column;
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

        .amenities-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
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
                    <i class="fa-solid fa-hotel"></i>
                    Hotel Details
                </h2>
            </div>
            <a class="back-btn" href="{{ route('hotels.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Hotels
            </a>
        </div>
    </div>

    <!-- Hotel Hero Image -->
    <div class="hotel-hero">
        <div class="hotel-id-badge">
            <i class="fa-solid fa-hashtag"></i>
            <span class="hotel-id-text">ID: {{ $hotel->id }}</span>
        </div>
        
        @if(!empty($hotel->image))
            <img src="{{ asset($hotel->image) }}" alt="{{ $hotel->name }}" class="hotel-hero-image">
        @else
            <div class="hotel-hero-placeholder">
                <i class="fa-solid fa-hotel"></i>
                <p>No Image Available</p>
            </div>
        @endif
    </div>

    <!-- Basic Information -->
    <div class="info-card">
        <div class="info-card-header">
            <h5>
                <i class="fa-solid fa-circle-info"></i>
                Basic Information
            </h5>
        </div>
        <div class="info-card-body">
            <div class="hotel-title-section">
                <h1 class="hotel-name">{{ $hotel->name }}</h1>
                @if(isset($hotel->rating) && $hotel->rating > 0)
                    <div class="rating-display">
                        <div class="rating-stars">
                            @for ($s = 1; $s <= 5; $s++)
                                @if ($s <= $hotel->rating)
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="rating-number">{{ $hotel->rating }}/5</span>
                    </div>
                @endif
            </div>

            <div class="hotel-meta">
                <div class="meta-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>
                        @if(!empty($hotel->location))
                            <strong>{{ $hotel->location }}</strong>
                        @else
                            <span class="text-muted">No location provided</span>
                        @endif
                    </span>
                </div>
                <div class="meta-item">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    <span>
                        @if(isset($hotel->price))
                            <strong>${{ number_format($hotel->price, 2) }}</strong> per night
                        @else
                            <span class="text-muted">Price not set</span>
                        @endif
                    </span>
                </div>
                <div class="meta-item">
                    <i class="fa-solid fa-door-open"></i>
                    <span>
                        @if(isset($hotel->rooms))
                            <strong>{{ $hotel->rooms }}</strong> rooms available
                        @else
                            <span class="text-muted">No room data</span>
                        @endif
                    </span>
                </div>
            </div>

            @if(!empty($hotel->detail))
                <div>
                    <h6 style="font-weight: 700; font-size: 0.875rem; color: #374151; margin-bottom: 0.625rem;">
                        <i class="fa-solid fa-align-left me-2" style="color: #667eea;"></i>
                        Description
                    </h6>
                    <p class="description-text">{{ $hotel->detail }}</p>
                </div>
            @else
                <div class="no-data-badge">
                    <i class="fa-solid fa-info-circle"></i>
                    No description available
                </div>
            @endif
        </div>
    </div>

    <!-- Amenities & Facilities -->
    <div class="info-card">
        <div class="info-card-header">
            <h5>
                <i class="fa-solid fa-list-check"></i>
                Amenities & Facilities
            </h5>
        </div>
        <div class="info-card-body">
            @if(!empty($hotel->amenities))
                @php
                    $amenitiesList = is_array($hotel->amenities)
                        ? $hotel->amenities
                        : explode(',', $hotel->amenities);
                    $amenitiesList = array_map('trim', $amenitiesList);
                    $amenitiesList = array_filter($amenitiesList);
                @endphp
                
                @if(count($amenitiesList) > 0)
                    <div class="amenities-grid">
                        @foreach ($amenitiesList as $amenity)
                            <div class="amenity-badge">
                                @php
                                    $icon = match($amenity) {
                                        'Free Wi-Fi' => 'fa-wifi',
                                        'Swimming Pool', 'Pool' => 'fa-person-swimming',
                                        'Fitness Center', 'Gym' => 'fa-dumbbell',
                                        'Free Parking', 'Parking' => 'fa-square-parking',
                                        'Restaurant' => 'fa-utensils',
                                        'Spa & Wellness', 'Spa' => 'fa-spa',
                                        'Room Service' => 'fa-bell-concierge',
                                        'Bar/Lounge' => 'fa-martini-glass',
                                        'Conference Rooms' => 'fa-building',
                                        'Airport Shuttle' => 'fa-van-shuttle',
                                        'Pet Friendly' => 'fa-paw',
                                        'Laundry Service' => 'fa-shirt',
                                        default => 'fa-check'
                                    };
                                @endphp
                                <i class="fa-solid {{ $icon }}"></i>
                                {{ $amenity }}
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-data-badge">
                        <i class="fa-solid fa-info-circle"></i>
                        No amenities listed
                    </div>
                @endif
            @else
                <div class="no-data-badge">
                    <i class="fa-solid fa-info-circle"></i>
                    No amenities listed
                </div>
            @endif
        </div>
    </div>

    <!-- Hotel Statistics -->
    <div class="info-card">
        <div class="info-card-header">
            <h5>
                <i class="fa-solid fa-chart-simple"></i>
                Hotel Statistics
            </h5>
        </div>
        <div class="info-card-body">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Available Rooms</div>
                        <div class="stat-value">{{ $hotel->rooms ?? 'N/A' }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon yellow">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Star Rating</div>
                        <div class="stat-value">{{ $hotel->rating ?? '0' }} / 5</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Price per Night</div>
                        <div class="stat-value">
                            @if(isset($hotel->price))
                                ${{ number_format($hotel->price, 2) }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="info-card">
        <div class="info-card-body">
            <div class="action-buttons">
                <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit Hotel
                </a>
                <button type="button" class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fa-solid fa-trash-can"></i>
                    Delete Hotel
                </button>
                <a href="{{ route('hotels.index') }}" class="btn-back">
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
                    <strong>Are you sure you want to delete this hotel?</strong>
                </p>
                <p class="mb-2">
                    Hotel: <strong>{{ $hotel->name }}</strong>
                </p>
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
                <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-modal-confirm">
                        <i class="fa-solid fa-trash-can me-1"></i>
                        Delete Hotel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
