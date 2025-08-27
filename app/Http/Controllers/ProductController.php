<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Show all products with search, filter, sort, and pagination
    public function index(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        // Sort
        if ($request->has('sort') && !empty($request->sort)) {
            if ($request->sort === 'price_asc') $query->orderBy('price', 'asc');
            elseif ($request->sort === 'price_desc') $query->orderBy('price', 'desc');
            elseif ($request->sort === 'name') $query->orderBy('name', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Paginate
        $products = $query->paginate(10)->appends([
            'search' => $request->search,
            'category' => $request->category,
            'sort' => $request->sort
        ]);

        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', '✅ Product added successfully!');
    }

    // Show single product
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show edit form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', '✅ Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', '❌ Product deleted!');
    }
}
