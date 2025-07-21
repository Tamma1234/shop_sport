<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Customer;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        
        if ($customers->isEmpty()) {
            $this->command->error('No customers found. Please run CustomerSeeder first!');
            return;
        }

        $orders = [
            [
                'customer_id' => $customers->first()->id,
                'order_code' => Order::generateOrderCode(),
                'status' => 'completed',
                'total_amount' => 1500000,
                'deposit' => 500000,
                'note' => 'Đơn hàng hoàn thành, khách hàng hài lòng'
            ],
            [
                'customer_id' => $customers->get(1)->id,
                'order_code' => Order::generateOrderCode(),
                'status' => 'processing',
                'total_amount' => 2300000,
                'deposit' => 800000,
                'note' => 'Đang xử lý, giao hàng vào sáng mai'
            ],
            [
                'customer_id' => $customers->get(2)->id,
                'order_code' => Order::generateOrderCode(),
                'status' => 'pending',
                'total_amount' => 950000,
                'deposit' => 300000,
                'note' => 'Chờ xác nhận từ khách hàng'
            ],
            [
                'customer_id' => $customers->get(3)->id,
                'order_code' => Order::generateOrderCode(),
                'status' => 'completed',
                'total_amount' => 1800000,
                'deposit' => 600000,
                'note' => 'Giao hàng thành công'
            ],
            [
                'customer_id' => $customers->last()->id,
                'order_code' => Order::generateOrderCode(),
                'status' => 'cancelled',
                'total_amount' => 1200000,
                'deposit' => 400000,
                'note' => 'Khách hàng hủy đơn hàng'
            ]
        ];

        foreach ($orders as $orderData) {
            Order::create($orderData);
        }

        $this->command->info('Order seeder completed successfully!');
    }
}
