<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\AboutShopModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //asset('assets/user/img/box.png')
        AboutShopModel::query()->delete();
        $setup = [
            [
                'key' => 'logo',
                'value' => 'assets/user/img/box.png'
            ],
            [
                'key' => 'banner',
                'value' => 'assets/user/img/box.png'
            ],
            [
                'key' => 'social_network',
                'value' => json_encode([
                    'facebook' => 'facebook.com/supportfashionstore',
                    'tiktok' => '@supportfashionstore',
                    'instagram' => '@supportfashionstore'
                ])
            ],
            [
                'key' => 'contact',
                'value' => json_encode([
                    'hotline' => '(+84) 123 456 789',
                    'email' => 'supportfashionstore@support.vn',
                    'address' => 'Địa chỉ: 123 Đường Thời Trang, Quận 1, TP. Hồ Chí Minh'
                ])
            ]
        ];
        foreach ($setup as $key => $value) {
            $data = [
                'key' => $value['key'],
                'value' => $value['value'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            AboutShopModel::create($data);
        }
    }
}