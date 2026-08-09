@extends('admin.layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="mb-4">{{ __('app.add_booking') }}</h1>
        <form method="POST" action="{{ route('admin.bookings.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.room') }}</label>
                    <select name="room_id" class="form-select" required>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->hotel->name }} - {{ $room->number }} - {{ $room->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.status') }}</label>
                    <select name="status" class="form-select" required>
                        <option value="confirmed">{{ __('app.confirmed') }}</option>
                        <option value="pending">{{ __('app.pending') }}</option>
                        <option value="cancelled">{{ __('app.cancelled') }}</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.first_name') }}</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.last_name') }}</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.email') }}</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.phone') }}</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.check_in') }}</label>
                    <input type="date" name="check_in" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.check_out') }}</label>
                    <input type="date" name="check_out" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.guests_count') }}</label>
                    <input type="number" name="guests_count" class="form-control" min="1" max="10" value="1" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">{{ __('app.special_requests') }}</label>
                    <textarea name="special_requests" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4">{{ __('app.save') }}</button>
        </form>
    </div>
</div>
@endsection
