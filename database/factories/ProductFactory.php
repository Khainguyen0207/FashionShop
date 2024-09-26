<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'product_code' => 'MSSP'.$this->faker->unique()->randomNumber(),
            'product_name' => $this->faker->userName(),
            'category_id' => Category::inRandomOrder()->take(1)->first('id')->id,
            'price' => $this->faker->randomNumber(),
            'image' => $this->getImage(),
            'unsold_quantity' => $this->faker->randomNumber(),
            'sold_quantity' => 0,
            'description' => $this->faker->text(),
        ];
    }

    public function getImage()
    {
        $filename = 'profile/'.uniqid().'.jpg';
        $req = Http::get('https://picsum.photos/200');
        Storage::disk('public')->put($filename, $req->body());

        return $filename;
    }
}
