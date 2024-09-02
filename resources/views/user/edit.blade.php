@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User</h1>
        {{-- @can('edit-user') --}}
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                    required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password (leave blank to keep current password)</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <label for="roles">Roles</label>
            <div class="form-group">
                <div class="form-group d-flex justify-content-around">
                    @foreach ($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" id="role-{{ $role->id }}"
                                value="{{ $role->name }}" @if (in_array($role->id, $userRoles)) checked @endif>
                            <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    @endforeach

                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
        {{-- @endcan --}}
    </div>
@endsection
