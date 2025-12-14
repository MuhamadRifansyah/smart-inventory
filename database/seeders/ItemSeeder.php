<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::insert([
            [
                'name' => 'Kertas A4',
                'code' => 'ITEM-001',
                'stock' => 100,
                'unit' => 'rim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pulpen',
                'code' => 'ITEM-002',
                'stock' => 250,
                'unit' => 'pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tinta Printer',
                'code' => 'ITEM-003',
                'stock' => 20,
                'unit' => 'box',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
