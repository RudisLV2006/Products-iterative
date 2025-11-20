<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductQuantityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testē, vai produkta daudzums palielinās
     *
     * @return void
     */
    public function test_product_quantity_increases()
    {
        // Izveidot produktu ar sākotnējo daudzumu 10
        $product = Product::factory()->create([
            'quantity' => 10,
        ]);

        // Iegūt ceļu uz daudzuma palielināšanas funkciju
        $response = $this->post(route('product.updateQuantity', ['id' => $product->id, 'action' => 'increase']));

        // Pārbaudīt, vai produkta daudzums ir palielinājies par 1
        $product->refresh();
        $this->assertEquals(11, $product->quantity);

        // Pārbaudīt, vai lapā ir veiksmīga pāradresācija uz produktu sarakstu
        $response->assertRedirect(route('product.index'));
    }

    /**
     * Testē, vai produkta daudzums samazinās
     *
     * @return void
     */
    public function test_product_quantity_decreases()
    {
        // Izveidot produktu ar sākotnējo daudzumu 10
        $product = Product::factory()->create([
            'quantity' => 10,
        ]);

        // Iegūt ceļu uz daudzuma samazināšanas funkciju
        $response = $this->post(route('product.updateQuantity', ['id' => $product->id, 'action' => 'decrease']));

        // Pārbaudīt, vai produkta daudzums ir samazinājies par 1
        $product->refresh();
        $this->assertEquals(9, $product->quantity);

        // Pārbaudīt, vai lapā ir veiksmīga pāradresācija uz produktu sarakstu
        $response->assertRedirect(route('product.index'));
    }

    /**
     * Testē, vai produkta daudzums nesamazinās zem 0
     *
     * @return void
     */
    public function test_product_quantity_does_not_decrease_below_zero()
    {
        // Izveidot produktu ar sākotnējo daudzumu 0
        $product = Product::factory()->create([
            'quantity' => 0,
        ]);

        // Iegūt ceļu uz daudzuma samazināšanas funkciju
        $response = $this->post(route('product.updateQuantity', ['id' => $product->id, 'action' => 'decrease']));

        // Pārbaudīt, vai produkta daudzums nav kļuvis negatīvs
        $product->refresh();
        $this->assertEquals(0, $product->quantity);

        // Pārbaudīt, vai lapā ir veiksmīga pāradresācija uz produktu sarakstu
        $response->assertRedirect(route('product.index'));
    }
}
