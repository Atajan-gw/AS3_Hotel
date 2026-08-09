<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Hotels</title>
</head>

<body>
    @include('client.layouts.header')

    <main>
        @yield('content')

        <div class="container-lg bg-light">
            <div class="h1 text-success my-3">
                {{ __('app.hotels') }}
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