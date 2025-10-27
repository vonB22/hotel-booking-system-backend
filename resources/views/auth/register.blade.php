@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #4f46e5, #3b82f6);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .auth-card {
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.92);
        border-radius: 1.25rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        overflow: hidden;
        width: 100%;
        max-width: 850px;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .auth-left {
        background: linear-gradient(135deg, #4338ca, #2563eb);
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 3rem 2rem;
    }

    .auth-left i {
        opacity: 0.9;
    }

    .auth-right {
        background: #fff;
        padding: 3rem 2.5rem;
        position: relative;
    }

    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.15rem rgba(79,70,229,0.25);
    }

    .btn-primary {
        background: #4f46e5;
        border: none;
        transition: all 0.2s ease-in-out;
    }

    .btn-primary:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(79,70,229,0.3);
    }

    .text-link {
        text-decoration: none;
        color: #4f46e5;
        font-weight: 600;
        transition: color 0.2s;
    }

    .text-link:hover {
        color: #3730a3;
        text-decoration: underline;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        color: #6b7280;
        cursor: pointer;
    }

    .password-toggle:hover {
        color: #4f46e5;
    }
</style>

<div class="auth-card">
    <div class="row g-0">
        
        {{-- Left Section --}}
        <div class="col-md-5 auth-left d-none d-md-flex">
            <div>
                <i class="fa-solid fa-user-plus fa-4x mb-4"></i>
                <h3 class="fw-bold mb-3">Welcome to StayEase</h3>
                <p class="text-white-50">Effortlessly manage your listings, bookings, and guests — all in one platform.</p>
            </div>
        </div>

        {{-- Right Section --}}
        <div class="col-md-7 auth-right">
            <h4 class="fw-semibold mb-4 text-center text-dark">Create Your Account</h4>

            {{-- Status Message --}}
            @if(session('status'))
                <div class="alert alert-success small">{{ session('status') }}</div>
            @endif

            {{-- Error Messages --}}
            @if($errors->any())
                <div class="alert alert-danger small">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Full Name --}}
                <div class="form-floating mb-3">
                    <input type="text" id="name" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                    <label for="name"><i class="fa-regular fa-user me-2"></i>Full Name</label>
                </div>

                {{-- Email --}}
                <div class="form-floating mb-3">
                    <input type="email" id="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
                    <label for="email"><i class="fa-regular fa-envelope me-2"></i>Email Address</label>
                </div>

                {{-- Password --}}
                <div class="form-floating mb-3 position-relative">
                    <input type="password" id="password" name="password" class="form-control rounded-3 @error('password') is-invalid @enderror" placeholder="Password" required>
                    <label for="password"><i class="fa-solid fa-lock me-2"></i>Password</label>
                    <i class="fa-regular fa-eye password-toggle" id="togglePassword"></i>
                </div>

                {{-- Confirm Password --}}
                <div class="form-floating mb-4 position-relative">
                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control rounded-3" placeholder="Confirm Password" required>
                    <label for="password-confirm"><i class="fa-solid fa-lock me-2"></i>Confirm Password</label>
                    <i class="fa-regular fa-eye password-toggle" id="togglePasswordConfirm"></i>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-link">Login</a>
                    </span>
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3">Register</button>
                </div>
            </form>
        </div>

    </div>
</div>

{{-- Password Toggle Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye');
            togglePassword.classList.toggle('fa-eye-slash');
        });

        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const passwordConfirm = document.getElementById('password-confirm');

        togglePasswordConfirm.addEventListener('click', () => {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            togglePasswordConfirm.classList.toggle('fa-eye');
            togglePasswordConfirm.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection
