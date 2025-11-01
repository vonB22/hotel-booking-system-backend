@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card shadow-sm">
				<div class="card-header">Edit Booking</div>
				<div class="card-body">
					<form method="POST" action="{{ route('bookings.update', $booking->id) }}">
						@csrf
						@method('PUT')

						<div class="mb-3">
							<label class="form-label">Hotel</label>
							<select name="product_id" class="form-control">
								<option value="">-- Select Hotel (optional) --</option>
								@foreach($hotels as $id => $name)
								<option value="{{ $id }}" {{ (old('product_id', $booking->product_id) == $id) ? 'selected' : '' }}>{{ $name }}</option>
								@endforeach
							</select>
							@error('product_id')<div class="text-danger small">{{ $message }}</div>@enderror
						</div>

						<div class="row">
							<div class="col-md-6 mb-3">
								<label class="form-label">Check-in</label>
								<input type="date" name="check_in" class="form-control" value="{{ old('check_in', $booking->check_in) }}" required>
								@error('check_in')<div class="text-danger small">{{ $message }}</div>@enderror
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Check-out</label>
								<input type="date" name="check_out" class="form-control" value="{{ old('check_out', $booking->check_out) }}" required>
								@error('check_out')<div class="text-danger small">{{ $message }}</div>@enderror
							</div>
						</div>

						<div class="mb-3">
							<label class="form-label">Guests</label>
							<input type="number" min="1" name="guests" class="form-control" value="{{ old('guests', $booking->guests) }}" required>
							@error('guests')<div class="text-danger small">{{ $message }}</div>@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Notes</label>
							<textarea name="notes" class="form-control">{{ old('notes', $booking->notes) }}</textarea>
						</div>

						<div class="mb-3">
							<label class="form-label">Status</label>
							<select name="status" class="form-control">
								<option value="pending" {{ (old('status', $booking->status) == 'pending') ? 'selected' : '' }}>Pending</option>
								<option value="confirmed" {{ (old('status', $booking->status) == 'confirmed') ? 'selected' : '' }}>Confirmed</option>
								<option value="cancelled" {{ (old('status', $booking->status) == 'cancelled') ? 'selected' : '' }}>Cancelled</option>
							</select>
						</div>

						<div class="d-flex justify-content-end">
							<a href="{{ route('bookings.index') }}" class="btn btn-secondary me-2">Cancel</a>
							<button class="btn btn-primary">Update Booking</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
 </div>
@endsection

