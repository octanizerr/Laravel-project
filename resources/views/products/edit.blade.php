@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="max-w-3xl mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Edit Product</h1>

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="mb-4 rounded-md bg-red-50 border border-red-200 p-3">
            <ul class="list-disc list-inside text-red-600">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium" for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" placeholder="Product Name" 
                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="category">Category</label>
            <input type="text" name="category" id="category" value="{{ old('category', $product->category) }}" placeholder="e.g. Food, Drinks" 
                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="price">Price</label>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" placeholder="Price in $" 
                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" placeholder="Quantity" 
                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="description">Description</label>
            <textarea name="description" id="description" placeholder="Optional description" rows="4"
                      class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">Update Product</button>
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
        </div>
    </form>
</div>
@endsection
