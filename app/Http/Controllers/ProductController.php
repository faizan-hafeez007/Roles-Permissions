<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;


class ProductController extends Controller implements HasMiddleware

{
    public static function middleware(): array
    {
        return [

            new Middleware('permission:view products', only: ['index']),
            new Middleware('permission:edit products', only: ['edit']),
            new Middleware('permission:create products', only: ['create']),
            new Middleware('permission:delete products', only: ['destroy'])
        ];
    }

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(2);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        // Validate the request input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // Create the product using the validated data
        $product = Product::create($validatedData);

        // Redirect with a success message
        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        // Find and update the product
        $product = Product::findOrFail($id);
        $product->update($validatedData);

        // Redirect with a success message
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            // return redirect()->route('product.index');
            return redirect()->route('product.index')->with('success', 'Product Deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Product not found.')->abort(404);
        }
    }
}
