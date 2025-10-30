@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card shadow-sm">
				<div class="card-header">Booking Details</div>
				<div class="card-body">
					<p><strong>User:</strong> {{ $booking->user->name ?? '—' }}</p>
					<p><strong>Hotel:</strong> {{ $booking->product->name ?? '—' }}</p>
					<p><strong>Check-in:</strong> {{ $booking->check_in }}</p>
					<p><strong>Check-out:</strong> {{ $booking->check_out }}</p>
					<p><strong>Guests:</strong> {{ $booking->guests }}</p>
					<p><strong>Notes:</strong><br>{{ $booking->notes ?? '—' }}</p>
					<p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
					<div class="d-flex justify-content-end">
						<a href="{{ route('bookings.index') }}" class="btn btn-secondary me-2">Back</a>
						@if(auth()->user()->hasRole('Admin') || auth()->id() === $booking->user_id)
						<a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-primary">Edit</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>
@endsection

