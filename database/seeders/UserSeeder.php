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
        for ($i=0; $i < 20; $i++) { 
            $data = [
                'name' => 'Nguyen Van ' .$i,
                'email' => "NguyenVan$i@$i.vn",
                'password' => '123456',
                'role' => 0
            ];
            User::factory()->create($data);
        }
    }
}
