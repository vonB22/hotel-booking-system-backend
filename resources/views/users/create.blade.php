@extends('layouts.app')

@section('content')
@role('Admin')
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
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
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

    .back-btn {
        background: white;
        color: #667eea;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .back-btn:hover {
        background: #f8f9fa;
        color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .form-card-header {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .form-card-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-card-body {
        padding: 1.25rem;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.8rem;
        color: #374151;
        margin-bottom: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .form-label i {
        color: #667eea;
        font-size: 0.75rem;
    }

    .form-control {
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .form-control::placeholder {
        color: #9ca3af;
        font-size: 0.8rem;
    }

    .role-selection {
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.875rem;
        max-height: 200px;
        overflow-y: auto;
    }

    .role-selection::-webkit-scrollbar {
        width: 6px;
    }

    .role-selection::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 3px;
    }

    .role-selection::-webkit-scrollbar-thumb {
        background: #9ca3af;
        border-radius: 3px;
    }

    .form-check {
        padding: 0.5rem 0.75rem;
        margin-bottom: 0.375rem;
        background: white;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .form-check:hover {
        background: rgba(102, 126, 234, 0.05);
    }

    .form-check-input {
        width: 1.125rem;
        height: 1.125rem;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }

    .form-check-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #374151;
        cursor: pointer;
        margin-left: 0.5rem;
    }

    .alert-custom {
        border-radius: 10px;
        border: none;
        padding: 1rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        font-size: 0.85rem;
    }

    .alert-custom strong {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .alert-custom ul {
        margin-bottom: 0;
        padding-left: 1.25rem;
    }

    .alert-custom li {
        margin-bottom: 0.25rem;
        font-size: 0.8rem;
    }

    .btn-submit {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        color: white;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        color: white;
    }

    .btn-submit i {
        font-size: 0.875rem;
    }

    .password-strength {
        margin-top: 0.375rem;
        font-size: 0.7rem;
        display: flex;
        gap: 0.375rem;
        align-items: center;
    }

    .strength-bar {
        flex: 1;
        height: 4px;
        background: #e5e7eb;
        border-radius: 2px;
        overflow: hidden;
    }

    .strength-fill {
        height: 100%;
        width: 0%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .strength-weak .strength-fill {
        width: 33%;
        background: #ef4444;
    }

    .strength-medium .strength-fill {
        width: 66%;
        background: #f59e0b;
    }

    .strength-strong .strength-fill {
        width: 100%;
        background: #10b981;
    }

    .required-indicator {
        color: #ef4444;
        margin-left: 0.125rem;
    }

    .form-section-divider {
        margin: 1.25rem 0;
        border: 0;
        border-top: 2px dashed #e5e7eb;
    }

    .no-permission-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        text-align: center;
        max-width: 500px;
        margin: 2rem auto;
    }

    .no-permission-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .no-permission-icon i {
        font-size: 2rem;
        color: white;
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

        .form-card-body {
            padding: 1rem;
        }

        .page-header .d-flex {
            flex-direction: column;
            gap: 0.75rem;
        }

        .back-btn {
            width: 100%;
            justify-content: center;
        }

        .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .alert-custom {
            padding: 0.875rem;
        }

        .form-control {
            font-size: 0.8rem;
        }
    }
</style>

<div class="container-fluid px-3">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2>
                    <i class="fa-solid fa-user-plus"></i>
                    Create New User
                </h2>
                <p class="mb-0">Add a new user to the InstaStay system</p>
            </div>
            <a class="back-btn" href="{{ route('users.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Users
            </a>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
            <strong>
                <i class="fa-solid fa-triangle-exclamation"></i>
                Whoops! There were some problems with your input.
            </strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Create User Form -->
    <div class="form-card">
        <div class="form-card-header">
            <h5>
                <i class="fa-solid fa-address-card"></i>
                User Information
            </h5>
        </div>
        <div class="form-card-body">
            <form method="POST" action="{{ route('users.store') }}" id="createUserForm">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">
                            <i class="fa-solid fa-user"></i>
                            Full Name
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name') }}" 
                            placeholder="Enter full name" 
                            class="form-control" 
                            required
                            autocomplete="name">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">
                            <i class="fa-solid fa-envelope"></i>
                            Email Address
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email') }}" 
                            placeholder="user@example.com" 
                            class="form-control" 
                            required
                            autocomplete="email">
                    </div>

                    <div class="col-12">
                        <hr class="form-section-divider">
                    </div>

                    <!-- Password Section -->
                    <div class="col-md-6">
                        <label for="password" class="form-label">
                            <i class="fa-solid fa-lock"></i>
                            Password
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="Enter password (min. 8 characters)" 
                            class="form-control" 
                            required
                            autocomplete="new-password">
                        <div class="password-strength" id="passwordStrength">
                            <div class="strength-bar">
                                <div class="strength-fill"></div>
                            </div>
                            <span class="strength-text">Strength: <span id="strengthLabel">-</span></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="confirm-password" class="form-label">
                            <i class="fa-solid fa-lock"></i>
                            Confirm Password
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="password" 
                            name="confirm-password" 
                            id="confirm-password" 
                            placeholder="Re-enter password" 
                            class="form-control" 
                            required
                            autocomplete="new-password">
                        <small class="text-muted" id="passwordMatch" style="font-size: 0.7rem; display: none;"></small>
                    </div>

                    <div class="col-12">
                        <hr class="form-section-divider">
                    </div>

                    <!-- Role Assignment Section -->
                    <div class="col-12">
                        <label class="form-label">
                            <i class="fa-solid fa-shield-halved"></i>
                            Assign Role(s)
                            <span class="required-indicator">*</span>
                        </label>
                        <div class="role-selection">
                            @foreach ($roles as $value => $label)
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="roles[]" 
                                        value="{{ $value }}" 
                                        id="role-{{ Illuminate\Support\Str::slug($value) }}" 
                                        @if(in_array($value, old('roles', []))) checked @endif>
                                    <label class="form-check-label" for="role-{{ Illuminate\Support\Str::slug($value) }}">
                                        @if(strtolower($value) === 'admin')
                                            <i class="fa-solid fa-shield-halved me-1" style="color: #667eea;"></i>
                                        @elseif(strtolower($value) === 'user')
                                            <i class="fa-solid fa-user me-1" style="color: #10b981;"></i>
                                        @else
                                            <i class="fa-solid fa-circle-user me-1" style="color: #6b7280;"></i>
                                        @endif
                                        {{ $label }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted d-block mt-2" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Select at least one role for the user
                        </small>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-user-plus"></i>
                            Create User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Password strength checker
    const passwordInput = document.getElementById('password');
    const strengthContainer = document.getElementById('passwordStrength');
    const strengthLabel = document.getElementById('strengthLabel');
    const strengthFill = document.querySelector('.strength-fill');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/\d/)) strength++;
        if (password.match(/[^a-zA-Z\d]/)) strength++;

        strengthContainer.classList.remove('strength-weak', 'strength-medium', 'strength-strong');
        
        if (password.length === 0) {
            strengthLabel.textContent = '-';
        } else if (strength <= 1) {
            strengthContainer.classList.add('strength-weak');
            strengthLabel.textContent = 'Weak';
            strengthLabel.style.color = '#ef4444';
        } else if (strength <= 2) {
            strengthContainer.classList.add('strength-medium');
            strengthLabel.textContent = 'Medium';
            strengthLabel.style.color = '#f59e0b';
        } else {
            strengthContainer.classList.add('strength-strong');
            strengthLabel.textContent = 'Strong';
            strengthLabel.style.color = '#10b981';
        }
    });

    // Password match checker
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordMatch = document.getElementById('passwordMatch');

    function checkPasswordMatch() {
        if (confirmPasswordInput.value.length > 0) {
            passwordMatch.style.display = 'block';
            if (passwordInput.value === confirmPasswordInput.value) {
                passwordMatch.textContent = '✓ Passwords match';
                passwordMatch.style.color = '#10b981';
                confirmPasswordInput.style.borderColor = '#10b981';
            } else {
                passwordMatch.textContent = '✗ Passwords do not match';
                passwordMatch.style.color = '#ef4444';
                confirmPasswordInput.style.borderColor = '#ef4444';
            }
        } else {
            passwordMatch.style.display = 'none';
            confirmPasswordInput.style.borderColor = '#e5e7eb';
        }
    }

    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    passwordInput.addEventListener('input', checkPasswordMatch);

    // Form validation
    document.getElementById('createUserForm').addEventListener('submit', function(e) {
        const rolesChecked = document.querySelectorAll('input[name="roles[]"]:checked');
        
        if (rolesChecked.length === 0) {
            e.preventDefault();
            alert('Please select at least one role for the user.');
            return false;
        }

        if (passwordInput.value !== confirmPasswordInput.value) {
            e.preventDefault();
            alert('Passwords do not match. Please check and try again.');
            confirmPasswordInput.focus();
            return false;
        }

        if (passwordInput.value.length < 8) {
            e.preventDefault();
            alert('Password must be at least 8 characters long.');
            passwordInput.focus();
            return false;
        }
    });
</script>

@else
<!-- No Permission Message -->
<div class="container-fluid px-3">
    <div class="no-permission-card">
        <div class="no-permission-icon">
            <i class="fa-solid fa-ban"></i>
        </div>
        <h4 style="color: #111827; font-weight: 700; margin-bottom: 0.75rem;">Access Denied</h4>
        <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 1.5rem;">
            You do not have permission to access this page. Only administrators can create new users.
        </p>
        <a class="btn btn-outline-secondary" href="{{ route('home') }}" style="border-radius: 8px; padding: 0.5rem 1.25rem; font-weight: 600; font-size: 0.85rem;">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Back to Dashboard
        </a>
    </div>
</div>
@endrole
@endsection
