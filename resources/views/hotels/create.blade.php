@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0">
                <i class="fa-solid fa-hotel me-2"></i> Add New Hotel
            </h2>
            <p class="text-muted small mb-0">Fill in the details below to add a new hotel listing.</p>
        </div>
        <a class="btn btn-outline-secondary btn-sm shadow-sm" href="{{ route('hotels.index') }}">
            <i class="fa fa-arrow-left me-1"></i> Back to Hotels
        </a>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <!-- Hotel Name -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Hotel Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g., Grand Palace Hotel" required>
                    </div>

                    <!-- Location -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="e.g., New York City, USA">
                    </div>

                    <!-- Price per Night -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Price per Night ($)</label>
                        <input type="number" name="price" class="form-control" placeholder="e.g., 120">
                    </div>

                    <!-- Available Rooms -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Available Rooms</label>
                        <input type="number" name="rooms" class="form-control" placeholder="e.g., 25">
                    </div>

                    <!-- Rating -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Star Rating</label>
                        <select name="rating" class="form-select">
                            <option value="">Select rating</option>
                            <option value="1">⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Hotel Description</label>
                        <textarea class="form-control" name="detail" rows="4" placeholder="Describe the hotel, facilities, and nearby attractions..." required></textarea>
                    </div>

                    <!-- Amenities -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Amenities</label>
                        <div class="row">
                            @foreach (['Free Wi-Fi', 'Pool', 'Gym', 'Parking', 'Restaurant', 'Spa'] as $amenity)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity }}">
                                        <label class="form-check-label">{{ $amenity }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Hotel Image</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Upload a photo of the hotel (optional)</small>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save Hotel
                        </button>
                        <button type="reset" class="btn btn-outline-secondary btn-lg px-4 ms-2">
                            <i class="fa-solid fa-rotate-left me-1"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Inline Styling -->
<style>
    label.form-label {
        color: #0d6efd;
    }

    .card {
        transition: box-shadow 0.2s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    }

    textarea, input, select {
        border-radius: 8px !important;
    }

    .form-check-label {
        font-size: 0.9rem;
        color: #555;
    }
</style>
@endsection