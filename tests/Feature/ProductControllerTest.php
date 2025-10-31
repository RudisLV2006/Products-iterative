<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase; // ensures a fresh DB for each test

    public function test_index_displays_products()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.index'));

        $response->assertStatus(200);
        $response->assertViewIs('products.index');
        $response->assertViewHas('products', function ($products) use ($product) {
            return $products->contains($product);
        });
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('product.create'));

        $response->assertStatus(200);
        $response->assertViewIs('products.create');
    }

    public function test_store_creates_product()
    {
        $data = [
            'name' => 'Test Product',
            'quantity' => 10,
            'description' => 'Test description',
            'expiration_date' => now()->addDays(10)->format('Y-m-d'),
            'status' => 'active',
        ];

        $response = $this->post(route('product.store'), $data);

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
        $response->assertSessionHas('success', 'Produkts veiksmīgi pievienots!');
    }

    public function test_show_displays_product()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.show', $product));

        $response->assertStatus(200);
        $response->assertViewIs('products.show');
        $response->assertViewHas('product', $product);
    }

    public function test_edit_displays_form()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.edit', $product));

        $response->assertStatus(200);
        $response->assertViewIs('products.edit');
        $response->assertViewHas('product', $product);
    }

    public function test_update_modifies_product()
    {
        $product = Product::factory()->create();

        $data = [
            'name' => 'Updated Product',
            'quantity' => 20,
            'description' => 'Updated description',
            'expiration_date' => now()->addDays(20)->format('Y-m-d'),
            'status' => 'inactive',
        ];

        $response = $this->put(route('product.update', $product), $data);

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Updated Product']);
        $response->assertSessionHas('success', 'Produkts veiksmīgi atjaunots!');
    }

    public function test_destroy_deletes_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('product.destroy', $product));

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $response->assertSessionHas('success', 'Produkts veiksmīgi izdzēsts!');
    }
}
