<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Nguyễn Văn An',
                'email' => 'nguyenvana@email.com',
                'phone' => '0912345678',
                'address' => '123 Đường ABC, Quận 1, TP.HCM',
                'note' => 'Khách hàng VIP'
            ],
            [
                'name' => 'Trần Thị Bình',
                'email' => 'tranthibinh@email.com',
                'phone' => '0987654321',
                'address' => '456 Đường XYZ, Quận 2, TP.HCM',
                'note' => 'Khách hàng thường xuyên'
            ],
            [
                'name' => 'Lê Văn Cường',
                'email' => 'levancuong@email.com',
                'phone' => '0123456789',
                'address' => '789 Đường DEF, Quận 3, TP.HCM',
                'note' => 'Khách hàng mới'
            ],
            [
                'name' => 'Phạm Thị Dung',
                'email' => 'phamthidung@email.com',
                'phone' => '0369852147',
                'address' => '321 Đường GHI, Quận 4, TP.HCM',
                'note' => 'Khách hàng online'
            ],
            [
                'name' => 'Hoàng Văn Em',
                'email' => 'hoangvanem@email.com',
                'phone' => '0587412369',
                'address' => '654 Đường JKL, Quận 5, TP.HCM',
                'note' => 'Khách hàng doanh nghiệp'
            ]
        ];

        foreach ($customers as $customerData) {
            Customer::create($customerData);
        }

        $this->command->info('Customer seeder completed successfully!');
    }
}
