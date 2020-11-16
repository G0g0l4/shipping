<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 10),
            'category_id' => rand(1, 5),
            'product_name' => $this->faker->name,
            'description' => Str::random(10),
            'price' => rand(0, 100),
            'image_path' => "/storage/images/test.jpg"
        ];
    }
}
