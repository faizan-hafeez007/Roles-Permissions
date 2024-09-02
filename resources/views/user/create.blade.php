@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h1>Create Role/Permission{{ $type == 'role' ? ' Role' : ' Permission' }}</h1> --}}
        {{-- @can('create-role-permission') --}}
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <label for="roles">Roles</label>
                <div id="roles" class="form-group d-flex justify-content-around">
                    @foreach ($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" id="role-{{ $role->name }}"
                                value="{{ $role->name }}" @if (isset($userRoles) && in_array($role->name, $userRoles)) checked @endif>
                            <label for="role-{{ $role->id }}" class="form-check-label">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Create Permission</button>
        </form>
    </div>
    {{-- @endcan --}}
@endsection
