@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-lg-12 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h2 class="mb-0"><i class="fa-solid fa-user-shield me-2"></i>Role Management</h2>
            @can('role-create')
            <a class="btn btn-success btn-sm shadow-sm d-flex align-items-center gap-1"
                href="{{ route('roles.create') }}">
                <i class="fa fa-plus"></i> <span>Create New Role</span>
            </a>
            @endcan
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Role Name</th>
                            <th class="text-center" style="width: 260px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $key => $role)
                        <tr>
                            <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                            <td class="fw-medium">{{ $role->name }}</td>
                            <td class="text-center">
                                <a class="btn btn-outline-info btn-sm me-1" href="{{ route('roles.show', $role->id) }}"
                                    title="View Role">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @can('role-edit')
                                <a class="btn btn-outline-primary btn-sm me-1"
                                    href="{{ route('roles.edit', $role->id) }}" title="Edit Role">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @endcan
                                @can('role-delete')
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-role-id="{{ $role->id }}"
                                    data-role-name="{{ $role->name }}" data-role-url="{{ route('roles.destroy', $role->id) }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                <i class="fa-solid fa-circle-exclamation me-2"></i> No roles found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {!! $roles->links('pagination::bootstrap-5') !!}
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete the role <strong id="roleName"></strong>?
                <p class="text-muted small mb-0">This action cannot be undone.</p>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash me-1"></i>Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteModal');
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
});
</script>
@endpush