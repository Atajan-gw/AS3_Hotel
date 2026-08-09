<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.admin_dashboard') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body class="bg-light">
    @include('client.app.navbar')

    <div class="container py-4">
        <div class="mb-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm me-2">{{ __('app.dashboard') }}</a>
            <a href="{{ route('admin.hotels.index') }}" class="btn btn-outline-secondary btn-sm me-2">{{ __('app.hotels') }}</a>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('app.bookings') }}</a>
        </div>
        @yield('content')
    </div>
</body>
</html>
