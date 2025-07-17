<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run()
    {
        Warehouse::create(['name' => 'Kho Hà Nội', 'location' => 'Hà Nội']);
        Warehouse::create(['name' => 'Kho TP HCM', 'location' => 'TP HCM']);
    }
}
