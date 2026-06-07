<?php

namespace App\Observers;

use App\Models\OrderItem;
use App\Models\Product;

class OrderItemObserver
{
    /**
     * Handle the OrderItem "creating" event.
     * Happens BEFORE the database insert.
     */
    public function creating(OrderItem $orderItem)
    {
        // 1. Find the product being ordered
        $product = Product::find($orderItem->product_id);

        if ($product) {
            // 2. Lock in the selling price at the time of purchase
            $orderItem->price = $product->selling_price;

            // 3. Calculate the total margin for this item line
            // Formula: (Selling Price - Buy Price) * Quantity
            $orderItem->margin = ($product->selling_price - $product->buy_price) * $orderItem->quantity;
        }
    }

    /**
     * Handle the OrderItem "created" event.
     * Happens AFTER the database insert is successful.
     */
    public function created(OrderItem $orderItem)
    {
        // 1. Find the product again
        $product = Product::find($orderItem->product_id);

        if ($product) {
            // 2. Safely decrement the stock by the quantity ordered
            $product->decrement('stock', $orderItem->quantity);
        }
    }
}
