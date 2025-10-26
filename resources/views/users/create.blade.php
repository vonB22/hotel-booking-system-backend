@extends('layouts.app')

@section('content')
@role('Admin')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="mb-0">Create New User</h2>
            <a class="btn btn-outline-primary btn-sm shadow-sm" href="{{ route('users.index') }}">
                <i class="fa fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <strong><i class="fa fa-triangle-exclamation me-2"></i> Whoops!</strong> Please fix the following errors:
            <ul class="mt-2 mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter full name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter email address" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter password" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="confirm-password" class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="Re-enter password" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Assign Role(s)</label>
                        <div class="border rounded p-2">
                            @foreach ($roles as $value => $label)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $value }}" id="role-{{ 
                                        Illuminate\Support\Str::slug($value) }}" @if(in_array($value, old('roles', []))) checked @endif>
                                    <label class="form-check-label" for="role-{{ Illuminate\Support\Str::slug($value) }}">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-success shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Create User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="alert alert-danger mt-4 shadow-sm">
    <i class="fa fa-ban me-2"></i> You do not have permission to access this page.
</div>
<a class="btn btn-outline-secondary btn-sm mt-2" href="{{ route('home') }}">
    <i class="fa fa-arrow-left me-1"></i> Back to Dashboard
</a>
@endrole
@endsection
