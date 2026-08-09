@extends('admin.layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="mb-3">{{ __('app.admin_dashboard') }}</h1>
        <p class="mb-3">{{ __('app.welcome_admin') }}</p>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.hotels.index') }}" class="btn btn-primary">{{ __('app.hotels') }}</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">{{ __('app.logout') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
