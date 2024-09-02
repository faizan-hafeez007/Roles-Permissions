@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h1>Create Product</h1> --}}
        {{-- @can('create-product') --}}
        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Product</button>
        </form>
    </div>
    {{-- @endcan --}}
@endsection
