@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<h1 class="text-2xl font-bold mb-4">🛒 Your Cart</h1>

@if(empty($cart))
  <p>Your cart is empty.</p>
@else
<table class="table-auto w-full border rounded shadow-sm">
  <tr class="bg-gray-100">
    <th class="p-2 border">Name</th>
    <th class="p-2 border">Quantity</th>
    <th class="p-2 border">Price</th>
    <th class="p-2 border">Total</th>
    <th class="p-2 border">Actions</th>
  </tr>
  @php $grandTotal = 0; @endphp
  @foreach($cart as $id => $item)
    @php $grandTotal += $item['price'] * $item['quantity']; @endphp
    <tr>
      <td class="p-2 border">{{ $item['name'] }}</td>
      <td class="p-2 border">{{ $item['quantity'] }}</td>
      <td class="p-2 border">${{ $item['price'] }}</td>
      <td class="p-2 border">${{ $item['price'] * $item['quantity'] }}</td>
      <td class="p-2 border">
        <form action="{{ route('cart.remove', $id) }}" method="POST">
            @csrf
            <button class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">Remove</button>
        </form>
      </td>
    </tr>
  @endforeach
</table>

<p class="mt-4 font-semibold">Grand Total: ${{ $grandTotal }}</p>

<form action="{{ route('cart.clear') }}" method="POST" class="mt-2">
    @csrf
    <button class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Clear Cart</button>
</form>
@endif
@endsection
