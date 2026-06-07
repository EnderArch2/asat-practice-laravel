<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Store Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 px-4 py-2 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($products as $index => $product)
                        <div class="bg-white p-6 shadow-sm sm:rounded-lg border border-gray-200">
                            <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                            <p class="text-gray-600 mt-1">Price: Rp {{ number_format($product->selling_price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500 mt-1">Stock available: {{ $product->stock }}</p>

                            <div class="mt-4 flex items-center gap-2">
                                <label for="qty_{{ $product->id }}" class="text-sm font-medium text-gray-700">Order Qty:</label>

                                <input type="hidden" name="cart_items[{{ $index }}][product_id]" value="{{ $product->id }}">

                                <input type="number" name="cart_items[{{ $index }}][quantity]" id="qty_{{ $product->id }}"
                                       min="1" max="{{ $product->stock }}"
                                       class="w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100"
                                       {{ $product->stock < 1 ? 'disabled' : '' }}>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 font-bold rounded-lg hover:bg-indigo-700 shadow-md text-white">
                        Proceed to Checkout
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
