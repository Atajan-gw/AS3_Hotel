@extends('admin.layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="mb-4">{{ __('app.add_hotel') }}</h1>
        <form method="POST" action="{{ route('admin.hotels.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.name') }}</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.slug') }}</label>
                    <input type="text" name="slug" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.city') }}</label>
                    <select name="city_id" class="form-select" required>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.rating') }}</label>
                    <input type="number" step="0.1" min="0" max="5" name="rating" class="form-control">
                </div>
                <div class="col-md-12">
                    <label class="form-label">{{ __('app.description') }}</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">{{ __('app.address') }}</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.phone') }}</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.email') }}</label>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4">{{ __('app.save') }}</button>
        </form>
    </div>
</div>
@endsection
