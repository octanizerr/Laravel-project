@extends('layouts.app')

@section('title', 'Products')

@section('content')
<h1 class="text-2xl font-bold mb-4">🛍️ Mini Market - Products</h1>

<!-- Search, Filter, Sort -->
<form method="GET" action="{{ route('products.index') }}" class="mb-4 flex gap-2">
    <input type="text" name="search" placeholder="Search..."
           value="{{ request('search') }}" class="border rounded p-2 flex-1">
    
    <select name="category" class="border rounded p-2">
        <option value="">All Categories</option>
        <option value="food" {{ request('category')=='food' ? 'selected' : '' }}>Food</option>
        <option value="drinks" {{ request('category')=='drinks' ? 'selected' : '' }}>Drinks</option>
    </select>

    <select name="sort" class="border rounded p-2">
        <option value="">Sort By</option>
        <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
        <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
        <option value="name" {{ request('sort')=='name' ? 'selected' : '' }}>Name (A-Z)</option>
    </select>

    <button type="submit" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Apply</button>
</form>

<a href="{{ route('products.create') }}" 
   class="px-4 py-2 mb-4 inline-block bg-blue-600 text-white rounded hover:bg-blue-700">➕ Add New Product</a>
<a href="{{ route('cart.index') }}" 
   class="px-4 py-2 mb-4 inline-block bg-green-600 text-white rounded hover:bg-green-700">🛒 View Cart</a>

<table class="table-auto w-full border rounded shadow-sm">
    <tr class="bg-gray-100">
        <th class="p-2 border">Name</th>
        <th class="p-2 border">Category</th>
        <th class="p-2 border">Price</th>
        <th class="p-2 border">Quantity</th>
        <th class="p-2 border">Actions</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td class="p-2 border">
            <a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:underline">
                {{ $product->name }}
            </a>
        </td>
        <td class="p-2 border">{{ $product->category }}</td>
        <td class="p-2 border">${{ $product->price }}</td>
        <td class="p-2 border">{{ $product->quantity }}</td>
        <td class="p-2 border flex gap-2">
            <a href="{{ route('products.edit', $product) }}" 
               class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
            </form>
            <form action="{{ route('cart.add', $product) }}" method="POST" style="display:inline">
                @csrf
                <button class="px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700">Add to Cart</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<div class="mt-4">
    {{ $products->links() }}
</div>
@endsection
