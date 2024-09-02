@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h1>Create Role/Permission{{ $type == 'role' ? ' Role' : ' Permission' }}</h1> --}}
        {{-- @can('create-role-permission') --}}
            <form action="{{ route('permission.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Permission</button>
            </form>
        </div>
    {{-- @endcan --}}
@endsection
