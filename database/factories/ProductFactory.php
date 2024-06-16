<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'product_name' => $this->faker->word,
            'product_description' => $this->faker->sentence,
            'product_price' => $this->faker->numberBetween(10, 1000),
            'product_category' => $this->faker->word,
            'product_image' => $this->faker->image('public/products', 400, 300, null, false),
            'product_quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
