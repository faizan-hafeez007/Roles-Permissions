@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Roles</h1>
        @can('create roles')
            <a href="{{ route('role.create') }}" class="btn btn-primary mb-3">Create Role</a>
        @endcan
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger" id="error-alert">{{ session('error') }}</div>
        @endif

        <script>
            setTimeout(function() {
                $('#success-alert').fadeOut('fast');
                $('#error-alert').fadeOut('fast');
            }, 3000);
        </script>

        <!-- Responsive Table -->
        <div class="table-responsive">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                            <td>{{ $role->created_at->format('d-M-Y') }}</td>
                            <td class="d-flex">
                                @can('edit roles')
                                    <a class="btn btn-primary btn-sm mr-2"
                                        href="{{ route('role.edit', ['id' => $role->id]) }}">Edit</a>
                                @endcan
                                @can('delete roles')
                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this role?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-2">
            <div class="pagination">
                @if ($roles->currentPage() > 1)
                    <a href="{{ $roles->previousPageUrl() }}" class="btn btn-secondary">Previous</a>
                @endif

                @if ($roles->hasMorePages())
                    <a href="{{ $roles->nextPageUrl() }}" class="btn btn-primary">Next</a>
                @endif
            </div>
        </div>
    </div>
@endsection
