<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product: ') }} {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('admin.products.update', $product) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="sku" class="block font-medium text-sm text-gray-700">Serial Number
                                (SKU)</label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 uppercase"
                                required>
                            @error('sku')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">Product Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $product->name) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            @error('name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="buy_price" class="block font-medium text-sm text-gray-700">Buy Price
                                    (Modal)</label>
                                <input type="number" name="buy_price" id="buy_price"
                                    value="{{ old('buy_price', $product->buy_price) }}" min="0"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @error('buy_price')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="selling_price" class="block font-medium text-sm text-gray-700">Selling
                                    Price</label>
                                <input type="number" name="selling_price" id="selling_price"
                                    value="{{ old('selling_price', $product->selling_price) }}" min="0"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @error('selling_price')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="stock" class="block font-medium text-sm text-gray-700">Current Stock</label>
                            <input type="number" name="stock" id="stock"
                                value="{{ old('stock', $product->stock) }}" min="0"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('stock')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6 border-t pt-4 mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700 mb-2">Product
                                Image</label>

                            @if ($product->image)
                                <div class="mb-3">
                                    <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image"
                                        class="w-32 h-32 object-cover border rounded">
                                </div>
                            @endif

                            <input type="file" name="image" id="image" accept="image/*"
                                class="mt-1 block w-full border-gray-300 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="text-xs text-gray-500 mt-1">Leave blank to keep the current image.</p>
                            @error('image')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.products.index') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4 font-medium">Cancel</a>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 transition duration-150">
                                Update Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
