@extends('layouts.app')

@section('content')
@role('Admin')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="mb-0">👁️ View User Details</h2>
            <a class="btn btn-outline-primary btn-sm shadow-sm" href="{{ route('users.index') }}">
                <i class="fa fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-muted">Name</label>
                    <p class="fs-6 mb-0">{{ $user->name }}</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-muted">Email</label>
                    <p class="fs-6 mb-0">{{ $user->email }}</p>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold text-muted">Roles</label><br>
                    @if($user->getRoleNames()->isNotEmpty())
                        @foreach ($user->getRoleNames() as $role)
                            <span class="badge bg-success-subtle text-success border border-success-subtle me-1">{{ $role }}</span>
                        @endforeach
                    @else
                        <p class="text-muted mb-0">No roles assigned</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@else
<div class="alert alert-danger mt-4 shadow-sm">
    <i class="fa fa-ban me-2"></i> You do not have permission to view this user.
</div>
<a class="btn btn-outline-secondary btn-sm mt-2" href="{{ route('home') }}">
    <i class="fa fa-arrow-left me-1"></i> Back to Dashboard
</a>
@endrole
@endsection
