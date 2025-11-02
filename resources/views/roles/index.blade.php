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
        min-width: 600px;
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
    .role-card-mobile {
        display: none;
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
    }

    .role-card-mobile:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .role-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.875rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f3f4f6;
    }

    .role-card-body {
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
        margin-bottom: 0.875rem;
    }

    .role-card-field {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .role-card-label {
        font-size: 0.65rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    .role-card-value {
        font-size: 0.8rem;
        color: #111827;
        font-weight: 500;
    }

    .role-card-actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid #f3f4f6;
    }

    .role-card-actions .action-btn {
        flex: 1;
        justify-content: center;
    }

    .role-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .role-icon {
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

    .role-details {
        display: flex;
        flex-direction: column;
    }

    .role-name {
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.05rem;
        font-size: 0.85rem;
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
            min-width: 550px;
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

        .role-card-mobile {
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

        .role-card-actions {
            flex-direction: column;
        }

        .role-card-actions .action-btn {
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
                    <i class="fa-solid fa-user-shield"></i>
                    Role Management
                </h2>
                <p>Manage system roles and permissions</p>
            </div>
            @can('role-create')
            <a href="{{ route('roles.create') }}" class="create-btn">
                <i class="fa-solid fa-plus"></i>
                Create New Role
            </a>
            @endcan
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert-success">
        <i class="fa-solid fa-circle-check fa-lg"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Statistics Bar -->
    <div class="stats-bar">
        <div class="stat-item">
            <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $roles->total() }}</div>
                <div class="stat-label">Total Roles</div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="search-input-wrapper">
            <i class="fa-solid fa-search search-icon"></i>
            <input type="text" id="searchInput" class="search-input" placeholder="Search roles by name...">
        </div>
    </div>

    <!-- Roles Table -->
    <div class="table-card">
        @if($roles->count() > 0)
        <!-- Desktop Table View -->
        <div class="table-responsive">
            <table class="table" id="rolesTable">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Role Name</th>
                        <th style="min-width: 220px; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                    <tr data-id="{{ $role->id }}">
                        <td><strong>#{{ $loop->iteration }}</strong></td>
                        <td>
                            <div class="role-info">
                                <div class="role-icon">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </div>
                                <div class="role-details">
                                    <div class="role-name">{{ $role->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="{{ route('roles.show', $role->id) }}" class="btn action-btn btn-view" title="View Role">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @can('role-edit')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn action-btn btn-edit" title="Edit Role">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @endcan
                                @can('role-delete')
                                <button type="button" class="btn action-btn btn-delete" title="Delete Role"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-role-id="{{ $role->id }}" 
                                    data-role-name="{{ $role->name }}"
                                    data-role-url="{{ route('roles.destroy', $role->id) }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div id="rolesCardView">
            @foreach ($roles as $role)
            <div class="role-card-mobile" data-id="{{ $role->id }}">
                <div class="role-card-header">
                    <div class="role-info">
                        <div class="role-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="role-details">
                            <div class="role-name">{{ $role->name }}</div>
                        </div>
                    </div>
                </div>

                <div class="role-card-body">
                    <div class="role-card-field">
                        <div class="role-card-label">
                            <i class="fa-solid fa-hashtag"></i> Role ID
                        </div>
                        <div class="role-card-value">#{{ $loop->iteration }}</div>
                    </div>
                </div>

                <div class="role-card-actions">
                    <a href="{{ route('roles.show', $role->id) }}" class="btn action-btn btn-view">
                        <i class="fa-solid fa-eye"></i>
                        View
                    </a>
                    @can('role-edit')
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn action-btn btn-edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit
                    </a>
                    @endcan
                    @can('role-delete')
                    <button type="button" class="btn action-btn btn-delete"
                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                        data-role-id="{{ $role->id }}" 
                        data-role-name="{{ $role->name }}"
                        data-role-url="{{ route('roles.destroy', $role->id) }}">
                        <i class="fa-solid fa-trash"></i>
                        Delete
                    </button>
                    @endcan
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($roles->hasPages())
        <div class="p-4 border-top">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted" style="font-size: 0.875rem;">
                    Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }} roles
                </div>
                <div>
                    {!! $roles->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
        @endif

        @else
        <!-- Empty State -->
        <div class="empty-state">
            <i class="fa-solid fa-user-shield"></i>
            <h4>No roles found</h4>
            <p>There are no roles in the system yet.</p>
            @can('role-create')
            <a href="{{ route('roles.create') }}" class="btn btn-primary mt-3">
                <i class="fa-solid fa-plus me-2"></i>Create First Role
            </a>
            @endcan
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Are you sure you want to delete the role <strong id="roleName"></strong>?</p>
                <div class="delete-warning">
                    <i class="fa-solid fa-exclamation-circle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. All users with this role will lose their permissions.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash me-1"></i>Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Combined filter function for both table and cards
    function filterRoles() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        
        // Filter table rows
        const rows = document.querySelectorAll('#rolesTable tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
        
        // Filter mobile cards
        const cards = document.querySelectorAll('.role-card-mobile');
        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    }

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', filterRoles);
    }

    // Delete modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const roleId = button.getAttribute('data-role-id');
                const roleName = button.getAttribute('data-role-name');
                const form = document.getElementById('deleteForm');
                const nameDisplay = document.getElementById('roleName');

                // Prefer using the full URL provided on the button to avoid templating issues
                const url = button.getAttribute('data-role-url');
                form.action = url || '';
                nameDisplay.textContent = roleName;
            });
        }
    });
</script>

@endsection
