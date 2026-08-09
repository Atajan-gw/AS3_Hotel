@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('app.hotels') }}</h1>
    <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">{{ __('app.add_hotel') }}</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('app.name') }}</th>
                    <th>{{ __('app.city') }}</th>
                    <th>{{ __('app.rating') }}</th>
                    <th>{{ __('app.email') }}</th>
                    <th>{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hotels as $hotel)
                    <tr>
                        <td>{{ $hotel->name }}</td>
                        <td>{{ $hotel->city?->name ?? '-' }}</td>
                        <td>{{ $hotel->rating }}</td>
                        <td>{{ $hotel->email }}</td>
                        <td>
                            <a href="{{ route('admin.hotels.show', $hotel) }}" class="btn btn-sm btn-info">{{ __('app.view') }}</a>
                            <a href="{{ route('admin.hotels.edit', $hotel) }}" class="btn btn-sm btn-warning">{{ __('app.edit') }}</a>
                            <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this hotel?')">{{ __('app.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
