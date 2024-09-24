<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_code' => "FSCO" .$this->faker->unique()->randomNumber(),
            'customer_id' => 1,
            'address' => $this->faker->address(),
            'recipient_name' => $this->faker->name(),
            'order_information' => "[{\"id\":\"MSSP1051130\",\"name\":\"\u00c1o thun polo cho nam\",\"quantity\":\"2\",\"price_product\":\"160000\"}]",
            'number_phone' => $this->faker->phoneNumber(), // Dùng phoneNumber
            'status' => "0" .$this->faker->numberBetween(0, 2),
            'expired_at' => Carbon::now()
        ];
    }
}