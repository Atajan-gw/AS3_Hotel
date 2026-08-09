<nav class="navbar navbar-expand-lg bg-success">
    <div class="container-fluid">
        <a class="navbar-brand h1 text-light" href="{{ route('hotels.index') }}">BookNest</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-light h1" aria-current="page" href="{{ route('hotels.index') }}">
                        {{ __('app.hotels') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-light h1" aria-current="page" href="{{ route('hotels.search') }}">
                        {{ __('app.search') }}
                    </a>
                </li>
            </ul>
            <div class="d-flex">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ app()->getLocale() }}
                    </button>

                    <ul class="dropdown-menu  dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('locale', 'en') }}">{{ __('app.lang_en') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('locale', 'tm') }}">{{ __('app.lang_tm') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('locale', 'ru') }}">{{ __('app.lang_ru') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>