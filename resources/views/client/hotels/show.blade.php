<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
    @include('client.layouts.header')

    <main class="container-lg my-4">
        @yield('content')
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="row g-0">
                <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                    <div>
                        <h1 class="text-success mb-3">{{ $hotel->name }}</h1>

                        <h5 class="mt-3 my-3">
                            {{ __('app.address') }}: {{ $hotel->address }}
                        </h5>

                        <div class="mb-3">
                            <span class="badge bg-warning text-dark fs-6 me-2">
                                <i class="bi bi-star-fill"></i> {{ $hotel->rating }}
                            </span>
                            <span class="text-muded fs-6">
                                <i class="bi bi-phone"></i> {{ $hotel->phone }}
                            </span>
                        </div>

                        <h5 class="mt-3">
                            {{ __('app.description') }}
                        </h5>
                        <p class="text-secondary">
                            {{ $hotel->description }}
                        </p>

                        <div class="mt-3">
                            {{ __('app.email') }}: {{ $hotel->email }}
                        </div>
                    </div>

                    <div class="mt-4">
                        @php($hotel->rooms->each->refreshAvailability())
                        @if($hotel->hasFreeRooms())
                            <a href="{{ route('reservations.create', $hotel) }}" class="btn btn-success btn-lg w-100">
                                {{ __('app.make_a_reservation') }}
                            </a>
                        @else
                            <button class="btn btn-danger btn-lg w-100" disabled>{{ __('app.no_free_rooms') }}</button>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                    <img src="{{ asset('img/images.jfif') }}" class="rounded-3" alt="">
                </div>
            </div>
        </div>
    </main>
</body>
</html>