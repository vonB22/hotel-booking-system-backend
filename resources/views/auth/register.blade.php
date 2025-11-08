@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="row g-0">
            <!-- Content will go here -->
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        padding: 0.5rem 0;
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
        max-width: 1050px;
        padding: 0.75rem;
    }

    .auth-card {
        backdrop-filter: blur(16px);
        background: rgba(255, 255, 255, 0.95);
        border-radius: 1.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        max-height: 98vh;
        display: flex;
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
        padding: 2rem 1.75rem;
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
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        animation: pulse 3s ease-in-out infinite;
        font-size: 1.75rem;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4); }
        50% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(255, 255, 255, 0); }
    }

    .benefit-item {
        display: flex;
        align-items: start;
        margin-bottom: 0.85rem;
        text-align: left;
        animation: slideInLeft 0.5s ease forwards;
        opacity: 0;
    }

    .benefit-item:nth-child(1) { animation-delay: 0.2s; }
    .benefit-item:nth-child(2) { animation-delay: 0.3s; }
    .benefit-item:nth-child(3) { animation-delay: 0.4s; }
    .benefit-item:nth-child(4) { animation-delay: 0.5s; }

    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .benefit-icon {
        width: 32px;
        height: 32px;
        min-width: 32px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
        font-size: 0.875rem;
    }

    .benefit-content h6 {
        margin: 0 0 0.15rem 0;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .benefit-content p {
        margin: 0;
        font-size: 0.75rem;
        opacity: 0.9;
        line-height: 1.3;
    }

    .auth-right {
        background: #fff;
        padding: 1.75rem 2rem;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .auth-right::-webkit-scrollbar {
        width: 6px;
    }

    .auth-right::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .auth-right::-webkit-scrollbar-thumb {
        background: #667eea;
        border-radius: 10px;
    }

    .brand-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.4rem 0.875rem;
        border-radius: 2rem;
        font-size: 0.8125rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .form-floating {
        position: relative;
        margin-bottom: 0.75rem;
    }

    .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 0.875rem 0.875rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: #fff;
    }

    .form-floating label {
        padding: 0.875rem 0.875rem;
        color: #6b7280;
        font-size: 0.875rem;
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

    /* Password Strength Indicator */
    .password-strength {
        margin-top: 0.35rem;
        margin-bottom: 0.5rem;
    }

    .strength-bar {
        height: 3px;
        background: #e5e7eb;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 0.35rem;
    }

    .strength-fill {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .strength-text {
        font-size: 0.75rem;
        font-weight: 600;
    }

    .strength-weak .strength-fill {
        width: 33%;
        background: #ef4444;
    }

    .strength-weak .strength-text {
        color: #ef4444;
    }

    .strength-medium .strength-fill {
        width: 66%;
        background: #f59e0b;
    }

    .strength-medium .strength-text {
        color: #f59e0b;
    }

    .strength-strong .strength-fill {
        width: 100%;
        background: #10b981;
    }

    .strength-strong .strength-text {
        color: #10b981;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .form-check {
        margin-bottom: 0.75rem !important;
        font-size: 0.8125rem;
    }

    .form-check-label {
        margin-left: 0.25rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 0.65rem 1.5rem;
        font-weight: 600;
        font-size: 0.9375rem;
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
        padding: 0.65rem 0.875rem;
        font-size: 0.8125rem;
        margin-bottom: 0.75rem;
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

    .alert ul {
        margin-left: 1rem;
        margin-bottom: 0;
        padding-left: 0.5rem;
    }

    .alert ul li {
        font-size: 0.75rem;
        margin-bottom: 0.15rem;
    }

    .requirements-list {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        margin-bottom: 0.65rem;
        font-size: 0.75rem;
    }

    .requirement-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-bottom: 0.15rem;
        color: #6b7280;
        transition: color 0.2s;
    }

    .requirement-item i {
        font-size: 0.6875rem;
        width: 12px;
    }

    .requirement-item.met {
        color: #10b981;
    }

    .requirement-item.met i {
        color: #10b981;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .auth-left {
            padding: 2rem 1.5rem;
        }

        .auth-right {
            padding: 2rem 1.5rem;
        }

        .benefit-item {
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
                        <i class="fa-solid fa-hotel"></i>
                    </div>
                    <h3 class="fw-bold mb-2" style="font-size: 1.5rem;">Join StayEase</h3>
                    <p class="mb-3 opacity-90" style="font-size: 0.875rem;">Discover and book your ideal stay with ease</p>
                    
                    <div class="mt-2">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fa-solid fa-rocket"></i>
                            </div>
                            <div class="benefit-content">
                                <h6>Quick Setup</h6>
                                <p>Get started in minutes with our intuitive dashboard</p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div class="benefit-content">
                                <h6>Secure & Reliable</h6>
                                <p>Your data is protected with enterprise-grade security</p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="benefit-content">
                                <h6>Real-time Analytics</h6>
                                <p>Track bookings and revenue with live insights</p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fa-solid fa-headset"></i>
                            </div>
                            <div class="benefit-content">
                                <h6>24/7 Support</h6>
                                <p>Our team is here to help you succeed</p>
                            </div>
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

                <h4 class="fw-bold mb-1 text-dark" style="font-size: 1.35rem;">Create your account</h4>
                <p class="text-muted mb-2" style="font-size: 0.875rem;">Join thousands of travelers worldwide</p>

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
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    {{-- Full Name --}}
                    <div class="form-floating">
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="form-control @error('name') is-invalid @enderror" 
                            placeholder="Full Name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus
                        >
                        <label for="name">
                            <i class="fa-regular fa-user me-2"></i>Full Name
                        </label>
                    </div>

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

                    {{-- Password Strength Indicator --}}
                    <div class="password-strength d-none" id="passwordStrength">
                        <div class="strength-bar">
                            <div class="strength-fill"></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="strength-text">Password strength</span>
                        </div>
                    </div>

                    {{-- Password Requirements --}}
                    <div class="requirements-list" id="passwordRequirements">
                        <div class="requirement-item" id="req-length">
                            <i class="fa-regular fa-circle"></i>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="requirement-item" id="req-uppercase">
                            <i class="fa-regular fa-circle"></i>
                            <span>One uppercase letter</span>
                        </div>
                        <div class="requirement-item" id="req-lowercase">
                            <i class="fa-regular fa-circle"></i>
                            <span>One lowercase letter</span>
                        </div>
                        <div class="requirement-item" id="req-number">
                            <i class="fa-regular fa-circle"></i>
                            <span>One number</span>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="form-floating position-relative">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="form-control" 
                            placeholder="Confirm Password" 
                            required
                        >
                        <label for="password_confirmation">
                            <i class="fa-solid fa-lock me-2"></i>Confirm Password
                        </label>
                        <i class="fa-regular fa-eye password-toggle" id="togglePasswordConfirm"></i>
                    </div>

                    {{-- Terms Agreement --}}
                    <div class="form-check mb-4">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="terms" 
                            id="terms" 
                            required
                        >
                        <label class="form-check-label small" for="terms">
                            I agree to the <a href="#" class="text-link">Terms of Service</a> and <a href="#" class="text-link">Privacy Policy</a>
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary w-100 mb-2 rounded-3" id="registerBtn">
                        <span class="btn-text">Create Account</span>
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>

                    {{-- Sign In Link --}}
                    <div class="text-center" style="font-size: 0.875rem;">
                        <span class="text-muted">Already have an account?</span>
                        <a href="{{ route('login') }}" class="text-link ms-1">Sign in</a>
                    </div>
                </form>
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
        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const passwordConfirm = document.getElementById('password_confirmation');

        if (togglePassword && password) {
            togglePassword.addEventListener('click', () => {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                togglePassword.classList.toggle('fa-eye');
                togglePassword.classList.toggle('fa-eye-slash');
            });
        }

        if (togglePasswordConfirm && passwordConfirm) {
            togglePasswordConfirm.addEventListener('click', () => {
                const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirm.setAttribute('type', type);
                togglePasswordConfirm.classList.toggle('fa-eye');
                togglePasswordConfirm.classList.toggle('fa-eye-slash');
            });
        }

        // Password Strength Checker
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        const strengthFill = passwordStrength?.querySelector('.strength-fill');
        const strengthText = passwordStrength?.querySelector('.strength-text');

        const requirements = {
            length: document.getElementById('req-length'),
            uppercase: document.getElementById('req-uppercase'),
            lowercase: document.getElementById('req-lowercase'),
            number: document.getElementById('req-number')
        };

        if (passwordInput && passwordStrength) {
            passwordInput.addEventListener('input', function() {
                const value = this.value;
                
                if (value.length === 0) {
                    passwordStrength.classList.add('d-none');
                    return;
                }

                passwordStrength.classList.remove('d-none');

                // Check requirements
                const checks = {
                    length: value.length >= 8,
                    uppercase: /[A-Z]/.test(value),
                    lowercase: /[a-z]/.test(value),
                    number: /[0-9]/.test(value)
                };

                // Update requirement indicators
                Object.keys(checks).forEach(key => {
                    if (checks[key]) {
                        requirements[key]?.classList.add('met');
                        requirements[key]?.querySelector('i').classList.remove('fa-circle');
                        requirements[key]?.querySelector('i').classList.add('fa-circle-check');
                    } else {
                        requirements[key]?.classList.remove('met');
                        requirements[key]?.querySelector('i').classList.remove('fa-circle-check');
                        requirements[key]?.querySelector('i').classList.add('fa-circle');
                    }
                });

                // Calculate strength
                const metCount = Object.values(checks).filter(Boolean).length;
                
                // Remove all strength classes
                passwordStrength.classList.remove('strength-weak', 'strength-medium', 'strength-strong');
                
                if (metCount <= 2) {
                    passwordStrength.classList.add('strength-weak');
                    strengthText.textContent = 'Weak password';
                } else if (metCount === 3) {
                    passwordStrength.classList.add('strength-medium');
                    strengthText.textContent = 'Medium password';
                } else {
                    passwordStrength.classList.add('strength-strong');
                    strengthText.textContent = 'Strong password';
                }
            });
        }

        // Form Submit Loading State
        const registerForm = document.getElementById('registerForm');
        const registerBtn = document.getElementById('registerBtn');

        if (registerForm && registerBtn) {
            registerForm.addEventListener('submit', function(e) {
                // Check if terms are accepted
                const termsCheckbox = document.getElementById('terms');
                if (!termsCheckbox.checked) {
                    e.preventDefault();
                    alert('Please accept the Terms of Service and Privacy Policy');
                    return;
                }

                registerBtn.disabled = true;
                registerBtn.innerHTML = '<span class="spinner me-2"></span>Creating account...';
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

        // Password match validation
        if (passwordInput && passwordConfirm) {
            passwordConfirm.addEventListener('input', function() {
                if (this.value && passwordInput.value !== this.value) {
                    this.setCustomValidity('Passwords do not match');
                    this.classList.add('is-invalid');
                } else {
                    this.setCustomValidity('');
                    this.classList.remove('is-invalid');
                }
            });

            passwordInput.addEventListener('input', function() {
                if (passwordConfirm.value) {
                    if (this.value !== passwordConfirm.value) {
                        passwordConfirm.setCustomValidity('Passwords do not match');
                        passwordConfirm.classList.add('is-invalid');
                    } else {
                        passwordConfirm.setCustomValidity('');
                        passwordConfirm.classList.remove('is-invalid');
                    }
                }
            });
        }
    });
</script>
@endsection
