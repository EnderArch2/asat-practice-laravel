<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Order History') }}
        </h2>
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

                    @if ($orders->isEmpty())
                        <p class="text-gray-500 italic">You haven't placed any orders yet.</p>
                    @else
                        <div class="space-y-6">
                            @foreach ($orders as $order)
                                <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                                    <div class="flex justify-between border-b pb-2 mb-2">
                                        <div>
                                            <span class="font-bold text-lg text-indigo-700">
                                                {{ $order->invoice_number ?? 'Order #' . $order->id }}
                                            </span>
                                            <span
                                                class="text-sm text-gray-500 ml-2">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        <div>
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                                {{ $order->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                                {{ $order->status }}
                                            </span>
                                        </div>
                                    </div>

                                    <ul class="mb-4 space-y-1 pl-4 list-disc">
                                        @foreach ($order->items as $item)
                                            <li>
                                                {{ $item->product->name }} (x{{ $item->quantity }})
                                                - Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="text-right font-bold text-lg text-indigo-700">
                                        Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
