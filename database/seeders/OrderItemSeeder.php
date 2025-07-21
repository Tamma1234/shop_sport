<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();
        
        if ($orders->isEmpty()) {
            $this->command->error('No orders found. Please run OrderSeeder first!');
            return;
        }
        
        if ($products->isEmpty()) {
            $this->command->error('No products found. Please run ProductSeeder first!');
            return;
        }

        // Tạo order items cho từng đơn hàng
        foreach ($orders as $order) {
            // Mỗi đơn hàng có 1-3 sản phẩm
            $numItems = rand(1, 3);
            $selectedProducts = $products->random($numItems);
            
            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 5);
                $price = $product->price;
                $total = $price * $quantity;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $total
                ]);
            }
        }

        $this->command->info('OrderItem seeder completed successfully!');
    }
}
