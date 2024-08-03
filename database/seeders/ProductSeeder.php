<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skirt = ['Quần dài 3 lỗ', 'Áo 5 dây', 'Áo con khỉ', 'Áo thun xịn'];
        for($i = 101; $i < 200; $i++) {
            $data = [
                'product_code' => 'MSSPN' .$i,
                'product_name' => $skirt[random_int(0, 3)],
                'category_id' => random_int(1, 2),
                'price' => 30000,
                'image' => "/img/data",
                'unsold_quantity' => 10,
                'sold_quantity' => 1
            ];
            Product::factory()->create($data);
        }
    }
}
