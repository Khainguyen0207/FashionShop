<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => "admin",
            'email' => "admin@admin.vn",
            'password' => '123456',
            'role' => 1
        ];
        User::factory()->create($data);
    }
}
