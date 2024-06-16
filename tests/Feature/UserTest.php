<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use  WithFaker;
    use RefreshDatabase;


    public function test_user_can_register()
    {
        // Create a user with random data using the Faker library
        $userData = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        // Send a POST request to the registration endpoint with the user data
        $response = $this->post(route('register'), $userData);

        // Assert that the user is redirected to the home page after successful registration
        $response->assertRedirect(route('home'));

        // Assert that the user was created in the database
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);

    }
    public function test_add_product_to_cart()
{
    Log::info('Starting test_add_product_to_cart');

    // Create a user
    $user = User::factory()->create();

    // Create a product
    $product = Product::factory()->create();

    // Authenticate the user
    $this->actingAs($user);

    // Send a POST request to add the product to the cart
    $response = $this->post('/add_cart/' . $product->id);

    // Assert that the request was redirected back (status 302) after adding the product to the cart
    $response->assertStatus(302);

    // Assert that the product with the specified ID exists in the user's cart
    $this->assertDatabaseHas('carts', [
        'user_id' => $user->id,
        'product_id' => $product->id,
    ]);

    Log::info('Finished test_add_product_to_cart');
}

    public function test_user_can_checkout()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a product
        $product = Product::factory()->create();

        // Add the product to the user's cart
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // Mock the request data
        $requestData = [
            'first_name' => $this->faker->firstName,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'payment_method' => 'Cash',
        ];

        // Send a POST request to the checkout endpoint
        $response = $this->actingAs($user)->post(route('checkout'), $requestData);

        // Assert that the request was successful and redirected to the home page
        $response->assertRedirect(route('home'));

        // Assert that the order was created in the database
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1, // Assuming quantity is correctly saved
            'name' => $requestData['first_name'],
            'delivery_address' => $requestData['address'],
            'phone_no' => $requestData['phone'],
            'payment_method' => $requestData['payment_method'],
        ]);

        // Assert that the user's cart is empty after checkout
        $this->assertDatabaseMissing('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }


}
