@extends('layouts.app')

@section('content')
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
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
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

    .create-btn {
        background: white;
        color: #667eea;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .create-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: #667eea;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        border: 2px solid #10b981;
        border-radius: 12px;
        color: #059669;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: slideDown 0.4s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stats-bar {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 0.875rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 10px;
        flex: 1;
        min-width: 120px;
    }

    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.9rem;
    }

    .stat-content {
        display: flex;
        flex-direction: column;
    }

    .stat-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.65rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 0.125rem;
    }

    .search-section {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input {
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        padding: 0.5rem 0.75rem 0.5rem 2.5rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .search-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
    }

    .filter-select {
        border-radius: 12px;
        border: 2px solid #e5e7eb;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .table-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #9ca3af;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }

    .table {
        margin-bottom: 0;
        min-width: 800px;
    }

    .table thead {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table thead th {
        border-bottom: 2px solid #e5e7eb;
        color: #374151;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.65rem;
        letter-spacing: 0.05em;
        padding: 0.875rem 0.75rem;
        white-space: nowrap;
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f3f4f6;
    }

    .table tbody tr:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.03) 0%, rgba(118, 75, 162, 0.03) 100%);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
    }

    .table tbody td {
        padding: 0.875rem 0.75rem;
        vertical-align: middle;
        font-size: 0.8rem;
    }

    /* Mobile Card View */
    .user-card-mobile {
        display: none;
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
    }

    .user-card-mobile:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .user-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.875rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f3f4f6;
    }

    .user-card-body {
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
        margin-bottom: 0.875rem;
    }

    .user-card-field {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .user-card-label {
        font-size: 0.65rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    .user-card-value {
        font-size: 0.8rem;
        color: #111827;
        font-weight: 500;
    }

    .user-card-roles {
        display: flex;
        flex-wrap: wrap;
        gap: 0.375rem;
    }

    .user-card-actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid #f3f4f6;
    }

    .user-card-actions .action-btn {
        flex: 1;
        justify-content: center;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.85rem;
        box-shadow: 0 3px 8px rgba(102, 126, 234, 0.3);
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.05rem;
        font-size: 0.85rem;
    }

    .user-email {
        font-size: 0.7rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.375rem 0.75rem;
        border-radius: 14px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
    }

    .role-badge i {
        font-size: 0.65rem;
    }

    .role-admin {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(220, 38, 38, 0.15) 100%);
        color: #dc2626;
        border: 2px solid rgba(220, 38, 38, 0.3);
    }

    .role-user {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%);
        color: #059669;
        border: 2px solid rgba(5, 150, 105, 0.3);
    }

    .role-default {
        background: linear-gradient(135deg, rgba(107, 114, 128, 0.15) 0%, rgba(75, 85, 99, 0.15) 100%);
        color: #4b5563;
        border: 2px solid rgba(75, 85, 99, 0.3);
    }

    .action-btn {
        border-radius: 8px;
        padding: 0.5rem 0.875rem;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid;
    }

    .btn-view {
        background: rgba(59, 130, 246, 0.1);
        border-color: #3b82f6;
        color: #3b82f6;
    }

    .btn-view:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-edit {
        background: rgba(102, 126, 234, 0.1);
        border-color: #667eea;
        color: #667eea;
    }

    .btn-edit:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        border-color: #ef4444;
        color: #ef4444;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 1.5rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        padding: 1.5rem;
        border-top: 1px solid #f3f4f6;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        opacity: 0.5;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-state h4 {
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .no-actions {
        color: #9ca3af;
        font-style: italic;
        font-size: 0.875rem;
    }

    .delete-warning {
        background: rgba(239, 68, 68, 0.1);
        border-left: 4px solid #ef4444;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
    }

    .delete-warning i {
        color: #ef4444;
    }

    @media (max-width: 992px) {
        .table {
            min-width: 700px;
        }
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

        .stats-bar {
            flex-direction: column;
            gap: 0.75rem;
        }

        .stat-item {
            min-width: auto;
        }

        .action-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.65rem;
        }

        .search-section .row {
            gap: 0.75rem;
        }

        /* Hide table, show cards on mobile */
        .table-responsive {
            display: none !important;
        }

        .user-card-mobile {
            display: block !important;
        }

        .table-card .p-4 {
            padding: 1rem !important;
        }
    }

    @media (max-width: 576px) {
        .create-btn {
            width: 100%;
            justify-content: center;
        }

        .page-header .d-flex {
            flex-direction: column;
            gap: 1rem;
        }

        .user-card-actions {
            flex-direction: column;
        }

        .user-card-actions .action-btn {
            width: 100%;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>
                    <i class="fa-solid fa-users"></i>
                    Users Management
                </h2>
                <p>Manage user accounts, roles, and permissions</p>
            </div>
            @role('Admin')
            <a href="{{ route('users.create') }}" class="create-btn">
                <i class="fa-solid fa-user-plus"></i>
                Create New User
            </a>
            @endrole
        </div>
    </div>

    <!-- Success Alert -->
    @session('success')
    <div class="alert-success">
        <i class="fa-solid fa-circle-check fa-lg"></i>
        <span>{{ $value }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endsession

    <!-- Statistics Bar -->
    <div class="stats-bar">
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $data->total() }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $data->filter(function($user) { return $user->hasRole('Admin'); })->count() }}</div>
                <div class="stat-label">Administrators</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $data->filter(function($user) { return $user->hasRole('User'); })->count() }}</div>
                <div class="stat-label">Regular Users</div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="row g-3">
            <div class="col-md-8">
                <div class="search-input-wrapper">
                    <i class="fa-solid fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search by name, email, or role...">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select filter-select" id="roleFilter">
                    <option value="">All Roles</option>
                    <option value="admin">Administrators</option>
                    <option value="user">Regular Users</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="table-card">
        @if($data->count() > 0)
        <!-- Desktop Table View -->
        <div class="table-responsive">
            <table class="table" id="usersTable">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th style="min-width: 180px;">User</th>
                        <th style="min-width: 200px;">Email</th>
                        <th style="min-width: 160px;">Roles</th>
                        <th style="min-width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                    <tr data-roles="{{ $user->getRoleNames()->map(function($role) { return strtolower($role); })->join(',') }}" data-id="{{ $user->id }}">
                        <td><strong>#{{ $user->id }}</strong></td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="user-details">
                                    <div class="user-name">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-email">
                                <i class="fa-solid fa-envelope"></i>
                                {{ $user->email }}
                            </div>
                        </td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    @php
                                    switch (strtolower($v)) {
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
                                        {{ ucfirst($v) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="role-badge role-default">
                                    <i class="fa-solid fa-circle-user"></i>
                                    No Role
                                </span>
                            @endif
                        </td>
                        <td>
                            @role('Admin')
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('users.show', $user->id) }}" class="btn action-btn btn-view" title="View User">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn action-btn btn-edit" title="Edit User">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn action-btn btn-delete" title="Delete User"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-user-id="{{ $user->id }}" 
                                    data-user-name="{{ $user->name }}"
                                    data-user-email="{{ $user->email }}"
                                    data-user-url="{{ route('users.destroy', $user->id) }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                            @else
                            <span class="no-actions">No actions available</span>
                            @endrole
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div id="usersCardView">
            @foreach ($data as $user)
            <div class="user-card-mobile" data-roles="{{ $user->getRoleNames()->map(function($role) { return strtolower($role); })->join(',') }}" data-id="{{ $user->id }}">
                <div class="user-card-header">
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div class="user-details">
                            <div class="user-name">{{ $user->name }}</div>
                            <div class="user-email">
                                <i class="fa-solid fa-envelope"></i>
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user-card-body">
                    <div class="user-card-field">
                        <div class="user-card-label">
                            <i class="fa-solid fa-hashtag"></i> User ID
                        </div>
                        <div class="user-card-value">#{{ $user->id }}</div>
                    </div>

                    <div class="user-card-field">
                        <div class="user-card-label">
                            <i class="fa-solid fa-shield-halved"></i> Roles
                        </div>
                        <div class="user-card-roles">
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    @php
                                    switch (strtolower($v)) {
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
                                        {{ ucfirst($v) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="role-badge role-default">
                                    <i class="fa-solid fa-circle-user"></i>
                                    No Role
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                @role('Admin')
                <div class="user-card-actions">
                    <a href="{{ route('users.show', $user->id) }}" class="btn action-btn btn-view">
                        <i class="fa-solid fa-eye"></i>
                        View
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn action-btn btn-edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit
                    </a>
                    <button type="button" class="btn action-btn btn-delete"
                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                        data-user-id="{{ $user->id }}" 
                        data-user-name="{{ $user->name }}"
                        data-user-email="{{ $user->email }}"
                        data-user-url="{{ route('users.destroy', $user->id) }}">
                        <i class="fa-solid fa-trash"></i>
                        Delete
                    </button>
                </div>
                @else
                <div class="user-card-actions">
                    <span class="no-actions">No actions available</span>
                </div>
                @endrole
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($data->hasPages())
        <div class="p-4 border-top">
            <div class="d-flex justify-content-between align-items-center">
                <!-- <div class="text-muted small"> -->
                <div class="text-white small">
                    Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} users
                </div>
                {!! $data->links('pagination::bootstrap-5') !!}
            </div>
        </div>
        @endif
        @else
        <div class="empty-state">
            <i class="fa-solid fa-users-slash"></i>
            <h4>No Users Found</h4>
            <p class="mb-4">There are no users to display at the moment.</p>
            @role('Admin')
            <a href="{{ route('users.create') }}" class="create-btn">
                <i class="fa-solid fa-user-plus"></i>
                Create Your First User
            </a>
            @endrole
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    Confirm User Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Are you sure you want to delete this user?</p>
                <div class="user-info mb-3">
                    <div class="user-avatar" id="deleteUserAvatar" style="width: 56px; height: 56px; font-size: 1.25rem;"></div>
                    <div class="user-details">
                        <div class="user-name" id="deleteUserName"></div>
                        <div class="user-email" id="deleteUserEmail"></div>
                    </div>
                </div>
                <div class="delete-warning">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. All user data will be permanently deleted.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark me-1"></i>
                    Cancel
                </button>
                <form id="deleteForm" method="POST" action="" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash me-1"></i>
                        Yes, Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Delete Modal Handler
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const userId = button.getAttribute('data-user-id');
                const userName = button.getAttribute('data-user-name');
                const userEmail = button.getAttribute('data-user-email');
                const url = button.getAttribute('data-user-url');

                const form = document.getElementById('deleteForm');
                const nameEl = document.getElementById('deleteUserName');
                const emailEl = document.getElementById('deleteUserEmail');
                const avatarEl = document.getElementById('deleteUserAvatar');

                form.action = url || '';
                nameEl.textContent = userName;
                emailEl.innerHTML = `<i class="fa-solid fa-envelope"></i> ${userEmail}`;
                avatarEl.textContent = userName.charAt(0).toUpperCase();
            });
        }

        // Combined filter function for both table and cards
        function filterUsers() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const roleFilter = document.getElementById('roleFilter').value.toLowerCase();
            
            // Filter table rows
            const rows = document.querySelectorAll('#usersTable tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const roles = row.dataset.roles || '';
                const matchesSearch = text.includes(searchTerm);
                const matchesRole = roleFilter === '' || roles.includes(roleFilter);
                row.style.display = (matchesSearch && matchesRole) ? '' : 'none';
            });
            
            // Filter mobile cards
            const cards = document.querySelectorAll('.user-card-mobile');
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                const roles = card.dataset.roles || '';
                const matchesSearch = text.includes(searchTerm);
                const matchesRole = roleFilter === '' || roles.includes(roleFilter);
                card.style.display = (matchesSearch && matchesRole) ? '' : 'none';
            });
        }

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', filterUsers);
        }

        // Role filter
        const roleFilter = document.getElementById('roleFilter');
        if (roleFilter) {
            roleFilter.addEventListener('change', filterUsers);
        }

        // Auto-dismiss alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert-success');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);

        // Add row animation on load
        const rows = document.querySelectorAll('#usersTable tbody tr');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(10px)';
            setTimeout(() => {
                row.style.transition = 'all 0.4s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 50);
        });
    });
</script>
@endpush
