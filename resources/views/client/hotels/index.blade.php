<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') {{ __('app.hotels') }}</title>
</head>

<body>
    @include('client.layouts.app')

    <main>
        @yield('content')

        <div class="container-lg bg-light">
            <div class="h1 text-success my-3">
                {{ __('app.hotels') }}
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('hotels.index') }}" method="GET" class="search-form row g-3">
                        <div class="col">
                            <label for="search" class="form-label">{{ __('app.search') }}</label>
                            <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('app.search') }}">
                        </div>
                        <div class="col">
                            <label for="city" class="form-label">{{ __('app.city') }}</label>
                            <select name="city_id" id="city_id" class="form-select">
                                <option value="">{{ __('app.city') }}</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="rating" class="form-label">{{ __('app.any_rating') }}</label>
                            <select class="form-select" name="min_rating" id="">
                                <option value="">{{ __('app.any_rating') }}</option>
                                <option value="3">{{ request('min_rating') == '3' ? 'selected' : '' }}3+ {{ __('app.stars') }}</option>
                                <option value="4">{{ request('min_rating') == '4' ? 'selected' : '' }}4+ {{ __('app.stars') }}</option>
                                <option value="5">{{ request('min_rating') == '5' ? 'selected' : '' }}5+ {{ __('app.stars') }}</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="sort" class="form-label">{{ __('app.without_sorting') }}</label>
                            <select class="form-select" name="sort" id="">
                                <option value="">{{ __('app.without_sorting') }}</option>
                                <option value="rating_desc">{{ request('sort') == 'rating_desc' ? 'selected' : '' }}
                                    {{ __('app.rating_in_descending_order') }}
                                </option>
                                <option value="rating_asc">{{ request('sort') == 'rating_asc' ? 'selected' : '' }}
                                    {{ __('app.rating_ascending') }}
                                </option>
                            </select>
                        </div>
                        <div class="col align-items-end d-flex">
                            <button type="submit" class="w-100 btn btn-success">
                                {{ __('app.search') }}
                            </button>
                        </div>
                        <div class="col d-flex align-items-end">
                            <a href="{{ route('hotels.index') }}" class="btn btn-warning w-100">{{ __('app.reset') }}</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row g-3">
                @foreach($hotels as $hotel)
                <div class="col-lg-2">
                    <div class="position-relative border border-1 border-secondary p-2 rounded-3 h-100 d-flex flex-column">
                        <div>
                            <img src="{{ asset('img/images.jfif') }}" class="w-100 rounded-3" alt="">
                        </div>
                        <div class="h3 text-success mt-2">
                            {{ $hotel->name }}
                        </div>
                        <div class="small mb-2 mt-auto">
                            <i class="bi bi-star"></i> <span>{{ $hotel->rating }}</span>
                            <i class="bi bi-phone ms-2"></i> {{ $hotel->phone }}
                        </div>
                        @if($hotel->hasFreeRooms())
                        <span class="badge bg-success mb-2">{{ __('app.free_rooms_available') }}</span>
                        @else
                        <span class="badge bg-danger mb-2">{{ __('app.fully_booked') }}</span>
                        @endif
                        <a class="btn btn-success w-100" href="{{ route('hotels.show', $hotel->id) }}">
                            {{ __('app.view') }}
                        </a>
                    </div>
                </div>
                @endforeach
                {{ $hotels->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
</body>

</html>