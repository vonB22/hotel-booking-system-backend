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

    .permission-selection {
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.875rem;
        max-height: 400px;
        overflow-y: auto;
    }

    .permission-selection::-webkit-scrollbar {
        width: 6px;
    }

    .permission-selection::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 3px;
    }

    .permission-selection::-webkit-scrollbar-thumb {
        background: #9ca3af;
        border-radius: 3px;
    }

    .permission-group {
        margin-bottom: 0.75rem;
    }

    .permission-group:last-child {
        margin-bottom: 0;
    }

    .permission-group-title {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #667eea;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
        padding-bottom: 0.375rem;
        border-bottom: 2px solid #e5e7eb;
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

    .select-all-wrapper {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border: 2px solid #667eea;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .select-all-check {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .select-all-check input {
        width: 1.25rem;
        height: 1.25rem;
    }

    .select-all-check label {
        font-size: 0.9rem;
        font-weight: 700;
        color: #667eea;
        margin: 0;
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

    .required-indicator {
        color: #ef4444;
        margin-left: 0.125rem;
    }

    .form-section-divider {
        margin: 1.25rem 0;
        border: 0;
        border-top: 2px dashed #e5e7eb;
    }

    .info-badge {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .info-badge i {
        color: #3b82f6;
        font-size: 1rem;
        margin-top: 0.125rem;
    }

    .info-badge-content {
        flex: 1;
    }

    .info-badge-title {
        font-weight: 600;
        font-size: 0.8rem;
        color: #1e40af;
        margin-bottom: 0.25rem;
    }

    .info-badge-text {
        font-size: 0.75rem;
        color: #1e40af;
        margin: 0;
    }

    .permission-count {
        background: #667eea;
        color: white;
        padding: 0.25rem 0.625rem;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 700;
        margin-left: auto;
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
                    <i class="fa-solid fa-shield-plus"></i>
                    Create New Role
                </h2>
                <p class="mb-0">Add a new role with custom permissions</p>
            </div>
            <a class="back-btn" href="{{ route('roles.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Roles
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

    <!-- Create Role Form -->
    <div class="form-card">
        <div class="form-card-header">
            <h5>
                <i class="fa-solid fa-user-shield"></i>
                Role Information
            </h5>
        </div>
        <div class="form-card-body">
            <form method="POST" action="{{ route('roles.store') }}" id="createRoleForm">
                @csrf
                
                <!-- Role Name Section -->
                <div class="row g-3">
                    <div class="col-12">
                        <label for="name" class="form-label">
                            <i class="fa-solid fa-tag"></i>
                            Role Name
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name') }}" 
                            placeholder="Enter role name (e.g., Manager, Editor)" 
                            class="form-control" 
                            required
                            autocomplete="off">
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Choose a descriptive name for this role
                        </small>
                    </div>

                    <div class="col-12">
                        <hr class="form-section-divider">
                    </div>

                    <!-- Permissions Section -->
                    <div class="col-12">
                        <label class="form-label">
                            <i class="fa-solid fa-key"></i>
                            Assign Permissions
                            <span class="required-indicator">*</span>
                            <span class="permission-count" id="permissionCount">0 selected</span>
                        </label>
                        
                        <div class="info-badge">
                            <i class="fa-solid fa-lightbulb"></i>
                            <div class="info-badge-content">
                                <div class="info-badge-title">Permission Management</div>
                                <p class="info-badge-text">Select the permissions that users with this role should have. You can select all permissions at once using the checkbox below.</p>
                            </div>
                        </div>

                        <!-- Select All -->
                        <div class="select-all-wrapper">
                            <div class="select-all-check">
                                <input 
                                    type="checkbox" 
                                    id="selectAll" 
                                    class="form-check-input">
                                <label for="selectAll" class="form-check-label">
                                    <i class="fa-solid fa-check-double me-1"></i>
                                    Select All Permissions
                                </label>
                            </div>
                        </div>

                        <div class="permission-selection">
                            @php
                                $groupedPermissions = [];
                                foreach($permission as $perm) {
                                    // Extract the prefix (before the dash)
                                    $parts = explode('-', $perm->name);
                                    $group = $parts[0] ?? 'other';
                                    if (!isset($groupedPermissions[$group])) {
                                        $groupedPermissions[$group] = [];
                                    }
                                    $groupedPermissions[$group][] = $perm;
                                }
                                ksort($groupedPermissions);
                            @endphp

                            @foreach($groupedPermissions as $group => $perms)
                                <div class="permission-group">
                                    <div class="permission-group-title">
                                        <i class="fa-solid fa-folder me-1"></i>
                                        {{ ucfirst($group) }} Permissions
                                    </div>
                                    @foreach($perms as $perm)
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input permission-checkbox" 
                                                type="checkbox" 
                                                name="permission[{{ $perm->id }}]" 
                                                value="{{ $perm->id }}" 
                                                id="permission-{{ $perm->id }}"
                                                {{ in_array($perm->id, old('permission', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission-{{ $perm->id }}">
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
                                                <i class="fa-solid {{ $icon }} me-1" style="color: #667eea; font-size: 0.75rem;"></i>
                                                {{ $perm->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        
                        <small class="text-muted d-block mt-2" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Select at least one permission for the role
                        </small>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-shield-plus"></i>
                            Create Role
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Select All functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
    const permissionCount = document.getElementById('permissionCount');

    // Update permission count
    function updatePermissionCount() {
        const checkedCount = document.querySelectorAll('.permission-checkbox:checked').length;
        const totalCount = permissionCheckboxes.length;
        permissionCount.textContent = `${checkedCount} of ${totalCount} selected`;
        
        // Update select all checkbox state
        selectAllCheckbox.checked = checkedCount === totalCount;
        selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < totalCount;
    }

    // Select all checkbox handler
    selectAllCheckbox.addEventListener('change', function() {
        permissionCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updatePermissionCount();
    });

    // Individual checkbox handler
    permissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updatePermissionCount);
    });

    // Initial count update
    updatePermissionCount();

    // Form validation
    document.getElementById('createRoleForm').addEventListener('submit', function(e) {
        const roleName = document.getElementById('name').value.trim();
        const checkedPermissions = document.querySelectorAll('.permission-checkbox:checked');
        
        if (!roleName) {
            e.preventDefault();
            alert('Please enter a role name.');
            document.getElementById('name').focus();
            return false;
        }

        if (checkedPermissions.length === 0) {
            e.preventDefault();
            alert('Please select at least one permission for this role.');
            return false;
        }
    });

    // Role name formatting (capitalize first letter)
    document.getElementById('name').addEventListener('blur', function() {
        if (this.value) {
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        }
    });
</script>

@endsection
