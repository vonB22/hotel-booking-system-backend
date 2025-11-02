@extends('layouts.app')

@section('content')
@role('Admin')
<style>
    .page-header {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border-radius: 12px;
        padding: 1.25rem;
        color: white;
        margin-bottom: 1.25rem;
        box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3);
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

    .user-id-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        margin-left: 0.5rem;
    }

    .back-btn {
        background: white;
        color: #06b6d4;
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
        color: #06b6d4;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(245, 158, 11, 0.3);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        color: white;
    }

    .profile-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .profile-header {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 1.25rem;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        color: white;
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        flex-shrink: 0;
    }

    .profile-info {
        flex: 1;
    }

    .profile-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.25rem;
    }

    .profile-email {
        font-size: 0.9rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .profile-body {
        padding: 1.25rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.25rem;
    }

    .info-item {
        background: #f9fafb;
        border-radius: 10px;
        padding: 1rem;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        border-color: #06b6d4;
        box-shadow: 0 3px 10px rgba(6, 182, 212, 0.1);
        transform: translateY(-2px);
    }

    .info-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #6b7280;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .info-label i {
        color: #06b6d4;
        font-size: 0.8rem;
    }

    .info-value {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
    }

    .roles-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .roles-header {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .roles-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .roles-body {
        padding: 1.25rem;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .role-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .role-admin {
        background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
        border: 2px solid #a78bfa;
        color: #6d28d9;
    }

    .role-user {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border: 2px solid #6ee7b7;
        color: #047857;
    }

    .role-default {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border: 2px solid #d1d5db;
        color: #4b5563;
    }

    .no-roles {
        color: #9ca3af;
        font-size: 0.9rem;
        font-style: italic;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .metadata-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .metadata-header {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .metadata-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .metadata-body {
        padding: 1.25rem;
    }

    .metadata-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .metadata-item {
        display: flex;
        flex-direction: column;
        gap: 0.375rem;
    }

    .metadata-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #6b7280;
        letter-spacing: 0.05em;
    }

    .metadata-value {
        font-size: 0.85rem;
        color: #111827;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .metadata-value i {
        color: #06b6d4;
        font-size: 0.75rem;
    }

    .actions-section {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border: 2px solid #fbbf24;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.25rem;
    }

    .actions-title {
        font-weight: 700;
        font-size: 0.9rem;
        color: #78350f;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
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

        .page-header .d-flex {
            flex-direction: column;
            gap: 0.75rem;
        }

        .back-btn {
            width: 100%;
            justify-content: center;
        }

        .profile-header {
            flex-direction: column;
            text-align: center;
        }

        .profile-name {
            font-size: 1.25rem;
        }

        .profile-email {
            justify-content: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .metadata-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            width: 100%;
        }

        .btn-edit,
        .btn-delete {
            flex: 1;
            justify-content: center;
        }

        .user-id-badge {
            margin-left: 0;
            margin-top: 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .profile-avatar {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-edit,
        .btn-delete {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-3">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2>
                    <i class="fa-solid fa-eye"></i>
                    User Details
                    <span class="user-id-badge">
                        <i class="fa-solid fa-hashtag"></i>
                        ID: {{ $user->id }}
                    </span>
                </h2>
                <p class="mb-0">View complete user profile and information</p>
            </div>
            <a class="back-btn" href="{{ route('users.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Users
            </a>
        </div>
    </div>

    <!-- User Profile Card -->
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="profile-info">
                <div class="profile-name">{{ $user->name }}</div>
                <div class="profile-email">
                    <i class="fa-solid fa-envelope"></i>
                    {{ $user->email }}
                </div>
            </div>
        </div>
        <div class="profile-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-solid fa-fingerprint"></i>
                        User ID
                    </div>
                    <div class="info-value">#{{ $user->id }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-solid fa-user"></i>
                        Full Name
                    </div>
                    <div class="info-value">{{ $user->name }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-solid fa-at"></i>
                        Email Address
                    </div>
                    <div class="info-value" style="word-break: break-all;">{{ $user->email }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-solid fa-shield-halved"></i>
                        Total Roles
                    </div>
                    <div class="info-value">{{ $user->getRoleNames()->count() }} {{ $user->getRoleNames()->count() === 1 ? 'Role' : 'Roles' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Roles Section -->
    <div class="roles-section">
        <div class="roles-header">
            <h5>
                <i class="fa-solid fa-shield-halved"></i>
                Assigned Roles
            </h5>
        </div>
        <div class="roles-body">
            @if($user->getRoleNames()->isNotEmpty())
                @foreach ($user->getRoleNames() as $role)
                    @php
                    switch (strtolower($role)) {
                        case 'admin':
                            $badgeClass = 'role-admin';
                            $icon = 'fa-shield-halved';
                            break;
                        case 'user':
                            $badgeClass = 'role-user';
                            $icon = 'fa-user';
                            break;
                        default:
                            $badgeClass = 'role-default';
                            $icon = 'fa-circle-user';
                            break;
                    }
                    @endphp
                    <span class="role-badge {{ $badgeClass }}">
                        <i class="fa-solid {{ $icon }}"></i>
                        {{ $role }}
                    </span>
                @endforeach
            @else
                <div class="no-roles">
                    <i class="fa-solid fa-circle-info"></i>
                    No roles assigned to this user
                </div>
            @endif
        </div>
    </div>

    <!-- Metadata Section -->
    <div class="metadata-section">
        <div class="metadata-header">
            <h5>
                <i class="fa-solid fa-circle-info"></i>
                Account Metadata
            </h5>
        </div>
        <div class="metadata-body">
            <div class="metadata-grid">
                <div class="metadata-item">
                    <div class="metadata-label">
                        <i class="fa-solid fa-calendar-plus"></i>
                        Account Created
                    </div>
                    <div class="metadata-value">
                        <i class="fa-solid fa-calendar-day"></i>
                        {{ $user->created_at->format('M d, Y') }}
                    </div>
                    <div class="metadata-value" style="font-size: 0.75rem; color: #6b7280;">
                        <i class="fa-solid fa-clock"></i>
                        {{ $user->created_at->format('h:i A') }}
                    </div>
                </div>

                <div class="metadata-item">
                    <div class="metadata-label">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Last Updated
                    </div>
                    <div class="metadata-value">
                        <i class="fa-solid fa-calendar-day"></i>
                        {{ $user->updated_at->format('M d, Y') }}
                    </div>
                    <div class="metadata-value" style="font-size: 0.75rem; color: #6b7280;">
                        <i class="fa-solid fa-clock"></i>
                        {{ $user->updated_at->format('h:i A') }}
                    </div>
                </div>

                <div class="metadata-item">
                    <div class="metadata-label">
                        <i class="fa-solid fa-hourglass-half"></i>
                        Account Age
                    </div>
                    <div class="metadata-value">
                        <i class="fa-solid fa-calendar-days"></i>
                        {{ $user->created_at->diffForHumans() }}
                    </div>
                </div>

                <div class="metadata-item">
                    <div class="metadata-label">
                        <i class="fa-solid fa-arrows-rotate"></i>
                        Last Modified
                    </div>
                    <div class="metadata-value">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        {{ $user->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Section -->
    <div class="actions-section">
        <div class="actions-title">
            <i class="fa-solid fa-bolt"></i>
            Quick Actions
        </div>
        <div class="action-buttons">
            <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit User
            </a>
            <button type="button" class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fa-solid fa-trash"></i>
                Delete User
            </button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 12px; overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none;">
                <h5 class="modal-title" id="deleteModalLabel" style="font-weight: 700; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="width: 60px; height: 60px; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fa-solid fa-user-xmark" style="font-size: 1.5rem; color: #ef4444;"></i>
                    </div>
                    <h6 style="font-weight: 700; color: #111827; margin-bottom: 0.5rem;">Delete User: {{ $user->name }}</h6>
                    <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Are you sure you want to delete this user? This action cannot be undone.</p>
                </div>
                <div style="background: #fef3c7; border: 2px solid #fbbf24; border-radius: 8px; padding: 0.875rem; margin-bottom: 1rem;">
                    <div style="font-size: 0.8rem; color: #78350f;">
                        <strong style="display: flex; align-items: center; gap: 0.375rem; margin-bottom: 0.5rem;">
                            <i class="fa-solid fa-exclamation-circle"></i>
                            Warning:
                        </strong>
                        <ul style="margin: 0; padding-left: 1.25rem; font-size: 0.75rem;">
                            <li>User data will be permanently deleted</li>
                            <li>All associated bookings may be affected</li>
                            <li>This action is irreversible</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none; padding: 1rem 1.5rem;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                    <i class="fa-solid fa-xmark me-1"></i>
                    Cancel
                </button>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                        <i class="fa-solid fa-trash me-1"></i>
                        Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@else
<!-- No Permission Message -->
<div class="container-fluid px-3">
    <div class="no-permission-card">
        <div class="no-permission-icon">
            <i class="fa-solid fa-ban"></i>
        </div>
        <h4 style="color: #111827; font-weight: 700; margin-bottom: 0.75rem;">Access Denied</h4>
        <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 1.5rem;">
            You do not have permission to view this user's details. Only administrators can access user information.
        </p>
        <a class="btn btn-outline-secondary" href="{{ route('home') }}" style="border-radius: 8px; padding: 0.5rem 1.25rem; font-weight: 600; font-size: 0.85rem;">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Back to Dashboard
        </a>
    </div>
</div>
@endrole
@endsection
