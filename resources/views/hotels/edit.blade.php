@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0">
                <i class="fa-solid fa-hotel me-2"></i> Edit Hotel
            </h2>
            <p class="text-muted small mb-0">Update the hotel information and save your changes.</p>
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

    <!-- Edit Form -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <form action="{{ route('hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Hotel Name -->
                        <div class="col-md-6">
                        <label class="form-label fw-semibold">Hotel Name</label>
                        <input type="text" name="name" value="{{ $hotel->name }}" class="form-control" placeholder="e.g., Grand Palace Hotel" required>
                    </div>

                    <!-- Location -->
                        <div class="col-md-6">
                        <label class="form-label fw-semibold">Location</label>
                        <input type="text" name="location" value="{{ old('location', $hotel->location ?? '') }}" class="form-control" placeholder="e.g., Paris, France">
                    </div>

                    <!-- Price per Night -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Price per Night ($)</label>
                        <input type="number" name="price" value="{{ old('price', $hotel->price ?? '') }}" class="form-control" placeholder="e.g., 120">
                    </div>

                    <!-- Available Rooms -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Available Rooms</label>
                        <input type="number" name="rooms" value="{{ old('rooms', $hotel->rooms ?? '') }}" class="form-control" placeholder="e.g., 20">
                    </div>

                    <!-- Rating -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Star Rating</label>
                        <select name="rating" class="form-select">
                            <option value="">Select rating</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ (isset($hotel->rating) && $hotel->rating == $i) ? 'selected' : '' }}>
                                    {{ str_repeat('⭐', $i) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Hotel Description</label>
                        <textarea class="form-control" name="detail" rows="4" placeholder="Describe the hotel...">{{ $hotel->detail }}</textarea>
                    </div>

                    <!-- Amenities -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Amenities</label>
                        <div class="row">
                            @php
                                $amenities = ['Free Wi-Fi', 'Pool', 'Gym', 'Parking', 'Restaurant', 'Spa'];
                                $selectedAmenities = is_array($hotel->amenities ?? null)
                                    ? $hotel->amenities
                                    : explode(',', $hotel->amenities ?? '');
                            @endphp
                            @foreach ($amenities as $amenity)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity }}"
                                               {{ in_array($amenity, $selectedAmenities) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $amenity }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Hotel Image</label>
                        <input type="file" name="image" class="form-control mb-2">
                        @if (!empty($hotel->image))
                            <img src="{{ asset($hotel->image) }}" alt="Hotel Image" class="rounded mt-2" width="160">
                        @endif
                        <small class="text-muted d-block mt-1">Upload a new image to replace the current one (optional).</small>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save Changes
                        </button>
                        <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-outline-info btn-lg px-4 ms-2">
                            <i class="fa-solid fa-eye me-1"></i> View Hotel
                        </a>
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
