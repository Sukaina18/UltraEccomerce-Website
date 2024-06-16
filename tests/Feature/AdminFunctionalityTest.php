<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminFunctionalityTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_orders()
    {
        $this->actingAsAdmin();

        $response = $this->get('/view_order');

        $response->assertStatus(200);
    }



    public function test_admin_can_view_customer_data()
    {
        $this->actingAsAdmin();

        $response = $this->get('/customer_data');

        $response->assertStatus(200);
    }

        public function test_home_page_loads_correctly()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    //creates a fake admin to run the tests
    private function actingAsAdmin()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');
    }
}
