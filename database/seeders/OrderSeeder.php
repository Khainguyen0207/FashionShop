<?php

namespace Database\Seeders;

use App\Models\OrderModel;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderModel::query()->delete();
        OrderModel::factory()->count(100)->create();
    }
}
