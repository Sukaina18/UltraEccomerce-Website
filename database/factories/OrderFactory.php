<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'delivery_address' => $this->faker->address,
            'phone_no' => $this->faker->phoneNumber,
            'payment_method' => $this->faker->randomElement(['Cash on Delivery', 'Credit Card', 'PayPal']),
            // Add other attributes as needed
        ];
    }
}
