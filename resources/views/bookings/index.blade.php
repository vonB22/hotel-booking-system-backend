@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h3 class="mb-0"><i class="fa-solid fa-calendar-check me-2"></i>Bookings</h3>
		<a href="{{ route('bookings.create') }}" class="btn btn-success btn-sm">Create Booking</a>
	</div>

	@if(session('success'))
	<div class="alert alert-success">{{ session('success') }}</div>
	@endif

	<div class="card shadow-sm border-0">
		<div class="card-body p-0">
			<div class="table-responsive">
				<table class="table table-hover mb-0 align-middle">
					<thead class="table-light">
						<tr>
							<th>#</th>
							<th>User</th>
							<th>Hotel</th>
							<th>Check-in</th>
							<th>Check-out</th>
							<th>Guests</th>
							<th>Status</th>
							<th style="width:160px">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($bookings as $booking)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $booking->user->name ?? '—' }}</td>
							<td>{{ $booking->product->name ?? '—' }}</td>
							<td>{{ $booking->check_in }}</td>
							<td>{{ $booking->check_out }}</td>
							<td>{{ $booking->guests }}</td>
							<td><span class="badge bg-secondary-subtle text-secondary">{{ ucfirst($booking->status) }}</span></td>
							<td>
								<div class="d-flex gap-2">
									<a href="{{ route('bookings.show',$booking->id) }}" class="btn btn-sm btn-outline-info">View</a>
									@if(auth()->user()->hasRole('Admin') || auth()->id() === $booking->user_id)
									<a href="{{ route('bookings.edit',$booking->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
									<form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Delete booking?');">
										@csrf
										@method('DELETE')
										<button class="btn btn-sm btn-outline-danger">Delete</button>
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
@endsection
