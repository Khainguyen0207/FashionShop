<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            AboutShopSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
            ProductSeeder::class,
            // Thêm các class seeder khác ở đây
        ]);
    }
}
