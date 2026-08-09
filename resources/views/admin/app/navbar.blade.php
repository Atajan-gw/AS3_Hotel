<nav class="navbar navbar-expand-lg bg-success">
    <div class="container-fluid">
        <a class="navbar-brand h1 text-light" href="{{ route('hotels.index') }}">{{ __('app.brand_name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('app.toggle_navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-light h1" aria-current="page" href="{{ route('admin.dashboard') }}">
                        {{ __('app.dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-light h1" aria-current="page" href="{{ route('admin.hotels.index') }}">
                        {{ __('app.hotels') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-light h1" aria-current="page" href="{{ route('admin.bookings.index') }}">
                        {{ __('app.bookings') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-light h1" aria-current="page" href="{{ route('admin.users.index') }}">
                        {{ __('app.users') }}
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ app()->getLocale() }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('locale', 'en') }}">{{ __('app.lang_en') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('locale', 'tm') }}">{{ __('app.lang_tm') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('locale', 'ru') }}">{{ __('app.lang_ru') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>