@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h1>Edit {{ $type == 'role' ? 'Role' : 'Permission' }}</h1> --}}
        {{-- @can('edit-role-permission') --}}
<form action="{{ route('permission.update', $permission->id) }}" method="POST">                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{$permission->name}}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        {{-- @endcan --}}
    </div>
@endsection
