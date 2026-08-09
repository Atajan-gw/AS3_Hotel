<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.admin_dashboard') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body class="bg-light">
    @include('admin.app.navbar')

    <div class="container py-4">
        @yield('content')
    </div>
</body>
</html>
