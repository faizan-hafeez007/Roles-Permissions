@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Permissions</h1>
        @can('create permissions')
            <a href="{{ route('permission.create') }}" class="btn btn-primary">Create Permission</a>
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
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->created_at->format('d-M-Y') }}</td>
                        <td>
                            @can('edit permissions')
                                <a class="btn btn-primary"
                                    href="{{ route('permission.edit', ['id' => $permission->id]) }}">Edit</a>
                            @endcan
                            @can('delete permissions')
                                <form action="{{ route('permission.destroy', $permission->id) }}" method="POST"
                                    style="display:inline;">
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
                @if ($permissions->currentPage() > 1)
                    <a href="{{ $permissions->previousPageUrl() }}" class="btn btn-secondary">Previous</a>
                @endif

                @if ($permissions->hasMorePages())
                    <a href="{{ $permissions->nextPageUrl() }}" class="btn btn-primary">Next</a>
                @endif
            </div>
        </div>
    </div>
@endsection
