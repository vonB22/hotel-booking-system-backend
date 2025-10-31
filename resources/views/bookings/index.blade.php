@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h3 class="mb-0"><i class="fa-solid fa-calendar-check me-2"></i>Bookings</h3>
		<a href="{{ route('bookings.create') }}" class="btn btn-success btn-sm">
			<i class="fa-solid fa-plus me-1"></i> New Booking
		</a>
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
				<table class="table table-hover mb-0 align-middle text-nowrap">
					<thead class="table-light">
						<tr>
							<th>#</th>
							<th>User</th>
							<th>Hotel</th>
							<th>Check-in</th>
							<th>Check-out</th>
							<th>Guests</th>
							<th>Status</th>
							<th class="text-center" style="width:130px;">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($bookings as $booking)
						@php
							$status = strtolower($booking->status);
							$badgeClass = match($status) {
								'confirmed' => 'bg-success-subtle text-success',
								'pending' => 'bg-warning-subtle text-warning',
								'cancelled' => 'bg-danger-subtle text-danger',
								'checked-in' => 'bg-info-subtle text-info',
								'checked-out' => 'bg-secondary-subtle text-secondary',
								default => 'bg-light text-muted',
							};
						@endphp
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $booking->user->name ?? '—' }}</td>
							<td>{{ $booking->product->name ?? '—' }}</td>
							<td>{{ $booking->check_in }}</td>
							<td>{{ $booking->check_out }}</td>
							<td>{{ $booking->guests }}</td>
							<td>
								<span class="badge {{ $badgeClass }} px-3 py-2">
									{{ ucfirst($booking->status) }}
								</span>
							</td>
							<td class="text-center">
								<div class="d-flex justify-content-center gap-2">
									<a href="{{ route('bookings.show', $booking->id) }}"
									   class="btn btn-outline-info btn-sm"
									   data-bs-toggle="tooltip"
									   title="View Details">
										<i class="fa-solid fa-eye"></i>
									</a>

									@if(auth()->user()->hasRole('Admin') || auth()->id() === $booking->user_id)
										<a href="{{ route('bookings.edit', $booking->id) }}"
										   class="btn btn-outline-primary btn-sm"
										   data-bs-toggle="tooltip"
										   title="Edit Booking">
											<i class="fa-solid fa-pen-to-square"></i>
										</a>

										<form action="{{ route('bookings.destroy', $booking->id) }}"
											  method="POST"
											  class="d-inline"
											  onsubmit="return confirm('Delete booking?');">
											@csrf
											@method('DELETE')
											<button type="submit"
												class="btn btn-outline-danger btn-sm"
												data-bs-toggle="tooltip"
												title="Delete Booking">
												<i class="fa-solid fa-trash"></i>
											</button>
										</form>
									@endif
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		@if($bookings->hasPages())
			<div class="card-footer border-top py-3">
				{!! $bookings->links('pagination::bootstrap-5') !!}
			</div>
		@endif
	</div>
</div>

{{-- Enable Bootstrap tooltips --}}
@push('scripts')
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		tooltipTriggerList.map(function (tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl)
		})
	})
</script>
@endpush
@endsection
