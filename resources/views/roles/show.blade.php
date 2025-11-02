@extends('layouts.app')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 12px;
        padding: 1.25rem;
        color: white;
        margin-bottom: 1.25rem;
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
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

    .role-id-badge {
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
        color: #8b5cf6;
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
        color: #8b5cf6;
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
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        color: white;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
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

    .profile-description {
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
        border-color: #8b5cf6;
        box-shadow: 0 3px 10px rgba(139, 92, 246, 0.1);
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
        color: #8b5cf6;
        font-size: 0.8rem;
    }

    .info-value {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
    }

    .permissions-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .permissions-header {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .permissions-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .permission-count-badge {
        background: #8b5cf6;
        color: white;
        padding: 0.25rem 0.625rem;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 700;
        margin-left: auto;
    }

    .permissions-body {
        padding: 1.25rem;
    }

    .permission-groups {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .permission-group {
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.875rem;
        transition: all 0.3s ease;
    }

    .permission-group:hover {
        border-color: #8b5cf6;
        box-shadow: 0 3px 10px rgba(139, 92, 246, 0.1);
    }

    .permission-group-title {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #8b5cf6;
        letter-spacing: 0.05em;
        margin-bottom: 0.625rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .permission-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .permission-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 0.875rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        background: white;
        border: 2px solid #8b5cf6;
        color: #7c3aed;
        transition: all 0.3s ease;
    }

    .permission-badge:hover {
        background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(139, 92, 246, 0.2);
    }

    .permission-badge i {
        font-size: 0.75rem;
    }

    .no-permissions {
        color: #9ca3af;
        font-size: 0.9rem;
        font-style: italic;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        justify-content: center;
        padding: 2rem;
        background: #f9fafb;
        border-radius: 8px;
        border: 2px dashed #e5e7eb;
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
        color: #8b5cf6;
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

        .profile-description {
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

        .role-id-badge {
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
                    Role Details
                    <span class="role-id-badge">
                        <i class="fa-solid fa-hashtag"></i>
                        ID: {{ $role->id }}
                    </span>
                </h2>
                <p class="mb-0">View complete role information and permissions</p>
            </div>
            <a class="back-btn" href="{{ route('roles.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Roles
            </a>
        </div>
    </div>

    <!-- Role Profile Card -->
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div class="profile-info">
                <div class="profile-name">{{ $role->name }}</div>
                <div class="profile-description">
                    <i class="fa-solid fa-shield-halved"></i>
                    System Role
                </div>
            </div>
        </div>
        <div class="profile-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-solid fa-fingerprint"></i>
                        Role ID
                    </div>
                    <div class="info-value">#{{ $role->id }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-solid fa-tag"></i>
                        Role Name
                    </div>
                    <div class="info-value">{{ $role->name }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-solid fa-key"></i>
                        Total Permissions
                    </div>
                    <div class="info-value">
                        @if(!empty($rolePermissions))
                            {{ count($rolePermissions) }} {{ count($rolePermissions) === 1 ? 'Permission' : 'Permissions' }}
                        @else
                            0 Permissions
                        @endif
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-solid fa-calendar-plus"></i>
                        Created At
                    </div>
                    <div class="info-value" style="font-size: 0.875rem;">{{ $role->created_at->format('M d, Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Permissions Section -->
    <div class="permissions-section">
        <div class="permissions-header">
            <h5>
                <i class="fa-solid fa-key"></i>
                Assigned Permissions
                @if(!empty($rolePermissions))
                    <span class="permission-count-badge">{{ count($rolePermissions) }}</span>
                @endif
            </h5>
        </div>
        <div class="permissions-body">
            @if (!empty($rolePermissions))
                @php
                    // Group permissions by prefix
                    $groupedPermissions = [];
                    foreach($rolePermissions as $permission) {
                        $parts = explode('-', $permission->name);
                        $group = $parts[0] ?? 'other';
                        if (!isset($groupedPermissions[$group])) {
                            $groupedPermissions[$group] = [];
                        }
                        $groupedPermissions[$group][] = $permission;
                    }
                    ksort($groupedPermissions);
                @endphp

                <div class="permission-groups">
                    @foreach($groupedPermissions as $group => $perms)
                        <div class="permission-group">
                            <div class="permission-group-title">
                                <i class="fa-solid fa-folder"></i>
                                {{ ucfirst($group) }} Permissions
                                <span style="margin-left: auto; background: white; padding: 0.125rem 0.5rem; border-radius: 8px; font-size: 0.7rem; color: #8b5cf6;">
                                    {{ count($perms) }}
                                </span>
                            </div>
                            <div class="permission-badges">
                                @foreach($perms as $perm)
                                    @php
                                        // Determine icon based on permission type
                                        $icon = 'fa-shield-halved';
                                        if (str_contains($perm->name, 'create')) {
                                            $icon = 'fa-plus';
                                        } elseif (str_contains($perm->name, 'edit')) {
                                            $icon = 'fa-pen-to-square';
                                        } elseif (str_contains($perm->name, 'delete')) {
                                            $icon = 'fa-trash';
                                        } elseif (str_contains($perm->name, 'list') || str_contains($perm->name, 'view')) {
                                            $icon = 'fa-eye';
                                        }
                                    @endphp
                                    <span class="permission-badge">
                                        <i class="fa-solid {{ $icon }}"></i>
                                        {{ $perm->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-permissions">
                    <i class="fa-solid fa-circle-info"></i>
                    No permissions assigned to this role
                </div>
            @endif
        </div>
    </div>

    <!-- Metadata Section -->
    <div class="metadata-section">
        <div class="metadata-header">
            <h5>
                <i class="fa-solid fa-circle-info"></i>
                Role Metadata
            </h5>
        </div>
        <div class="metadata-body">
            <div class="metadata-grid">
                <div class="metadata-item">
                    <div class="metadata-label">
                        <i class="fa-solid fa-calendar-plus"></i>
                        Created At
                    </div>
                    <div class="metadata-value">
                        <i class="fa-solid fa-calendar-day"></i>
                        {{ $role->created_at->format('M d, Y') }}
                    </div>
                    <div class="metadata-value" style="font-size: 0.75rem; color: #6b7280;">
                        <i class="fa-solid fa-clock"></i>
                        {{ $role->created_at->format('h:i A') }}
                    </div>
                </div>

                <div class="metadata-item">
                    <div class="metadata-label">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Last Updated
                    </div>
                    <div class="metadata-value">
                        <i class="fa-solid fa-calendar-day"></i>
                        {{ $role->updated_at->format('M d, Y') }}
                    </div>
                    <div class="metadata-value" style="font-size: 0.75rem; color: #6b7280;">
                        <i class="fa-solid fa-clock"></i>
                        {{ $role->updated_at->format('h:i A') }}
                    </div>
                </div>

                <div class="metadata-item">
                    <div class="metadata-label">
                        <i class="fa-solid fa-hourglass-half"></i>
                        Role Age
                    </div>
                    <div class="metadata-value">
                        <i class="fa-solid fa-calendar-days"></i>
                        {{ $role->created_at->diffForHumans() }}
                    </div>
                </div>

                <div class="metadata-item">
                    <div class="metadata-label">
                        <i class="fa-solid fa-arrows-rotate"></i>
                        Last Modified
                    </div>
                    <div class="metadata-value">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        {{ $role->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Section -->
    @can('role-edit')
    <div class="actions-section">
        <div class="actions-title">
            <i class="fa-solid fa-bolt"></i>
            Quick Actions
        </div>
        <div class="action-buttons">
            <a href="{{ route('roles.edit', $role->id) }}" class="btn-edit">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Role
            </a>
            @can('role-delete')
            <button type="button" class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fa-solid fa-trash"></i>
                Delete Role
            </button>
            @endcan
        </div>
    </div>
    @endcan
</div>

<!-- Delete Confirmation Modal -->
@can('role-delete')
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
                        <i class="fa-solid fa-shield-xmark" style="font-size: 1.5rem; color: #ef4444;"></i>
                    </div>
                    <h6 style="font-weight: 700; color: #111827; margin-bottom: 0.5rem;">Delete Role: {{ $role->name }}</h6>
                    <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Are you sure you want to delete this role? This action cannot be undone.</p>
                </div>
                <div style="background: #fef3c7; border: 2px solid #fbbf24; border-radius: 8px; padding: 0.875rem; margin-bottom: 1rem;">
                    <div style="font-size: 0.8rem; color: #78350f;">
                        <strong style="display: flex; align-items: center; gap: 0.375rem; margin-bottom: 0.5rem;">
                            <i class="fa-solid fa-exclamation-circle"></i>
                            Warning:
                        </strong>
                        <ul style="margin: 0; padding-left: 1.25rem; font-size: 0.75rem;">
                            <li>Role and all permissions will be permanently deleted</li>
                            <li>Users with this role will lose their permissions</li>
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
                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                        <i class="fa-solid fa-trash me-1"></i>
                        Delete Role
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endcan

@endsection
