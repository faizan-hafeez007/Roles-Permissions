@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('role.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <label for="permissions">Permissions</label>
            <div class="form-group">
                <div class="permissions-container p-4">
                    <button type="button" class="btn btn-primary" onclick="selectAllPermissions()">Select All</button>
                    <br><br>
                    @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                id="permissions-{{ $permission->id }}" value="{{ $permission->name }}">
                            <label for="permissions-{{ $permission->id }}"
                                class="form-check-label">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Role</button>
        </form>
    </div>

    {{-- Include the following CSS directly in the Blade template or in your external CSS file --}}
    <style>
        /* Set a max-height and enable scrolling for the container */
        .permissions-container {
            max-height: 400px; /* Adjust height as needed */
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc; /* Optional: to visually distinguish the container */
        }

        /* Display checkboxes in multiple columns */
        .permissions-container {
            column-count: 3; /* Adjust the number of columns as needed */
            column-gap: 20px;
        }

        /* Ensure that form-check elements are displayed correctly in columns */
        .form-check {
            break-inside: avoid; /* Prevent columns from breaking inside form-check elements */
            margin-bottom: 10px;
        }
    </style>

    <script>
        function selectAllPermissions() {
            var checkboxes = document.querySelectorAll('input[name="permissions[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        }
    </script>
@endsection