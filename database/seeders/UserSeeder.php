<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()
            ->where('role', 0)
            ->delete();
        User::factory()->count(100)->create();
        $data = [
            'name' => 'admin',
            'email' => 'tkhai12386@gmail.com',
            'password' => Hash::make(123456),
            'role' => 1,
        ];
        if (empty(User::query()->where('email', 'tkhai12386@gmail.com')->first())) {
            User::query()->insert($data);
        }
    }
}
