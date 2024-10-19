<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::query()->delete();
        $data = [
            'name_category' => 'Thời trang cho nam',
        ];
        Category::factory()->create($data);
    }
}