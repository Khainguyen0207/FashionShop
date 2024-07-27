<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $data = [
            'name' => 'Admin',
            'email' => 'admin@admin.vn',
            'password' => '123456',
            'role' => 1
        ];
        User::factory()->create($data);
    }
}
