<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Products') }}
            </h2>
            <a href="{{ route('admin.products.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Add New Product
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-200 text-sm uppercase text-gray-600">
                                <th class="py-2">SKU</th>
                                <th class="py-2">Image</th>
                                <th class="py-2">Name</th>
                                <th class="py-2">Buy Price</th>
                                <th class="py-2">Sell Price</th>
                                <th class="py-2">Stock</th>
                                <th class="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                    <td class="py-3 font-mono text-sm text-gray-500">{{ $product->sku }}</td>

                                    <td class="py-3">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="w-12 h-12 object-cover rounded shadow-sm border border-gray-200">
                                        @else
                                            <div
                                                class="w-12 h-12 bg-gray-100 flex items-center justify-center rounded border border-gray-200 text-center">
                                                <span
                                                    class="text-[10px] text-gray-400 font-medium leading-tight">No<br>Image</span>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="py-3 font-bold">{{ $product->name }}</td>
                                    <td class="py-3">Rp {{ number_format($product->buy_price, 0, ',', '.') }}</td>
                                    <td class="py-3 text-green-600 font-semibold">Rp
                                        {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                                    <td class="py-3">
                                        <span
                                            class="px-2 py-1 rounded text-white text-xs font-bold shadow-sm {{ $product->stock > 5 ? 'bg-green-500' : 'bg-red-500' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="py-3 flex gap-3 items-center mt-2">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="text-blue-500 hover:text-blue-700 font-medium transition">Edit</a>

                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 font-medium transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
