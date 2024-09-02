@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Delete {{ $type == 'role' ? 'Role' : 'Permission' }}</h1>
        @can('delete-role-permission')
            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete {{ $type == 'role' ? 'Role' : 'Permission' }}</button>
            </form>
        @endcan
    </div>
@endsection