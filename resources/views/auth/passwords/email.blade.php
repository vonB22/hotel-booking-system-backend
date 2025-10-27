@php(view()->share('hideNav', true))
@extends('layouts.app')

@section('content')
<div class="vh-90 d-flex justify-content-center align-items-center">

    <div class="card shadow-lg border-0 rounded-4 text-center py-5 px-4 w-100" 
         style="max-width: 600px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(8px);">
         
        <div class="mb-4">
            <i class="fa-solid fa-circle-info fa-4x text-primary mb-3"></i>
            <h3 class="fw-bold mb-2">Feature Not Implemented Yet</h3>
            <p class="text-muted small mb-0">
                Oops! The password reset feature isn’t available right now.<br>
                You can log in or create a new account to continue using StayEase.
            </p>
        </div>

        @if(empty($hideNav))
        <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
            <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm">
                <i class="fa-solid fa-right-to-bracket me-2"></i>Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary px-4 py-2 fw-semibold">
                <i class="fa-solid fa-user-plus me-2"></i>Register
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
