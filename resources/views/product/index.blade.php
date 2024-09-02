@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>
        @can('create products')
            <a href="{{ route('product.create') }}" class="btn btn-primary">Create Product</a>
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
                    <th>Description</th>
                    <th>Price</th>
                    <th>Create</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->created_at->format('d-M-Y') }}</td>
                        <td>
                            @can('edit products')
                                <a class="btn btn-primary" href="{{ route('product.edit', ['id' => $product->id]) }}">Edit</a>
                            @endcan
                            @can('delete products')
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST"
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
                @if ($products->currentPage() > 1)
                    <a href="{{ $products->previousPageUrl() }}" class="btn btn-secondary">Previous</a>
                @endif

                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="btn btn-primary">Next</a>
                @endif
            </div>
        </div>
    </div>
@endsection
