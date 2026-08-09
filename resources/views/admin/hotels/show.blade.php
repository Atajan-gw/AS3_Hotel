@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $hotel->name }}</h1>
    <a href="{{ route('admin.hotels.index') }}" class="btn btn-secondary">{{ __('app.back') }}</a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <p><strong>{{ __('app.slug') }}:</strong> {{ $hotel->slug }}</p>
        <p><strong>{{ __('app.description') }}:</strong> {{ $hotel->description }}</p>
        <p><strong>{{ __('app.address') }}:</strong> {{ $hotel->address }}</p>
        <p><strong>{{ __('app.rating') }}:</strong> {{ $hotel->rating }}</p>
        <p><strong>{{ __('app.phone') }}:</strong> {{ $hotel->phone }}</p>
        <p><strong>{{ __('app.email') }}:</strong> {{ $hotel->email }}</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h3>{{ __('app.rooms') }}</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('app.number') }}</th>
                    <th>{{ __('app.type') }}</th>
                    <th>{{ __('app.capacity') }}</th>
                    <th>{{ __('app.price') }}</th>
                    <th>{{ __('app.status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hotel->rooms as $room)
                    @php($room->refreshAvailability())
                    <tr>
                        <td>{{ $room->number }}</td>
                        <td>{{ $room->type }}</td>
                        <td>{{ $room->capacity }}</td>
                        <td>{{ $room->price_per_night }}</td>
                        <td>
                            @if($room->is_available)
                                <span class="badge bg-success">{{ __('app.empty') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('app.filled') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
