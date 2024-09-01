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
        $skirt = ['Quần dài 3 lỗ', 'Áo 5 dây', 'Áo con khỉ', 'Áo thun xịn', 'Áo thỏ 7 màu', 'Áo cúp'];
        for($i = 404; $i < 500; $i++) {
            $data = [
                'product_code' => 'MSSPN' .$i,
                'product_name' => $skirt[random_int(0, count($skirt) - 1)],
                'category_id' => 11,
                'price' => 45000,
                'description' => "Kiểu dáng: Đơn giản, ôm sát cơ thể
Chất liệu: 100% Cotton thoáng mát, thấm hút mồ hôi
Đặc điểm nổi bật:
Thiết kế trẻ trung, năng động
Chất liệu vải co giãn, thoáng mát
Đường may chắc chắn, tỉ mỉ
Thích hợp cho các hoạt động thể thao hoặc mặc hàng ngày",
                'image' => "/img/data",
                'unsold_quantity' => 10,
                'sold_quantity' => 100
            ];
            Product::factory()->create($data);
        }
    }
}
