@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0 text-primary">
                <i class="fa-solid fa-hotel me-2"></i> Hotels
            </h2>
            <p class="text-muted small mb-0">Manage your hotels, edit details, and add new listings.</p>
        </div>
        @can('hotel-create')
            <a href="{{ route('hotels.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fa fa-plus me-1"></i> Add New Hotel
            </a>
        @endcan
    </div>

    <!-- Alert -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-1"></i> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @php
        $i = ($hotels->currentPage() - 1) * $hotels->perPage();
    @endphp

    <!-- Hotel Cards Grid -->
    <div class="row g-4">
        @forelse ($hotels as $hotel)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100 rounded-3 overflow-hidden hotel-card">
                    <!-- Image -->
                    @if(!empty($hotel->image))
                        <img src="{{ asset($hotel->image) }}" class="card-img-top" alt="{{ $hotel->name }}" style="object-fit: cover; height: 180px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                            <i class="fa-solid fa-hotel fa-3x text-muted"></i>
                        </div>
                    @endif

                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column p-3">
                        <h5 class="fw-bold text-dark mb-1">{{ $hotel->name }}</h5>
                        <p class="text-muted small mb-2">{{ Str::limit($hotel->detail, 80) }}</p>

                        @if(!empty($hotel->price))
                            <div class="mb-3">
                                <span class="fw-semibold text-success">
                                    <i class="fa-solid fa-dollar-sign me-1"></i>{{ $hotel->price }}
                                </span>
                                <span class="text-muted small">/ night</span>
                            </div>
                        @endif

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <div class="small text-muted d-flex align-items-center">
                                <div class="hotel-rating me-2">
                                    @for ($s = 1; $s <= 5; $s++)
                                        @if ($s <= ($hotel->rating ?? 0))
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @else
                                            <i class="fa-regular fa-star text-muted"></i>
                                        @endif
                                    @endfor
                                </div>
                                <div class="ms-2 small text-muted">{{ $hotel->rating ?? 0 }} / 5</div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @can('hotel-edit')
                                    <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                @endcan
                                @can('hotel-delete')
                                    <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this hotel?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light border text-center py-5">
                    <i class="fa-solid fa-bed fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-2">No hotels found.</p>
                        @can('hotel-create')
                        <a href="{{ route('hotels.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus me-1"></i> Add Your First Hotel
                        </a>
                    @endcan
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {!! $hotels->links('vendor.pagination.custom') !!}
    </div>
</div>

<!-- Inline Styling -->
<style>
    .hotel-card {
        transition: all 0.25s ease-in-out;
    }

    .hotel-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .btn-outline-info:hover {
        background-color: #0dcaf0;
        color: #fff;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: #fff;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }

    .btn {
        border-radius: 8px;
    }
</style>
@endsection
