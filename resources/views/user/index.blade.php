@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users</h1>
        @can('create users')
            <a href="{{ route('user.create') }}" class="btn btn-primary">Create User</a>
        @endcan
        @if (session('success'))
            <div class="alert alert-success mt-2" id="success-alert">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger" id="error-alert">{{ session('error') }}</div>
        @endif

        <script>
            setTimeout(function() {
                $('#success-alert').fadeOut('fast');
                $('#error-alert').fadeOut('fast');
            }, 3000);
        </script>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                        <td>{{ $user->created_at->format('d-M-Y') }}</td>
                        <td>
                            @can('edit users')
                                <a class="btn btn-primary" href="{{ route('user.edit', ['id' => $user->id]) }}">Edit</a>
                            @endcan
                            @can('delete users')
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            <div class="pagination">
                @if ($users->currentPage() > 1)
                    <a href="{{ $users->previousPageUrl() }}" class="btn btn-secondary">Previous</a>
                @endif

                @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="btn btn-primary">Next</a>
                @endif
            </div>
        </div>
    </div>
@endsection
