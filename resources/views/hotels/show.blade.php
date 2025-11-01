@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">
            <i class="fa-solid fa-hotel me-2"></i> Hotel Details
        </h2>
        <a class="btn btn-outline-secondary btn-sm shadow-sm" href="{{ route('hotels.index') }}">
            <i class="fa fa-arrow-left me-1"></i> Back to Hotels
        </a>
    </div>

    <!-- Hotel Details Card -->
    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
        @if(!empty($hotel->image))
            <img src="{{ asset($hotel->image) }}" class="card-img-top" alt="{{ $hotel->name }}" style="object-fit: cover; height: 320px;">
        @else
            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 320px;">
                <i class="fa-solid fa-hotel fa-4x text-muted"></i>
            </div>
        @endif

        <div class="card-body p-4">
            <!-- Hotel Name and Rating -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                <h3 class="fw-bold mb-0 text-dark">{{ $hotel->name }}</h3>
                @if(!empty($hotel->rating))
                    <div>
                        <span class="badge bg-warning text-dark">
                            {{ str_repeat('⭐', $hotel->rating) }}
                        </span>
                    </div>
                @endif
            </div>

            <!-- Location and Price -->
            <div class="mb-3 text-muted small">
                <i class="fa-solid fa-location-dot text-primary me-1"></i>
                {{ $hotel->location ?? 'No location provided' }}
                <span class="mx-2">|</span>
                <i class="fa-solid fa-dollar-sign text-success me-1"></i>
                <strong>{{ $hotel->price ?? 'N/A' }}</strong> per night
            </div>

            <!-- Hotel Description -->
            <div class="mb-4">
                <h6 class="fw-semibold text-primary">Description</h6>
                <p class="text-muted mb-0">{{ $hotel->detail ?? 'No details available.' }}</p>
            </div>

            <!-- Amenities -->
            @if(!empty($hotel->amenities))
                @php
                    $amenities = is_array($hotel->amenities)
                        ? $hotel->amenities
                        : explode(',', $hotel->amenities);
                @endphp
                <div class="mb-4">
                    <h6 class="fw-semibold text-primary">Amenities</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($amenities as $amenity)
                            <span class="badge bg-light text-dark border">
                                <i class="fa-solid fa-check text-success me-1"></i> {{ trim($amenity) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Hotel Stats -->
            <div class="mb-4">
                <h6 class="fw-semibold text-primary">Hotel Info</h6>
                <ul class="list-unstyled text-muted mb-0">
                    <li><i class="fa-solid fa-bed me-2 text-primary"></i> Available Rooms: {{ $hotel->rooms ?? 'N/A' }}</li>
                    <li><i class="fa-solid fa-star me-2 text-warning"></i> Rating: {{ $hotel->rating ?? 'N/A' }} / 5</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-primary btn-lg px-4 shadow-sm me-2">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit Hotel
                </a>
                <a href="{{ route('hotels.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Inline Styling -->
<style>
    .card {
        transition: box-shadow 0.2s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    }

    .badge {
        font-size: 0.9rem;
        border-radius: 8px;
    }

    p, li {
        line-height: 1.6;
    }
</style>
@endsection
