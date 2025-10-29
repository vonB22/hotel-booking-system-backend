@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    /* Animated background circles */
    body::before,
    body::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 20s infinite ease-in-out;
    }

    body::before {
        width: 500px;
        height: 500px;
        top: -250px;
        right: -100px;
        animation-delay: -5s;
    }

    body::after {
        width: 400px;
        height: 400px;
        bottom: -200px;
        left: -100px;
        animation-delay: -10s;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }

    .auth-container {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 900px;
        padding: 1rem;
    }

    .auth-card {
        backdrop-filter: blur(16px);
        background: rgba(255, 255, 255, 0.95);
        border-radius: 1.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    @keyframes slideUp {
        from { 
            opacity: 0; 
            transform: translateY(30px) scale(0.95); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0) scale(1); 
        }
    }

    .auth-left {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 4rem 2.5rem;
        position: relative;
        overflow: hidden;
    }

    /* Decorative pattern overlay */
    .auth-left::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .auth-left-content {
        position: relative;
        z-index: 1;
    }

    .logo-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4); }
        50% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(255, 255, 255, 0); }
    }

    .feature-list {
        margin-top: 2rem;
        text-align: left;
    }

    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        opacity: 0.95;
    }

    .feature-item i {
        width: 24px;
        margin-right: 0.75rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .auth-right {
        background: #fff;
        padding: 3.5rem 3rem;
        position: relative;
    }

    .brand-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: #fff;
    }

    .form-floating label {
        padding: 1rem 1rem;
        color: #6b7280;
        font-size: 0.95rem;
    }

    .form-control:focus ~ label,
    .form-control:not(:placeholder-shown) ~ label {
        color: #667eea;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        color: #9ca3af;
        cursor: pointer;
        transition: all 0.2s;
        z-index: 10;
    }

    .password-toggle:hover {
        color: #667eea;
        transform: translateY(-50%) scale(1.1);
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .text-link {
        text-decoration: none;
        color: #667eea;
        font-weight: 600;
        transition: all 0.2s;
        position: relative;
    }

    .text-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: #667eea;
        transition: width 0.3s ease;
    }

    .text-link:hover::after {
        width: 100%;
    }

    .text-link:hover {
        color: #5568d3;
    }

    .alert {
        border-radius: 0.75rem;
        border: none;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1.5rem 0;
        color: #9ca3af;
        font-size: 0.875rem;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #e5e7eb;
    }

    .divider span {
        padding: 0 1rem;
    }

    .social-login {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-btn {
        flex: 1;
        padding: 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        background: #fff;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: #374151;
    }

    .social-btn:hover {
        border-color: #667eea;
        background: #f9fafb;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .auth-left {
            padding: 2rem 1.5rem;
        }

        .auth-right {
            padding: 2rem 1.5rem;
        }

        .feature-list {
            display: none;
        }

        body::before,
        body::after {
            display: none;
        }
    }

    /* Loading state */
    .btn-primary:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="row g-0">
            
            {{-- Left Section --}}
            <div class="col-md-5 auth-left d-none d-md-flex">
                <div class="auth-left-content">
                    <div class="logo-icon">
                        <i class="fa-solid fa-hotel fa-3x"></i>
                    </div>
                    <h2 class="fw-bold mb-3">Welcome to StayEase</h2>
                    <p class="mb-0 opacity-90">Book your perfect stay with ease.</p>
                    
                    <div class="feature-list">
                        <div class="feature-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Easy booking</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Great deals</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Secure & reliable</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Section --}}
            <div class="col-md-7 auth-right">
                <div class="text-center">
                    <div class="brand-badge d-inline-flex d-md-none">
                        <i class="fa-solid fa-hotel"></i>
                        <span>StayEase</span>
                    </div>
                </div>

                <h3 class="fw-bold mb-2 text-dark">Sign in to your account</h3>
                <p class="text-muted mb-4">Enter your credentials to access your account easily.</p>

                {{-- Status Message --}}
                @if(session('status'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check me-2"></i>{{ session('status') }}
                    </div>
                @endif

                {{-- Error Messages --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-circle-exclamation me-2"></i>
                        <strong>Error:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    {{-- Email --}}
                    <div class="form-floating">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            placeholder="Email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                        >
                        <label for="email">
                            <i class="fa-regular fa-envelope me-2"></i>Email Address
                        </label>
                    </div>

                    {{-- Password --}}
                    <div class="form-floating position-relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Password" 
                            required
                        >
                        <label for="password">
                            <i class="fa-solid fa-lock me-2"></i>Password
                        </label>
                        <i class="fa-regular fa-eye password-toggle" id="togglePassword"></i>
                    </div>

                    {{-- Remember & Forgot --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="remember" 
                                id="remember" 
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="text-link" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary w-100 mb-3 rounded-3" id="loginBtn">
                        <span class="btn-text">Sign In</span>
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>

                    {{-- Sign Up Link --}}
                    <div class="text-center">
                        <span class="text-muted">Don't have an account?</span>
                        <a href="{{ route('register') }}" class="text-link ms-1">Create one</a>
                    </div>
                </form>

                {{-- Optional: Social Login (uncomment if needed) --}}
                {{--
                <div class="divider">
                    <span>Or continue with</span>
                </div>

                <div class="social-login">
                    <button type="button" class="social-btn">
                        <i class="fa-brands fa-google"></i>
                        <span class="d-none d-sm-inline">Google</span>
                    </button>
                    <button type="button" class="social-btn">
                        <i class="fa-brands fa-microsoft"></i>
                        <span class="d-none d-sm-inline">Microsoft</span>
                    </button>
                </div>
                --}}
            </div>

        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Password Toggle
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        if (togglePassword && password) {
            togglePassword.addEventListener('click', () => {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                togglePassword.classList.toggle('fa-eye');
                togglePassword.classList.toggle('fa-eye-slash');
            });
        }

        // Form Submit Loading State
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');

        if (loginForm && loginBtn) {
            loginForm.addEventListener('submit', function() {
                loginBtn.disabled = true;
                loginBtn.innerHTML = '<span class="spinner me-2"></span>Signing in...';
            });
        }

        // Input focus animation
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
                this.parentElement.style.transition = 'transform 0.2s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection
