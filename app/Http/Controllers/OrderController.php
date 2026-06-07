<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // Get all orders belonging to this user, load the items, and sort by newest first
        $orders = Order::where('user_id', Auth::id())->with('items.product')->latest()->get();

        return view('orders.index', compact('orders'));
    }
    public function store(Request $request)
    {
        // Validate that the cart isn't empty and items exist
        $request->validate([
            'cart_items' => 'required|array',
            'cart_items.*.product_id' => 'required|exists:products,id',
            'cart_items.*.quantity' => 'required|integer|min:1',
        ]);

        // Database Transaction for safety
        DB::transaction(function () use ($request) {

            // 1. Create the parent Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => 0, // We will calculate this in a moment
                'status' => 'pending',
            ]);

            $totalPrice = 0;

            // 2. Loop through the cart and create Order Items
            foreach ($request->cart_items as $item) {

                // When this create() method fires, the OrderItemObserver automatically
                // steps in to set the price, calculate the margin, and deduct the stock!
                $orderItem = $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);

                // Add to our running total
                $totalPrice += ($orderItem->price * $orderItem->quantity);
            }

            // 3. Update the parent order with the final calculated price
            $order->update(['total_price' => $totalPrice]);
        });

        // Redirect the customer to their order history
        return redirect()->route('orders.index')->with('success', 'Your order has been placed successfully!');
    }
}
