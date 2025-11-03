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

    .create-btn {
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

    .create-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: #667eea;
    }

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

    .stats-bar {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 0.875rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 10px;
        flex: 1;
        min-width: 120px;
    }

    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.9rem;
    }

    .stat-content {
        display: flex;
        flex-direction: column;
    }

    .stat-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.65rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 0.125rem;
    }

    .search-section {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input {
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        padding: 0.5rem 0.75rem 0.5rem 2.5rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .search-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
    }

    .filter-select {
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .hotels-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .hotel-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .hotel-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .hotel-image-wrapper {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    }

    .hotel-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .hotel-card:hover .hotel-image {
        transform: scale(1.05);
    }

    .hotel-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
    }

    .hotel-card-body {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .hotel-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .hotel-description {
        font-size: 0.85rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
        min-height: 2.5rem;
    }

    .hotel-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #10b981;
        margin-bottom: 0.75rem;
    }

    .hotel-price-label {
        font-size: 0.75rem;
        color: #6b7280;
        font-weight: 400;
    }

    .hotel-rating {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-bottom: 0.875rem;
    }

    .hotel-rating i {
        font-size: 0.85rem;
    }

    .rating-value {
        margin-left: 0.375rem;
        font-size: 0.8rem;
        color: #6b7280;
        font-weight: 600;
    }

    .hotel-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: auto;
        padding-top: 0.75rem;
        border-top: 1px solid #f3f4f6;
        justify-content: center;
    }

    .action-btn {
        border-radius: 8px;
        padding: 0.5rem 0.875rem;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .action-btn i {
        font-size: 0.875rem;
    }

    .btn-view {
        background: rgba(59, 130, 246, 0.1);
        border-color: #3b82f6;
        color: #3b82f6;
    }

    .btn-view:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-edit {
        background: rgba(102, 126, 234, 0.1);
        border-color: #667eea;
        color: #667eea;
    }

    .btn-edit:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        border-color: #ef4444;
        color: #ef4444;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        opacity: 0.5;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-state h4 {
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #9ca3af;
        margin-bottom: 1.5rem;
    }

    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 1.5rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        padding: 1.5rem;
        border-top: 1px solid #f3f4f6;
    }

    .delete-warning {
        background: rgba(239, 68, 68, 0.1);
        border-left: 4px solid #ef4444;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
    }

    .delete-warning i {
        color: #ef4444;
    }

    @media (max-width: 992px) {
        .hotels-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
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

        .stats-bar {
            flex-direction: column;
            gap: 0.75rem;
        }

        .stat-item {
            min-width: auto;
        }

        .hotels-grid {
            grid-template-columns: 1fr;
        }

        .page-header .d-flex {
            flex-direction: column;
            gap: 1rem;
        }

        .create-btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .action-btn {
            padding: 0.375rem 0.625rem;
            font-size: 0.75rem;
        }

        .action-btn i {
            font-size: 0.75rem;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>
                    <i class="fa-solid fa-hotel"></i>
                    Hotels Management
                </h2>
                <p>Manage your hotels, edit details, and add new listings</p>
            </div>
            @can('hotel-create')
            <a href="{{ route('hotels.create') }}" class="create-btn">
                <i class="fa-solid fa-plus"></i>
                Add New Hotel
            </a>
            @endcan
        </div>
    </div>

    <!-- Success Alert -->
    @if ($message = Session::get('success'))
    <div class="alert-success">
        <i class="fa-solid fa-circle-check fa-lg"></i>
        <span>{{ $message }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Statistics Bar -->
    <div class="stats-bar">
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="fa-solid fa-hotel"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $hotels->total() }}</div>
                <div class="stat-label">Total Hotels</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <i class="fa-solid fa-star"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($hotels->avg('rating') ?? 0, 1) }}</div>
                <div class="stat-label">Avg Rating</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">${{ number_format($hotels->avg('price') ?? 0, 0) }}</div>
                <div class="stat-label">Avg Price</div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="row g-3">
            <div class="col-md-8">
                <div class="search-input-wrapper">
                    <i class="fa-solid fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search hotels by name or description...">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select filter-select" id="sortFilter">
                    <option value="">Sort By</option>
                    <option value="name">Name (A-Z)</option>
                    <option value="price-low">Price (Low to High)</option>
                    <option value="price-high">Price (High to Low)</option>
                    <option value="rating">Rating (High to Low)</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Hotels Grid -->
    @if($hotels->count() > 0)
    <div class="hotels-grid" id="hotelsGrid">
        @foreach ($hotels as $hotel)
        <div class="hotel-card" data-name="{{ strtolower($hotel->name) }}" data-description="{{ strtolower($hotel->detail) }}" data-price="{{ $hotel->price ?? 0 }}" data-rating="{{ $hotel->rating ?? 0 }}">
            <div class="hotel-image-wrapper">
                @if(!empty($hotel->image))
                    <img src="{{ asset($hotel->image) }}" class="hotel-image" alt="{{ $hotel->name }}">
                @else
                    <div class="hotel-placeholder">
                        <i class="fa-solid fa-hotel fa-3x"></i>
                    </div>
                @endif
            </div>
            
            <div class="hotel-card-body">
                <h5 class="hotel-name">{{ $hotel->name }}</h5>
                <p class="hotel-description">{{ $hotel->detail ?? 'No description available' }}</p>
                
                @if(!empty($hotel->price))
                <div class="hotel-price">
                    ${{ number_format($hotel->price, 0) }}
                    <span class="hotel-price-label">/ night</span>
                </div>
                @endif

                <div class="hotel-rating">
                    @for ($s = 1; $s <= 5; $s++)
                        @if ($s <= ($hotel->rating ?? 0))
                            <i class="fa-solid fa-star text-warning"></i>
                        @else
                            <i class="fa-regular fa-star text-muted"></i>
                        @endif
                    @endfor
                    <span class="rating-value">{{ number_format($hotel->rating ?? 0, 1) }}</span>
                </div>

                <div class="hotel-actions">
                    <a href="{{ route('hotels.show', $hotel->id) }}" class="btn action-btn btn-view" title="View Hotel">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    @can('hotel-edit')
                    <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn action-btn btn-edit" title="Edit Hotel">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    @endcan
                    @can('hotel-delete')
                    <button type="button" class="btn action-btn btn-delete" title="Delete Hotel"
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteModal"
                        data-hotel-id="{{ $hotel->id }}"
                        data-hotel-name="{{ $hotel->name }}"
                        data-hotel-url="{{ route('hotels.destroy', $hotel->id) }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if ($hotels->hasPages())
    <div class="p-4 bg-white rounded-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted" style="font-size: 0.875rem;">
                Showing {{ $hotels->firstItem() }} to {{ $hotels->lastItem() }} of {{ $hotels->total() }} hotels
            </div>
            <div>
                {!! $hotels->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
    @endif

    @else
    <!-- Empty State -->
    <div class="empty-state">
        <i class="fa-solid fa-hotel"></i>
        <h4>No hotels found</h4>
        <p>There are no hotels in the system yet.</p>
        @can('hotel-create')
        <a href="{{ route('hotels.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-2"></i>Add Your First Hotel
        </a>
        @endcan
    </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Are you sure you want to delete <strong id="hotelName"></strong>?</p>
                <div class="delete-warning">
                    <i class="fa-solid fa-exclamation-circle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. All hotel data and associated bookings will be affected.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash me-1"></i>Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const sortFilter = document.getElementById('sortFilter');
    const hotelsGrid = document.getElementById('hotelsGrid');
    const hotelCards = hotelsGrid ? Array.from(document.querySelectorAll('.hotel-card')) : [];

    function filterAndSortHotels() {
        const searchTerm = searchInput.value.toLowerCase();
        const sortBy = sortFilter.value;

        // Filter hotels
        let visibleCards = hotelCards.filter(card => {
            const name = card.getAttribute('data-name');
            const description = card.getAttribute('data-description');
            const matches = name.includes(searchTerm) || description.includes(searchTerm);
            card.style.display = matches ? '' : 'none';
            return matches;
        });

        // Sort hotels
        if (sortBy && hotelsGrid) {
            visibleCards.sort((a, b) => {
                switch(sortBy) {
                    case 'name':
                        return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
                    case 'price-low':
                        return parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'));
                    case 'price-high':
                        return parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price'));
                    case 'rating':
                        return parseFloat(b.getAttribute('data-rating')) - parseFloat(a.getAttribute('data-rating'));
                    default:
                        return 0;
                }
            });

            // Reorder DOM elements
            visibleCards.forEach(card => hotelsGrid.appendChild(card));
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterAndSortHotels);
    }

    if (sortFilter) {
        sortFilter.addEventListener('change', filterAndSortHotels);
    }

    // Delete modal functionality
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const hotelName = button.getAttribute('data-hotel-name');
            const form = document.getElementById('deleteForm');
            const nameDisplay = document.getElementById('hotelName');
            const url = button.getAttribute('data-hotel-url');

            form.action = url || '';
            nameDisplay.textContent = hotelName;
        });
    }
</script>

@endsection
