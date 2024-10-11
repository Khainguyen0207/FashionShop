<?php

namespace Database\Seeders;

use App\Jobs\StoreFileJob;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::query()->delete();
        $products = $this->products_Seeder();
        $data = [];
        foreach ($products as $value) {
            $data[] = [
                'product_code' => 'MSSP'.fake()->unique()->randomNumber(),
                'product_name' => $value[1],
                'category_id' => $value[7],
                'price' => $value[5],
                'image' => $this->getImage(),
                'options' => "$value[3]|$value[4]",
                'unsold_quantity' => floor(rand(0, 1000)),
                'sold_quantity' => 0,
                'description' => $value[6],
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ];
        }

        Product::query()->insert($data);
    }

    /*
        0 => id
        1 => name
        2 => fabric material
        3 => color
        4 => size
        5 => price
        6 => description
        7 => category_id
    */

    public function getImage()
    {
        $filename = 'profile/'.uniqid().'.jpg';
        StoreFileJob::dispatch($filename);

        return $filename;
    }

    private function products_Seeder()
    {
        $products = [
            '1, Áo Khoác Dạ Nữ, 100% polyester, Đen - Xám - Kem, S - M - L - XL,1200000, Áo khoác dạ ấm áp thanh lịch., 11',
            '2, Quần Jean Nam, Vải jeans, Xanh - Đen - Xám, M - L - XL - XXL,850000, Quần jean thời trang cho nam., 10',
            '3, Áo Sơ Mi Nữ, Vải cotton, Trắng - Hồng - Xanh, S - M - L,450000, Áo sơ mi nữ thanh lịch., 11',
            '4, Đầm Xòe Nữ, Lụa mềm, Đỏ - Kem - Trắng, S - M - L,1100000, Đầm xòe cho các buổi tiệc., 11',
            '5, Áo Thun Nam, Vải thun co giãn, Đen - Xanh - Trắng, M - L - XL, 350000, Áo thun thoải mái cho nam., 10',
            '6, Quần Short Nữ, Vải thun, Hồng - Kem - Xám, S - M - L, 400000, Quần short mùa hè cho nữ., 11',
            '7, Giày Thể Thao Nam, Da tổng hợp, Đen - Trắng - Xanh, 39 - 40 - 41 - 42, 1500000, Giày thể thao tiện dụng., 10',
            '8, Túi Xách Nữ, Da tổng hợp, Đen - Kem - Nâu, One-size, 900000, Túi xách thời trang cho nữ., 11',
            '9, Váy Dạ Hội, Lụa mềm, Đỏ - Đen - Trắng, S - M - L, 2500000, Váy dạ hội sang trọng., 11',
            '10, Áo Len Nam, Len cashmere, Nâu - Xám - Đen, M - L - XL, 1300000, Áo len ấm áp cho mùa đông., 10',
            '11, Áo Khoác Da Nam, Da thật, Đen - Nâu, M - L - XL, 2800000, Áo khoác da cá tính., 10',
            '12, Quần Jogger Nữ, Vải cotton, Xám - Đen - Hồng, S - M - L, 600000, Quần jogger thoải mái., 11',
            '13, Áo Hoodie Nam, Vải nỉ, Đen - Trắng - Xanh, L - XL - XXL, 750000, Áo hoodie ấm áp cho nam., 10',
            '14, Đầm Ôm Nữ, Lụa mềm, Kem - Đen - Xanh, S - M - L, 1300000, Đầm ôm quyến rũ., 11',
            '15, Giày Cao Gót Nữ, Da tổng hợp, Hồng - Đen - Trắng, 37 - 38 - 39 - 40, 1000000, Giày cao gót thanh lịch., 11',
            '16, Quần Tây Nam, Vải wool, Đen - Xám - Xanh, M - L - XL, 1500000, Quần tây lịch lãm cho nam., 10',
            '17, Áo Sơ Mi Nam, Vải cotton, Trắng - Xanh - Hồng, M - L - XL, 600000, Áo sơ mi thời trang cho nam., 10',
            '18, Váy Ngắn Nữ, Vải denim, Xanh - Đen - Kem, S - M - L, 500000, Váy ngắn dễ thương., 11',
            '19, Áo Thun Dài Tay, Vải thun, Đen - Trắng - Xám, M - L - XL, 400000, Áo thun dài tay cho nam/nữ., 14',
            '20, Quần Thể Thao, Vải thun co giãn, Đen - Xanh - Đỏ, M - L - XL, 600000, Quần thể thao năng động., 14',
            '21, Giày Tây Nam, Da thật, Nâu - Đen, 39 - 40 - 41, 1800000, Giày tây sang trọng., 10',
            '22, Mũ Lưỡi Trai, Vải cotton, Đen - Trắng, One-size, 200000, Mũ lưỡi trai năng động., 14',
            '23, Khăn Quàng Cổ, Len, Xám - Đỏ, One-size, 150000, Khăn quàng cổ ấm áp., 14',
            '24, Áo Dạ Dài, 100% wool, Đen - Nâu, S - M - L, 2000000, Áo dạ dài ấm áp., 11',
            '25, Đồng Hồ Thời Trang, Thép không gỉ, Bạc - Vàng, One-size, 1500000, Đồng hồ thời trang đẹp., 14',
            '26, Kính Mát Nữ, Nhựa, Đen - Hồng, One-size, 300000, Kính mát bảo vệ mắt., 11',
            '27, Giày Boot Nữ, Da thật, Nâu - Đen, 37 - 38 - 39, 1600000, Giày boot thời trang., 11',
            '28, Túi Đeo Chéo, Da tổng hợp, Đen - Kem, One-size, 800000, Túi đeo chéo tiện lợi., 14',
            '29, Quần Legging, Vải co giãn, Đen - Xanh, S - M - L, 350000, Quần legging thoải mái., 11',
            '30, Áo Phông Trơn, Vải cotton, Trắng - Đen - Xanh, M - L - XL, 250000, Áo phông cơ bản., 14',
            '31, Giày Sandal Nữ, Da tổng hợp, Hồng - Kem, 37 - 38, 450000, Giày sandal thoải mái., 11',
            '32, Áo Khoác Gió, Vải chống thấm, Xanh - Đen, M - L - XL, 800000, Áo khoác gió bảo vệ khỏi mưa., 14',
            '33, Quần Baggy Nam, Vải cotton, Đen - Xanh, M - L, 600000, Quần baggy thời trang., 10',
            '34, Đầm Maxi Nữ, Lụa, Đỏ - Vàng, S - M - L, 1500000, Đầm maxi thoải mái., 11',
            '35, Áo Tank Top Nam, Vải thun, Đen - Trắng, M - L, 300000, Áo tank top cho mùa hè., 10',
            '36, Quần Capri Nữ, Vải cotton, Xám - Hồng, S - M - L, 500000, Quần capri thoải mái., 11',
            '37, Giày Thể Thao Nữ, Da tổng hợp, Đen - Trắng, 36 - 37 - 38, 1200000, Giày thể thao cho nữ., 11',
            '38, Áo Phông Nữ, Vải cotton, Trắng - Xanh - Đen, S - M - L, 250000, Áo phông thoải mái cho nữ., 11',
            '39, Quần Ống Rộng Nữ, Vải linen, Đen - Trắng, M - L, 800000, Quần ống rộng thời trang., 11',
            '40, Giày Búp Bê Nữ, Da tổng hợp, Hồng - Kem, 37 - 38, 500000, Giày búp bê dễ thương., 11',
            '41, Quần Kaki Nam, Vải kaki, Xám - Đen, M - L, 750000, Quần kaki lịch lãm., 10',
            '42, Áo Khoác Jean Nam, Vải jean, Xanh - Đen, M - L - XL, 1300000, Áo khoác jean thời trang., 10',
            '43, Váy Dạo Phố Nữ, Vải chiffon, Hồng - Đen, S - M, 800000, Váy dạo phố thoải mái., 11',
            '44, Quần Ống Suông Nam, Vải cotton, Đen - Xanh, M - L, 900000, Quần ống suông thời trang., 10',
            '45, Áo Sát Nách Nữ, Vải cotton, Đen - Trắng, S - M - L, 350000, Áo sát nách cho mùa hè., 11',
            '46, Giày Slip-On Nam, Vải canvas, Xanh - Đen, 39 - 40 - 41, 600000, Giày slip-on thoải mái., 10',
            '47, Túi Xách Du Lịch, Vải nylon, Đen - Xám, One-size, 1200000, Túi xách du lịch tiện dụng., 14',
            '48, Áo Sơ Mi Cổ Bẻ, Vải cotton, Trắng - Hồng, M - L, 700000, Áo sơ mi cổ bẻ thanh lịch., 10',
            '49, Quần Jeans Nữ, Vải denim, Xanh - Đen, S - M - L, 900000, Quần jeans thời trang cho nữ., 11',
            '50, Giày Sneaker Nữ, Da tổng hợp, Trắng - Hồng, 36 - 37 - 38, 1000000, Giày sneaker thời trang., 11',
            '51, Áo Polo Nam, Vải cotton, Xanh - Trắng, M - L - XL, 600000, Áo polo thoải mái cho nam., 10',
            '52, Quần Short Nam, Vải thun, Đen - Xanh, M - L, 400000, Quần short mùa hè cho nam., 10',
            '53, Áo Khoác Nữ, Vải tổng hợp, Đỏ - Đen, S - M - L, 900000, Áo khoác thời trang cho nữ., 11',
            '54, Đầm Bầu, Vải cotton, Xanh - Hồng, M - L, 750000, Đầm bầu thoải mái., 11',
            '55, Giày Chạy Bộ Nam, Vải mesh, Đen - Xanh, 39 - 40 - 41, 1200000, Giày chạy bộ thoải mái., 10',
            '56, Áo Bơi Nam, Vải spandex, Đen - Xanh, M - L, 450000, Áo bơi thời trang cho nam., 10',
            '57, Quần Legging Nữ, Vải co giãn, Đen - Hồng, S - M - L, 500000, Quần legging cho thể thao., 11',
            '58, Giày Sneaker Nam, Vải tổng hợp, Đen - Trắng, 40 - 41 - 42, 1100000, Giày sneaker thể thao., 10',
            '59, Túi Tote Nữ, Vải canvas, Đỏ - Đen, One-size, 600000, Túi tote thời trang., 11',
            '60, Quần Bơi Nam, Vải nylon, Xanh - Đỏ, M - L, 350000, Quần bơi thoải mái cho nam., 10',
            '61, Áo Ngủ Nữ, Vải satin, Hồng - Trắng, S - M - L, 400000, Áo ngủ dễ thương., 11',
            '62, Giày Thể Thao Nam, Da tổng hợp, Xanh - Đen, 39 - 40, 900000, Giày thể thao thời trang., 10',
            '63, Quần Ống Dài Nữ, Vải chiffon, Đen - Kem, S - M, 800000, Quần ống dài thanh lịch., 11',
            '64, Áo Dài Nữ, Lụa, Trắng - Đỏ, S - M, 1800000, Áo dài truyền thống., 11',
            '65, Giày Dép Nữ, Nhựa, Hồng - Trắng, 37 - 38, 200000, Giày dép thoải mái cho mùa hè., 11',
            '66, Áo Khoác Bomber, Vải tổng hợp, Xanh - Đen, M - L, 950000, Áo khoác bomber cá tính., 14',
            '67, Quần Đùi Nữ, Vải denim, Xanh - Hồng, S - M - L, 450000, Quần đùi dễ thương., 11',
            '68, Áo Khoác Nữ, Vải nỉ, Hồng - Đen, S - M - L, 800000, Áo khoác ấm áp cho nữ., 11',
            '69, Quần Jean Nữ, Vải denim, Xanh - Đen, S - M - L, 900000, Quần jean thời trang cho nữ., 11',
            '70, Giày Đá Banh Nam, Vải tổng hợp, Đen - Xanh, 39 - 40, 1200000, Giày đá bóng chất lượng., 10',
            '71, Áo Sát Nách Nam, Vải cotton, Đen - Trắng, M - L, 300000, Áo sát nách cho mùa hè., 10',
            '72, Quần Dài Nữ, Vải linen, Kem - Đen, S - M - L, 800000, Quần dài thoải mái., 11',
            '73, Áo T-Shirt Nam, Vải thun, Trắng - Đen, M - L - XL, 250000, Áo T-shirt thời trang., 10',
            '74, Giày Búp Bê, Da tổng hợp, Hồng - Kem, 37 - 38, 500000, Giày búp bê dễ thương., 11',
            '75, Quần Jean Nữ, Vải denim, Xanh - Đen, S - M - L, 900000, Quần jean thời trang cho nữ., 11',
            '76, Áo Khoác Nữ, Vải nỉ, Hồng - Đen, S - M - L, 800000, Áo khoác ấm áp cho nữ., 11',
            '77, Quần Short Nữ, Vải cotton, Xanh - Đen, S - M, 450000, Quần short dễ thương., 11',
            '78, Áo Hoodie Nữ, Vải nỉ, Hồng - Đen, S - M - L, 700000, Áo hoodie ấm áp cho nữ., 11',
            '79, Giày Thể Thao Nữ, Da tổng hợp, Xanh - Đen, 36 - 37, 900000, Giày thể thao thời trang., 11',
            '80, Áo Khoác Nữ, Vải nỉ, Xám - Đen, S - M - L, 950000, Áo khoác ấm áp cho nữ., 11',
            '81, Quần Jeans Nam, Vải denim, Xanh - Đen, M - L, 800000, Quần jeans thời trang cho nam., 10',
            '82, Giày Da Nữ, Da thật, Nâu - Đen, 36 - 37, 1200000, Giày da thời trang cho nữ., 11',
            '83, Áo Croptop Nữ, Vải cotton, Hồng - Trắng, S - M, 400000, Áo croptop thời trang., 11',
        ];

        foreach ($products as $key => $value) {
            $products[$key] = explode(',', $value);
        }

        return $products;
    }
}
