<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.login') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

@include('client.layouts.app')
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="mb-4 text-center">{{ __('app.login') }}</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">{{ __('app.username') }}</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('app.password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label class="form-check-label" for="remember">{{ __('app.remember_me') }}</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">{{ __('app.login') }}</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('register') }}">{{ __('app.register') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
