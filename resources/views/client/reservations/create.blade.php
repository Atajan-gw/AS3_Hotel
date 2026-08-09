<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.make_a_reservation') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body class="bg-light">
    @include('client.layouts.header')

    <main class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="mb-4">{{ __('app.make_a_reservation_for', ['name' => $hotel->name]) }}</h1>

                @if($rooms->isEmpty())
                    <div class="alert alert-warning">{{ __('app.no_free_rooms_now') }}</div>
                @else
                    <form method="POST" action="{{ route('reservations.store', $hotel) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.select_room') }}</label>
                            <select name="room_id" class="form-select" required>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->number }} — {{ $room->type }} — ${{ $room->price_per_night }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row g-3">
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

                        <button type="submit" class="btn btn-success mt-4">{{ __('app.reserve') }}</button>
                    </form>
                @endif
            </div>
        </div>
    </main>
</body>
</html>
