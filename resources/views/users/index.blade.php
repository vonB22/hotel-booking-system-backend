@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="mb-0"> <i class="fa-solid fa-users me-2"></i>Users Management</h2>
            @role('Admin')
            <a class="btn btn-success btn-sm shadow-sm" href="{{ route('users.create') }}">
                <i class="fa fa-plus me-1"></i> Create New User
            </a>
            @endrole
        </div>
    </div>

    @session('success')
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fa fa-check-circle me-2"></i> {{ $value }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endsession

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th scope="col" style="width:60px;">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col" style="width:220px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                <span
                                    class="badge bg-success-subtle text-success border border-success-subtle me-1">{{ $v }}</span>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    @role('Admin')
                                    <a class="btn btn-outline-info btn-sm" href="{{ route('users.show',$user->id) }}"
                                        title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('users.edit',$user->id) }}"
                                        title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <!-- Delete trigger button -->
                                    <button type="button" class="btn btn-outline-danger btn-sm" title="Delete"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                        data-user-url="{{ route('users.destroy', $user->id) }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    @else
                                    <span class="text-muted fst-italic">No actions</span>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($data->hasPages())
        <div class="card-footer border-top py-3">
            {!! $data->links('pagination::bootstrap-5') !!}
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title fw-semibold" id="deleteModalLabel">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong id="deleteUserName"></strong>?
                <p class="text-muted small mb-0">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="">
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
        const userId = button.getAttribute('data-user-id');
        const userName = button.getAttribute('data-user-name');

    const form = document.getElementById('deleteForm');
    const userNameEl = document.getElementById('deleteUserName');

    // Prefer using the full URL provided on the button to avoid templating issues
    const url = button.getAttribute('data-user-url');
    form.action = url || '';
        userNameEl.textContent = userName;
    });
});
</script>
@endpush