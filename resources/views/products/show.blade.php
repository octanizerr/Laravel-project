@extends('layouts.app')

@section('content')
<h1>Product Details</h1>

<div class="bg-white shadow-md rounded-xl p-6 mb-6">
    <h2 class="text-2xl font-semibold mb-4">{{ $product->name }}</h2>
    
    <p><strong>Category:</strong> {{ $product->category ?? 'N/A' }}</p>
    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
    <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
    <p><strong>Description:</strong> {{ $product->description ?? 'No description provided.' }}</p>
</div>

<div class="flex space-x-2">
    <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-xl hover:bg-gray-600">Back to Products</a>
    <a href="{{ route('products.edit', $product) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-xl hover:bg-yellow-600">Edit</a>

    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700">Delete</button>
    </form>
</div>
@endsection
