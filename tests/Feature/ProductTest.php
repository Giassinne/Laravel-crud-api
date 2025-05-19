<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Products;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [['id', 'name', 'description', 'price', 'quantity', 'created_at', 'updated_at']],
                'meta' => ['total_count']
            ]);
    }

    /** @test */
    public function it_can_create_a_product()
    {
        $data = [
            'name' => 'Ordinateur Portable',
            'description' => 'Un ordinateur performant',
            'price' => 899.99,
            'quantity' => 10,
        ];

        $response = $this->postJson('/api/products', $data);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'Ordinateur Portable']);

        $this->assertDatabaseHas('products', ['name' => 'Ordinateur Portable']);
    }

    /** @test */
    public function it_can_show_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $product->id]);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => 'Produit modifié',
            'price' => 1099.99,
        ]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'Produit modifié']);

        $this->assertDatabaseHas('products', ['name' => 'Produit modifié']);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertOk()
            ->assertJson(['message' => 'Product deleted successfully']);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
