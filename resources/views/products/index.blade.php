@extends('layouts.app')

@section('title', 'Mini Market')

@section('content')
<div class="max-w-5xl mx-auto p-4">

    <h1 class="text-3xl font-bold mb-6">Mini Market - Products</h1>

    <!-- Search, Filter, Sort -->
    <form method="GET" action="{{ route('products.index') }}" class="flex flex-wrap gap-2 mb-6 items-center">
        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="px-3 py-2 border rounded-md flex-1">

        <select name="category" class="px-3 py-2 border rounded-md">
            <option value="">All Categories</option>
            <option value="food" {{ request('category')=='food' ? 'selected' : '' }}>Food</option>
            <option value="drinks" {{ request('category')=='drinks' ? 'selected' : '' }}>Drinks</option>
            <!-- Add more categories if needed -->
        </select>

        <select name="sort" class="px-3 py-2 border rounded-md">
            <option value="">Sort By</option>
            <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
            <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
            <option value="name" {{ request('sort')=='name' ? 'selected' : '' }}>Name (A-Z)</option>
        </select>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Apply</button>
    </form>

    <a href="{{ route('products.create') }}" class="inline-block mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Add New Product</a>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-300 rounded-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Category</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Quantity</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border"><a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:underline">{{ $product->name }}</a></td>
                        <td class="px-4 py-2 border">{{ $product->category }}</td>
                        <td class="px-4 py-2 border">${{ $product->price }}</td>
                        <td class="px-4 py-2 border">{{ $product->quantity }}</td>
                        <td class="px-4 py-2 border flex gap-2">
                            <a href="{{ route('products.edit', $product) }}" class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 border text-center">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
