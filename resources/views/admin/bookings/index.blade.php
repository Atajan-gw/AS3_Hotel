@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('app.bookings') }}</h1>
    <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">{{ __('app.add_booking') }}</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('app.guest') }}</th>
                    <th>{{ __('app.hotels') }}</th>
                    <th>{{ __('app.room') }}</th>
                    <th>{{ __('app.check_in') }}</th>
                    <th>{{ __('app.check_out') }}</th>
                    <th>{{ __('app.status') }}</th>
                    <th>{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->guest->full_name ?? $booking->guest->first_name }}</td>
                        <td>{{ $booking->room->hotel->name ?? '-' }}</td>
                        <td>{{ $booking->room->number ?? '-' }}</td>
                        <td>{{ $booking->check_in }}</td>
                        <td>{{ $booking->check_out }}</td>
                        <td>{{ $booking->display_status }}</td>
                        <td>
                            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">{{ __('app.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
