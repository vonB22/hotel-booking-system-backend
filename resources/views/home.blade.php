@extends('layouts.app')

@section('content')
<style>
    html {
        scroll-behavior: smooth;
    }
    /* Base Styles */
    body {
        font-family: 'Poppins', sans-serif;
        color: #333;
    }
    
    main {
        padding-top: 0 !important;
    }
    
    /* section {
        padding: 0 !important;
    } */

    /* Hero Section */
    .hero {
        background: url("{{ asset('img/hero.jpg') }}") center/cover no-repeat;
        height: 100vh;
        width: 100vw;
        margin-left: calc(50% - 50vw);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #fff;
        text-align: left;
        position: relative;
        animation: fadeIn 0.8s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { 
            opacity: 0;
            transform: translateY(30px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes scaleIn {
        from { 
            opacity: 0;
            transform: scale(0.9);
        }
        to { 
            opacity: 1;
            transform: scale(1);
        }
    }

    .hero-content {
        position: relative;
        z-index: 1;
        animation: slideUp 0.6s ease-out;
        max-width: 800px;
    }

    .hero h1 {
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .hero p {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.95;
    }

    /* Trust Badge */
    .trust-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        padding: 8px 16px;
        margin-bottom: 1.5rem;
        animation: scaleIn 0.6s ease-out 0.3s both;
    }

    .trust-badge .avatar-group {
        display: flex;
        margin-left: -8px;
    }

    .trust-badge .avatar-group img {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid white;
        margin-left: -8px;
        object-fit: cover;
    }

    .trust-badge span {
        font-size: 0.875rem;
        color: white;
    }

    /* Hero Buttons */
    .hero-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 3rem;
    }

    .btn-hero-primary {
        background: white;
        color: black;
        border: none;
        padding: 12px 32px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-hero-primary:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-hero-secondary {
        background: transparent;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 12px 32px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-hero-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: white;
        transform: translateY(-2px);
    }

    /* Search Box */
    .search-box {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.6s ease-out 0.5s both;
    }

    .search-box label {
        color: #666;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
    }

    .search-box .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 12px;
    }

    .search-box .btn-search {
        background: #007bff;
        border: none;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .search-box .btn-search:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    /* Section Headers */
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #222;
    }

    .section-header p {
        color: #666;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Featured Section */
    .featured-section {
        padding: 5rem 0;
        background: #f8f9fa;
    }

    /* Hotel Cards */
    .hotel-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        background: white;
    }

    .hotel-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .hotel-card-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 240px;
    }

    .hotel-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .hotel-card:hover img {
        transform: scale(1.1);
    }

    .hotel-card .badge-featured {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #007bff;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 1;
    }

    .hotel-card .rating-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255, 193, 7, 0.95);
        color: white;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .hotel-card-body {
        padding: 1.5rem;
    }

    .hotel-card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #222;
    }

    .hotel-location {
        color: #666;
        font-size: 0.875rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .hotel-price {
        font-size: 1.75rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 0.25rem;
    }

    .hotel-price-label {
        color: #999;
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .hotel-reviews {
        color: #999;
        font-size: 0.75rem;
        margin-top: 0.5rem;
    }

    /* Reviews Section */
    .reviews-section {
        background: white;
        padding: 5rem 0;
    }

    .review-card {
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid #f0f0f0;
    }

    .review-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .review-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .review-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #f0f0f0;
    }

    .review-author {
        flex: 1;
    }

    .review-author-name {
        font-weight: 600;
        color: #222;
        margin-bottom: 2px;
    }

    .review-date {
        color: #999;
        font-size: 0.875rem;
    }

    .review-rating {
        color: #ffc107;
        font-size: 1rem;
    }

    .review-title {
        font-weight: 600;
        color: #222;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .review-text {
        color: #666;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Newsletter Section */
    .newsletter-section {
        background: #f8f9fa;
        padding: 4rem 0;
    }

    .newsletter-box {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .newsletter-form {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .newsletter-form input {
        flex: 1;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 12px 16px;
    }

    .newsletter-form button {
        background: #222;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 32px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .newsletter-form button:hover {
        background: #000;
        transform: translateY(-2px);
    }

    /* About Section */
    .about-section {
        padding: 5rem 0;
        background: white;
    }

    .feature-card {
        text-align: center;
        padding: 2rem 1rem;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }

    .feature-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: rgba(0, 123, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        background: rgba(0, 123, 255, 0.2);
        transform: scale(1.1);
    }

    .feature-icon svg {
        width: 32px;
        height: 32px;
        color: #007bff;
    }

    .feature-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #222;
    }

    .feature-description {
        color: #666;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Contact Section */
    .contact-section {
        padding: 5rem 0;
        background: #f8f9fa;
    }

    .contact-info-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
    }

    .contact-info-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        transform: translateY(-5px);
    }

    .contact-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(0, 123, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .contact-icon svg {
        width: 24px;
        height: 24px;
        color: #007bff;
    }

    .contact-form {
        background: white;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
    }

    /* Footer */
    footer {
        background: #1a1a1a;
        color: #bbb;
        padding: 2rem 0 1rem;
        width: 100vw;
        margin-left: calc(50% - 50vw);
        box-sizing: border-box;
    }

    footer h5 {
        color: white;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    footer a {
        color: #bbb;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    footer a:hover {
        color: white;
    }

    footer ul {
        list-style: none;
        padding: 0;
    }

    footer ul li {
        margin-bottom: 0.5rem;
    }

    .social-icons {
        display: flex;
        gap: 1rem;
    }

    .social-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .footer-bottom {
        border-top: 1px solid #333;
        margin-top: 0;
        padding-top: 1rem;
        text-align: center;
        color: #888;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 12px;
        border: none;
    }

    .modal-header {
        border-bottom: 1px solid #f0f0f0;
        padding: 1.5rem;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        border-top: 1px solid #f0f0f0;
        padding: 1.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.5rem;
        }
        
        .hero p {
            font-size: 1rem;
        }

        .hero-buttons {
            flex-direction: column;
        }

        .search-box {
            padding: 1rem;
        }

        .section-header h2 {
            font-size: 2rem;
        }

        .newsletter-form {
            flex-direction: column;
        }
        .footer {
            width: 100%;
            background-color: #222;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .footer .container-fluid {
            padding-top: 2rem;
            padding-bottom: 1rem;
        }

        .footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer ul li {
            margin-bottom: 0.5rem;
        }

        .footer ul li a {
            color: #ddd;
            text-decoration: none;
        }

        .footer ul li a:hover {
            color: #fff;
        }

        .footer .social-icon {
            color: #ddd;
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .footer .social-icon:hover {
            color: #fff;
        }

        .footer-bottom {
            border-top: 1px solid #444;
            padding-top: 1rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-content container">
        <!-- Trust Badge -->
        <div class="trust-badge">
            <div class="avatar-group">
                <img src="https://images.unsplash.com/photo-1711113456507-c88b3777bc12?w=100" alt="Traveler">
                <img src="https://images.unsplash.com/photo-1672685667592-0392f458f46f?w=100" alt="Traveler">
                <img src="https://images.unsplash.com/photo-1669689290695-7f0efe5d4c8e?w=100" alt="Traveler">
            </div>
            <span>Trusted by 1M+ travelers</span>
        </div>

        <h1>Stay. Relax. Book<br>with ease.</h1>
        <p>Discover handpicked hotels, best rates, and instant booking for your perfect stay</p>

        <!-- Hero Buttons -->
        <div class="hero-buttons">
            <a href="#hotels" class="btn btn-hero-primary">Browse Hotels</a>
            <a href="#hotels" class="btn btn-hero-secondary">
                <i class="bi bi-eye me-2"></i> View Special Offers
            </a>
        </div>
    </div>
</section>

<!-- Booking Search -->
<section style="background: white; padding: 4rem 0 !important;">
    <div class="container">
        <div class="search-box">
            <form class="row g-3">
                <div class="col-md-3">
                    <label>Destination</label>
                    <select class="form-control">
                        <option value="">Select Country</option>
                        <option>United States</option>
                        <option>France</option>
                        <option>Italy</option>
                        <option>Spain</option>
                        <option>Japan</option>
                        <option>Thailand</option>
                        <option>Maldives</option>
                        <option>Dubai</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Check-in</label>
                    <input type="date" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label>Check-out</label>
                    <input type="date" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label>Guests</label>
                    <input type="number" class="form-control" min="1" value="2">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 btn-search">
                        <i class="bi bi-search me-2"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Featured Hotels -->
<section class="featured-section" id="hotels">
    <div class="container">
        <div class="section-header">
            <h2>Featured Hotels</h2>
            <p>Discover our handpicked selection of luxury hotels and resorts from around the world</p>
        </div>

        <div class="row">
            @php
                // If controller passed hotels, use them. Otherwise fetch latest hotels.
                $hotels = isset($hotels) ? $hotels : \App\Models\Hotel::latest()->take(6)->get();
            @endphp

            @forelse($hotels as $hotel)
            @php
                $image = $hotel->image ? asset($hotel->image) : 'https://via.placeholder.com/600x400?text=' . urlencode($hotel->name);
                $price = isset($hotel->price) ? number_format($hotel->price, 2) : '0.00';
                $location = $hotel->location ?? '';
            @endphp
            <div class="col-md-4 mb-4">
                <div class="card hotel-card">
                    <div class="hotel-card-img-wrapper">
                        <img src="{{ $image }}" alt="{{ $hotel->name }}">
                        @if(method_exists($hotel, 'featured') && $hotel->featured)
                        <span class="badge-featured">Featured</span>
                        @endif
                        <div class="rating-badge">
                            <i class="bi bi-star-fill"></i>
                            {{-- rating is optional --}}
                        </div>
                    </div>
                    <div class="hotel-card-body">
                        <h5 class="hotel-card-title">{{ $hotel->name }}</h5>
                        <div class="hotel-location">
                            <i class="bi bi-geo-alt"></i>
                            {{ $location }}
                        </div>
                        <div class="hotel-price">${{ $price }}</div>
                        <div class="hotel-price-label">per night</div>
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#bookingModal" 
                                onclick="setHotelData('{{ addslashes($hotel->name) }}', {{ $hotel->price ?? 0 }}, '{{ $image }}', {{ $hotel->id }})">
                            Book Now
                        </button>
                        <div class="hotel-reviews">&nbsp;</div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">No hotels available right now. Please check back later.</div>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-outline-primary btn-lg">View All Hotels</button>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="reviews-section">
    <div class="container">
        <div class="section-header">
            <h2>What Our Guests Say</h2>
            <p>Read authentic reviews from travelers who stayed at our featured hotels</p>
        </div>

        <div class="row">
            @php
            $reviews = [
                [
                    'name' => 'Maria D. Travellers',
                    'avatar' => 'https://images.unsplash.com/photo-1711113456507-c88b3777bc12?w=100',
                    'rating' => 5,
                    'date' => 'Mar 14, 2025',
                    'title' => 'Amazing Stay',
                    'comment' => 'Comfortable bed and tasty breakfast! The hotel exceeded all my expectations. The staff was incredibly friendly and helpful.'
                ],
                [
                    'name' => 'John M. Business',
                    'avatar' => 'https://images.unsplash.com/photo-1672685667592-0392f458f46f?w=100',
                    'rating' => 4,
                    'date' => 'Mar 12, 2025',
                    'title' => 'Great Value',
                    'comment' => 'Perfect location and excellent service. Would definitely recommend to other business travelers looking for quality accommodation.'
                ],
                [
                    'name' => 'Sarah K. Explorer',
                    'avatar' => 'https://images.unsplash.com/photo-1669689290695-7f0efe5d4c8e?w=100',
                    'rating' => 5,
                    'date' => 'Mar 10, 2025',
                    'title' => 'Exceptional Service',
                    'comment' => 'The staff went above and beyond to make our stay memorable. Beautiful rooms and amazing amenities throughout the property.'
                ],
            ];
            @endphp

            @foreach($reviews as $review)
            <div class="col-md-4 mb-4">
                <div class="review-card">
                    <div class="review-header">
                        <img src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}" class="review-avatar">
                        <div class="review-author">
                            <div class="review-author-name">{{ $review['name'] }}</div>
                            <div class="review-date">{{ $review['date'] }}</div>
                        </div>
                        <div class="review-rating">
                            @for($i = 0; $i < $review['rating']; $i++)
                            <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>
                    </div>
                    <h6 class="review-title">{{ $review['title'] }}</h6>
                    <p class="review-text">{{ $review['comment'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-outline-primary btn-lg">View All Reviews</button>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-box">
            <h2 style="font-weight: 700; margin-bottom: 1rem;">Stay Updated with StayEase</h2>
            <p style="color: #666; font-size: 0.95rem;">Subscribe to receive exclusive hotel deals, travel guides, and special offers straight to your inbox</p>
            
            <form class="newsletter-form">
                <input type="email" class="form-control" placeholder="Enter your email" required>
                <button type="submit" class="btn">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section" id="about">
    <div class="container">
        <div class="section-header">
            <h2>ABOUT US</h2>
            <p>Why travelers worldwide trust StayEase for their perfect accommodations</p>
        </div>

        <div class="row">
            @php
            $features = [
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />',
                    'title' => 'Safe',
                    'description' => 'Secure booking and payment processing with industry-leading encryption'
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />',
                    'title' => 'Quality',
                    'description' => 'Handpicked hotels verified for excellence and customer satisfaction'
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                    'title' => 'Fast',
                    'description' => 'Instant confirmation and quick booking process in just minutes'
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />',
                    'title' => '24/7',
                    'description' => 'Round-the-clock customer support whenever you need assistance'
                ],
            ];
            @endphp

            @foreach($features as $feature)
            <div class="col-md-3 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $feature['icon'] !!}
                        </svg>
                    </div>
                    <h5 class="feature-title">{{ $feature['title'] }}</h5>
                    <p class="feature-description">{{ $feature['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section" id="contact">
    <div class="container">
        <div class="section-header">
            <h2>Get in Touch</h2>
            <p>Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>

        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="contact-info-card">
                    <div class="contact-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h5>Phone</h5>
                    <p class="mb-1">+1 (555) 123-4567</p>
                    <small class="text-muted">Mon-Fri 9am-6pm EST</small>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="contact-info-card">
                    <div class="contact-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h5>Email</h5>
                    <p class="mb-1">support@stayease.com</p>
                    <small class="text-muted">24/7 support available</small>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="contact-info-card">
                    <div class="contact-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h5>Office</h5>
                    <p class="mb-1">123 Travel Street</p>
                    <small class="text-muted">New York, NY 10001</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="contact-form">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="Your name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="your.email@example.com" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" class="form-control" placeholder="How can we help?" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="5" placeholder="Tell us more about your inquiry..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-send me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container-fluid px-5 py-3">
        <div class="row text-light">
            <div class="col-md-3 mb-4">
                <h5>StayEase</h5>
                <p class="mb-3" style="font-size: 0.9rem;">Your trusted partner for finding the perfect accommodation worldwide.</p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Company</h5>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Support</h5>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Safety Information</a></li>
                    <li><a href="#">Cancellation Options</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Resources</h5>
                <ul>
                    <li><a href="#">List Your Property</a></li>
                    <li><a href="#">Partnerships</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom text-center mt-3">
            <p class="mb-0">&copy; {{ date('Y') }} StayEase. All rights reserved.</p>
        </div>
    </div>
</footer>


<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Book Your Stay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="modalHotelImage" src="" alt="Hotel" class="img-fluid rounded" style="height: 300px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <h4 id="modalHotelName" class="mb-3"></h4>
                        <div class="mb-4">
                            <span class="badge bg-success">Top Pick</span>
                        </div>
                        <div class="mb-4">
                            <div style="font-size: 2rem; font-weight: 700;">$<span id="modalHotelPrice"></span></div>
                            <small class="text-muted">per night</small>
                        </div>
                        @auth
                        <form action="{{ route('bookings.store') }}" method="POST" id="landingBookingForm">
                            @csrf
                            <input type="hidden" name="product_id" id="modalProductId" value="">
                            <input type="hidden" name="product_name" id="modalProductName" value="">
                            <input type="hidden" name="price" id="modalProductPriceInput" value="">
                            <input type="hidden" name="hotel_id" id="modalHotelId" value="">
                            <input type="hidden" name="hotel_name" id="modalHotelNameInput" value="">
                            <input type="hidden" name="guests" id="modalGuests" value="2">
                            <div class="mb-3">
                                <label class="form-label">Check-in</label>
                                <input type="date" name="check_in" id="modalCheckIn" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Check-out</label>
                                <input type="date" name="check_out" id="modalCheckOut" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Adults</label>
                                <input type="number" id="modalAdults" class="form-control" min="1" value="2">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kids</label>
                                <input type="number" id="modalKids" class="form-control" min="0" value="0">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Notes (optional)</label>
                                <textarea name="notes" id="modalNotes" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btn-lg">Book Now</button>
                        </form>
                        @else
                        <div class="mb-3">
                            <div class="alert alert-info">Please sign in to complete a booking.</div>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#authModal">Sign in / Register</button>
                        </div>
                        @endauth
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Auth Modal -->
<div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="authModalTitle">Welcome Back</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="you@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign In</button>
                </form>
                <div class="text-center mt-3">
                    <small>Don't have an account? <a href="#" onclick="switchToRegister()">Sign up</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Set hotel data in booking modal
    function setHotelData(name, price, image, id) {
        document.getElementById('modalHotelName').textContent = name;
        document.getElementById('modalHotelPrice').textContent = price;
        document.getElementById('modalHotelImage').src = image;
        // populate hidden inputs for booking submission
        const pid = id || '';
        const pname = name;
        const pprice = price;
        const prodIdInput = document.getElementById('modalProductId');
        const prodNameInput = document.getElementById('modalProductName');
        const prodPriceInput = document.getElementById('modalProductPriceInput');
        const hotelIdInput = document.getElementById('modalHotelId');
        const hotelNameInput = document.getElementById('modalHotelNameInput');
        if (prodIdInput) prodIdInput.value = pid;
        if (prodNameInput) prodNameInput.value = pname;
        if (prodPriceInput) prodPriceInput.value = pprice;
        if (hotelIdInput) hotelIdInput.value = pid;
        if (hotelNameInput) hotelNameInput.value = pname;
    }

    // ensure guests hidden input is set before submit
    document.addEventListener('DOMContentLoaded', function(){
        const form = document.getElementById('landingBookingForm');
        if (!form) return;
        form.addEventListener('submit', function(e){
            const adults = parseInt(document.getElementById('modalAdults')?.value || '0', 10);
            const kids = parseInt(document.getElementById('modalKids')?.value || '0', 10);
            const guests = Math.max(1, (isNaN(adults) ? 0 : adults) + (isNaN(kids) ? 0 : kids));
            const guestsInput = document.getElementById('modalGuests');
            if (guestsInput) guestsInput.value = guests;
            // allow form to submit normally (will require auth)
        });
    });

    // Switch to register form
    function switchToRegister() {
        document.getElementById('authModalTitle').textContent = 'Create Account';
        // Add register form logic here
    }

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
@endsection
