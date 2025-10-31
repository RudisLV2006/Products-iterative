<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class ProductControllerUnitTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close(); // Close all mocks after each test
        parent::tearDown();
    }

    public function test_store_calls_create_with_valid_data()
    {
        $requestData = [
            'name' => 'Test Product',
            'quantity' => 10,
            'description' => 'Test description',
            'expiration_date' => now()->addDays(10)->format('Y-m-d'),
            'status' => 'active',
        ];

        $request = Mockery::mock(Request::class);
        $request->shouldReceive('validate')->once()->andReturn($requestData);

        $productMock = Mockery::mock('alias:' . Product::class);
        $productMock->shouldReceive('create')->once()->with($requestData);

        $controller = new ProductController();
        $controller->store($request);
    }

    public function test_update_calls_update_on_product()
    {
        $requestData = [
            'name' => 'Updated Product',
            'quantity' => 5,
            'description' => 'Updated desc',
            'expiration_date' => now()->addDays(5)->format('Y-m-d'),
            'status' => 'inactive',
        ];

        $request = Mockery::mock(Request::class);
        $request->shouldReceive('validate')->once()->andReturn($requestData);

        $product = Mockery::mock(Product::class);
        $product->shouldReceive('update')->once()->with($requestData);

        $controller = new ProductController();
        $controller->update($request, $product);
    }

    public function test_destroy_calls_delete_on_product()
    {
        $product = Mockery::mock(Product::class);
        $product->shouldReceive('delete')->once();

        $controller = new ProductController();
        $controller->destroy($product);
    }
}
