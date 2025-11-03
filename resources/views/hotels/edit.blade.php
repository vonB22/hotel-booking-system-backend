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
        min-height: 100px;
    }

    .hotel-id-badge {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border: 2px solid #667eea;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    .hotel-id-badge i {
        color: #667eea;
        font-size: 1rem;
    }

    .hotel-id-badge-content {
        flex: 1;
    }

    .hotel-id-label {
        font-size: 0.65rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    .hotel-id-value {
        font-size: 0.9rem;
        color: #667eea;
        font-weight: 700;
    }

    .amenities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.75rem;
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.875rem;
    }

    .amenity-check {
        padding: 0.5rem 0.75rem;
        background: white;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .amenity-check:hover {
        background: rgba(102, 126, 234, 0.05);
    }

    .form-check-input {
        width: 1.125rem;
        height: 1.125rem;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }

    .form-check-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #374151;
        cursor: pointer;
        margin-left: 0.5rem;
    }

    .current-image-wrapper {
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .current-image-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #6b7280;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .current-image {
        width: 100%;
        max-width: 300px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .image-upload-wrapper {
        position: relative;
        background: #f9fafb;
        border: 2px dashed #e5e7eb;
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .image-upload-wrapper:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    .image-upload-wrapper input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }

    .upload-icon {
        font-size: 2.5rem;
        color: #667eea;
        margin-bottom: 0.75rem;
    }

    .upload-text {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }

    .upload-hint {
        font-size: 0.75rem;
        color: #9ca3af;
    }

    .image-preview {
        margin-top: 1rem;
        display: none;
        border-radius: 8px;
        overflow: hidden;
        max-width: 300px;
        margin-left: auto;
        margin-right: auto;
    }

    .image-preview img {
        width: 100%;
        height: auto;
        display: block;
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

    .rating-select {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .rating-option {
        position: relative;
    }

    .rating-option input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .rating-label {
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

    .rating-option input[type="radio"]:checked + .rating-label {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        border-color: #f59e0b;
        color: white;
    }

    .rating-label:hover {
        border-color: #fbbf24;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(251, 191, 36, 0.2);
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

        .amenities-grid {
            grid-template-columns: 1fr;
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
                    Edit Hotel
                </h2>
                <p class="mb-0">Update hotel information and save your changes</p>
            </div>
            <a class="back-btn" href="{{ route('hotels.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Hotels
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

    <!-- Edit Hotel Form -->
    <form action="{{ route('hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data" id="editHotelForm">
        @csrf
        @method('PUT')

        <!-- Hotel ID Badge -->
        <div class="hotel-id-badge">
            <i class="fa-solid fa-hashtag"></i>
            <div class="hotel-id-badge-content">
                <div class="hotel-id-label">Hotel ID</div>
                <div class="hotel-id-value">#{{ $hotel->id }}</div>
            </div>
        </div>

        <!-- Basic Information -->
        <div class="form-card">
            <div class="form-card-header">
                <h5>
                    <i class="fa-solid fa-circle-info"></i>
                    Basic Information
                </h5>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">
                            <i class="fa-solid fa-hotel"></i>
                            Hotel Name
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            value="{{ old('name', $hotel->name) }}"
                            class="form-control" 
                            placeholder="e.g., Grand Palace Hotel" 
                            required
                            autocomplete="off">
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Enter the official name of the hotel
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label for="location" class="form-label">
                            <i class="fa-solid fa-location-dot"></i>
                            Location
                        </label>
                        <input 
                            type="text" 
                            name="location" 
                            id="location"
                            value="{{ old('location', $hotel->location ?? '') }}"
                            class="form-control" 
                            placeholder="e.g., New York City, USA"
                            autocomplete="off">
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            City, state, or country
                        </small>
                    </div>

                    <div class="col-12">
                        <label for="detail" class="form-label">
                            <i class="fa-solid fa-align-left"></i>
                            Hotel Description
                            <span class="required-indicator">*</span>
                        </label>
                        <textarea 
                            class="form-control" 
                            name="detail" 
                            id="detail"
                            rows="4" 
                            placeholder="Describe the hotel, facilities, and nearby attractions..."
                            required>{{ old('detail', $hotel->detail) }}</textarea>
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Provide a detailed description to attract guests
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing & Availability -->
        <div class="form-card">
            <div class="form-card-header">
                <h5>
                    <i class="fa-solid fa-dollar-sign"></i>
                    Pricing & Availability
                </h5>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="price" class="form-label">
                            <i class="fa-solid fa-money-bill-wave"></i>
                            Price per Night ($)
                        </label>
                        <input 
                            type="number" 
                            name="price" 
                            id="price"
                            value="{{ old('price', $hotel->price ?? '') }}"
                            class="form-control" 
                            placeholder="e.g., 120"
                            min="0"
                            step="0.01">
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Enter the nightly rate in USD
                        </small>
                    </div>

                    <div class="col-md-4">
                        <label for="rooms" class="form-label">
                            <i class="fa-solid fa-door-open"></i>
                            Available Rooms
                        </label>
                        <input 
                            type="number" 
                            name="rooms" 
                            id="rooms"
                            value="{{ old('rooms', $hotel->rooms ?? '') }}"
                            class="form-control" 
                            placeholder="e.g., 25"
                            min="0">
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Total number of bookable rooms
                        </small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">
                            <i class="fa-solid fa-star"></i>
                            Star Rating
                        </label>
                        <div class="rating-select">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="rating-option">
                                    <input 
                                        type="radio" 
                                        name="rating" 
                                        value="{{ $i }}" 
                                        id="rating-{{ $i }}"
                                        {{ old('rating', $hotel->rating ?? '') == $i ? 'checked' : '' }}>
                                    <label for="rating-{{ $i }}" class="rating-label">
                                        @for ($s = 1; $s <= $i; $s++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                    </label>
                                </div>
                            @endfor
                        </div>
                        <small class="text-muted d-block mt-2" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Select the hotel's star rating
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Amenities -->
        <div class="form-card">
            <div class="form-card-header">
                <h5>
                    <i class="fa-solid fa-list-check"></i>
                    Amenities & Facilities
                </h5>
            </div>
            <div class="form-card-body">
                <div class="info-badge">
                    <i class="fa-solid fa-lightbulb"></i>
                    <div class="info-badge-content">
                        <div class="info-badge-title">Update Available Amenities</div>
                        <p class="info-badge-text">Select all the facilities and services your hotel offers to guests.</p>
                    </div>
                </div>

                @php
                    $allAmenities = ['Free Wi-Fi', 'Swimming Pool', 'Fitness Center', 'Free Parking', 'Restaurant', 'Spa & Wellness', 'Room Service', 'Bar/Lounge', 'Conference Rooms', 'Airport Shuttle', 'Pet Friendly', 'Laundry Service'];
                    $selectedAmenities = is_array($hotel->amenities ?? null)
                        ? $hotel->amenities
                        : (is_string($hotel->amenities ?? null) ? explode(',', $hotel->amenities) : []);
                    $selectedAmenities = array_map('trim', $selectedAmenities);
                @endphp

                <div class="amenities-grid">
                    @foreach ($allAmenities as $amenity)
                        <div class="amenity-check form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="amenities[]" 
                                value="{{ $amenity }}" 
                                id="amenity-{{ $loop->index }}"
                                {{ in_array($amenity, $selectedAmenities) || (is_array(old('amenities')) && in_array($amenity, old('amenities'))) ? 'checked' : '' }}>
                            <label class="form-check-label" for="amenity-{{ $loop->index }}">
                                @php
                                    $icon = match($amenity) {
                                        'Free Wi-Fi' => 'fa-wifi',
                                        'Swimming Pool' => 'fa-person-swimming',
                                        'Fitness Center' => 'fa-dumbbell',
                                        'Free Parking' => 'fa-square-parking',
                                        'Restaurant' => 'fa-utensils',
                                        'Spa & Wellness' => 'fa-spa',
                                        'Room Service' => 'fa-bell-concierge',
                                        'Bar/Lounge' => 'fa-martini-glass',
                                        'Conference Rooms' => 'fa-building',
                                        'Airport Shuttle' => 'fa-van-shuttle',
                                        'Pet Friendly' => 'fa-paw',
                                        'Laundry Service' => 'fa-shirt',
                                        default => 'fa-check'
                                    };
                                @endphp
                                <i class="fa-solid {{ $icon }} me-1" style="color: #667eea; font-size: 0.75rem;"></i>
                                {{ $amenity }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Image Upload -->
        <div class="form-card">
            <div class="form-card-header">
                <h5>
                    <i class="fa-solid fa-image"></i>
                    Hotel Image
                </h5>
            </div>
            <div class="form-card-body">
                <div class="info-badge">
                    <i class="fa-solid fa-lightbulb"></i>
                    <div class="info-badge-content">
                        <div class="info-badge-title">Update Hotel Photo</div>
                        <p class="info-badge-text">Upload a new image to replace the current one. Leave empty to keep the existing image.</p>
                    </div>
                </div>

                @if(!empty($hotel->image))
                <div class="current-image-wrapper">
                    <div class="current-image-label">
                        <i class="fa-solid fa-image me-1"></i>
                        Current Image
                    </div>
                    <img src="{{ asset($hotel->image) }}" alt="{{ $hotel->name }}" class="current-image">
                </div>
                @endif

                <div class="image-upload-wrapper">
                    <input type="file" name="image" id="imageInput" accept="image/*">
                    <div class="upload-icon">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>
                    <div class="upload-text">Click to upload a new image</div>
                    <div class="upload-hint">PNG, JPG, WEBP up to 10MB</div>
                </div>

                <div class="image-preview" id="imagePreview">
                    <img src="" alt="New Preview" id="previewImage">
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="form-card">
            <div class="form-card-body">
                <div class="d-flex justify-content-end gap-3 flex-wrap">
                    <a href="{{ route('hotels.show', $hotel->id) }}" class="btn-view">
                        <i class="fa-solid fa-eye"></i>
                        View Hotel
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Update Hotel
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Image preview
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Form validation
    document.getElementById('editHotelForm').addEventListener('submit', function(e) {
        const hotelName = document.getElementById('name').value.trim();
        const description = document.getElementById('detail').value.trim();

        if (!hotelName) {
            e.preventDefault();
            alert('Please enter a hotel name.');
            document.getElementById('name').focus();
            return false;
        }

        if (!description) {
            e.preventDefault();
            alert('Please provide a hotel description.');
            document.getElementById('detail').focus();
            return false;
        }
    });
</script>

@endsection
