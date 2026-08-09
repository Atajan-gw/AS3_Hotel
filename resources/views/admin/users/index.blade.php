@extends('admin.layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="mb-3">{{ __('app.users') }}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ __('app.id') }}</th>
                        <th>{{ __('app.username') }}</th>
                        <th>{{ __('app.status') }}</th>
                        <th>{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @if($user->is_blocked)
                                    <span class="badge bg-danger">{{ __('app.blocked') }}</span>
                                @else
                                    <span class="badge bg-success">{{ __('app.active') }}</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.users.toggle', $user) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-{{ $user->is_blocked ? 'success' : 'danger' }}">
                                        {{ $user->is_blocked ? __('app.unblock') : __('app.block') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">{{ __('app.no_users_found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
