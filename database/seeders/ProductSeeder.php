<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'sku' => 'KB-837-MCH',
                'name' => 'Mechanical Keyboard',
                'buy_price' => 500000,
                'selling_price' => 750000,
                'stock' => 20,
            ],
            [
                'sku' => 'MS-102-WRL',
                'name' => 'Wireless Gaming Mouse',
                'buy_price' => 200000,
                'selling_price' => 350000,
                'stock' => 50,
            ],
            [
                'sku' => 'MN-024-IPS',
                'name' => '24-inch IPS Monitor',
                'buy_price' => 1200000,
                'selling_price' => 1800000,
                'stock' => 15,
            ],
            [
                'sku' => 'CB-999-USB',
                'name' => 'USB-C Braided Cable',
                'buy_price' => 25000,
                'selling_price' => 50000,
                'stock' => 100,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
