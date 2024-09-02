@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h1>Edit Product</h1> --}}
        {{-- @can('edit-product') --}}
        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', $product->description) }}" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
    {{-- @endcan --}}
@endsection
