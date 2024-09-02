@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Role</h1>

        <form action="{{ route('role.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
            </div>

            <label for="permissions">Permissions</label>
            <!-- Select All / Deselect All Buttons -->
            <div class="mb-3">
                <button type="button" class="btn btn-secondary" id="select-all">Select All</button>
                <button type="button" class="btn btn-secondary" id="deselect-all">Deselect All</button>
            </div>

            <div class="form-group">
                <div class="permissions-container p-4">
                    @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                id="permissions-{{ $permission->id }}" value="{{ $permission->name }}"
                                @if (in_array($permission->id, $rolePermissions->toArray())) checked @endif>
                            <label for="permissions-{{ $permission->id }}" class="form-check-label">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Role</button>
        </form>
    </div>

    <style>
        .permissions-container {
            max-height: 400px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .permissions-container {
            column-count: 3;
            column-gap: 20px;
        }

        .form-check {
            break-inside: avoid;
            margin-bottom: 10px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllButton = document.getElementById('select-all');
            const deselectAllButton = document.getElementById('deselect-all');
            const checkboxes = document.querySelectorAll('.form-check-input');

            // Select All Checkboxes
            selectAllButton.addEventListener('click', function() {
                checkboxes.forEach(checkbox => checkbox.checked = true);
            });

            // Deselect All Checkboxes
            deselectAllButton.addEventListener('click', function() {
                checkboxes.forEach(checkbox => checkbox.checked = false);
            });
        });
    </script>
@endsection
