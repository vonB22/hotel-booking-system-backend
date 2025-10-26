@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        color: #333;
    }
    .hero {
        background: url('https://images.unsplash.com/photo-1501117716987-c8e1ecb210a0?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
        height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #fff;
        text-align: center;
        position: relative;
    }
    .hero::after {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
    }
    .hero-content {
        position: relative;
        z-index: 1;
    }
    .hero h1 {
        font-size: 3rem;
        font-weight: 700;
    }
    .search-box {
        background: #fff;
        border-radius: 10px;
        padding: 1rem;
        margin-top: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .featured-section {
        padding: 4rem 0;
    }
    .featured-section h2 {
        text-align: center;
        margin-bottom: 2rem;
        font-weight: 600;
    }
    .hotel-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .hotel-card:hover {
        transform: translateY(-5px);
    }
    .hotel-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .reviews-section {
        background: #f9f9f9;
        padding: 4rem 0;
    }
    .review {
        text-align: center;
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }
    .about-section {
        padding: 4rem 0;
        text-align: center;
    }
    footer {
        background: #222;
        color: #bbb;
        padding: 2rem 0;
        text-align: center;
    }
    footer a {
        color: #bbb;
        margin: 0 0.5rem;
        text-decoration: none;
    }
</style>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content container">
        <h1>Stay. Relax. Book with ease.</h1>
        <p>Find your perfect stay anywhere in the world.</p>

        <div class="search-box container">
            <form class="row g-3 justify-content-center">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Destination" required>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" placeholder="Check-in" required>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" placeholder="Check-out" required>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" placeholder="Guests" min="1" value="1">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Featured Hotels -->
<section class="featured-section container">
    <h2>Featured Hotels</h2>
    <div class="row">
        @for ($i = 1; $i <= 3; $i++)
        <div class="col-md-4 mb-4">
            <div class="card hotel-card">
                <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=800&q=80" alt="Hotel">
                <div class="card-body">
                    <h5 class="card-title">Resort Haven {{ $i }}</h5>
                    <p class="text-muted">$130 / night</p>
                    <div class="text-warning mb-2">★★★★★</div>
                    <a href="#" class="btn btn-outline-primary w-100">Book Now</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <div class="text-center">
        <button class="btn btn-secondary">View All</button>
    </div>
</section>

<!-- Reviews -->
<section class="reviews-section">
    <div class="container">
        <h2 class="text-center mb-5">Latest Reviews</h2>
        <div class="row">
            @for ($i = 1; $i <= 3; $i++)
            <div class="col-md-4 mb-4">
                <div class="review">
                    <div class="text-warning mb-2">★★★★★</div>
                    <p><strong>Amazing Stay!</strong><br>Everything was perfect, from the staff to the room service.</p>
                    <small>- Guest {{ $i }}</small>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section container">
    <h2>About Us</h2>
    <p class="text-muted mb-5">We connect travelers with the best hotels worldwide. Our mission is to make booking simple and enjoyable.</p>
    <div class="row">
        @for ($i = 1; $i <= 4; $i++)
        <div class="col-md-3 mb-4">
            <h5>Title {{ $i }}</h5>
            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
        @endfor
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; {{ date('Y') }} Paradise Hotels | All Rights Reserved</p>
        <div class="mt-2">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
        </div>
    </div>
</footer>
@endsection
