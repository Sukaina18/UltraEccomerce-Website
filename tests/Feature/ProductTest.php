<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_product()
    {
        Log::info('Starting test_create_product');

        // Create an admin user and authenticate
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin'); // Authenticate as admin

        // Create a product named
        $product = Product::create([
            'product_name' => 'test1',
            'product_description' => 'This is a test product',
            'product_price' => 1000,
            'product_category' => 'toy',
            'product_image' => '',
            'product_quantity' => 4,
        ]);

        Log::info('Created product:', ['product' => $product]);

        // Perform the GET request
        $response = $this->get('/view_product');
        $response->assertStatus(200);
        $response->assertSee('test1'); // Check if the product "test1" is visible on the page

        Log::info('Finished test_create_product');
    }

    public function test_view_products()
    {
        Log::info('Starting test_view_products');

        // Create an admin user and authenticate
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin'); // Authenticate as admin

        // Create multiple products
        $products = Product::factory()->count(5)->create();

        Log::info('Created products:', ['products' => $products]);

        // Perform the GET request
        $response = $this->get('/view_product');

        // Assert the response status and that products are visible
        $response->assertStatus(200);
        foreach ($products as $product) {
            $response->assertSee($product->product_name);
        }

        Log::info('Finished test_view_products');
    }

    public function test_update_product()
{
    Log::info('Starting test_update_product');

    // Create an admin user and authenticate
    $admin = Admin::factory()->create();
    $this->actingAs($admin, 'admin'); // Authenticate as admin

    // Create a product
    $product = Product::factory()->create([
        'product_name' => 'Original Product',
    ]);

    Log::info('Created product:', ['product' => $product]);

    // Perform the POST request to update the product
    $response = $this->post('/edit_product/' . $product->id, [
        'title' => 'Updated Product',
        'description' => 'This is an updated product',
        'price' => 150,
        'quantity' => 5,
        'category' => 'updated category',
        'image' => \Illuminate\Http\UploadedFile::fake()->image('updated.jpg'),
    ]);

    Log::info('Updated product request sent');

    // Assert the product was updated
    $response->assertStatus(302); // Check for redirect status
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'product_name' => 'Updated Product',
        'product_description' => 'This is an updated product',
        'product_price' => 150,
        'product_quantity' => 5,
        'product_category' => 'updated category',
        // Product image won't be 'updated.jpg' due to the unique naming in the controller, adjust accordingly
    ]);

    Log::info('Finished test_update_product');
}

public function test_delete_product()
{
    Log::info('Starting test_delete_product');

    // Create an admin user and authenticate
    $admin = Admin::factory()->create();
    $this->actingAs($admin, 'admin'); // Authenticate as admin

    // Ensure the product with ID which exists in the database
    $product = Product::find(16);
    if (!$product) {
        $product = Product::factory()->create([
            'id' => 16,
            'product_name' => 'Product to be deleted',
        ]);
    }

    Log::info('Found or created product:', ['product' => $product]);

    // Perform the GET request to delete the product
    $response = $this->get('/delete_product/' . $product->id);

    Log::info('Delete product request sent');

    // Assert the product was deleted
    $response->assertStatus(302); // Check for redirect status
    $this->assertDatabaseMissing('products', [
        'id' => $product->id,
    ]);

    Log::info('Finished test_delete_product');
}


}
