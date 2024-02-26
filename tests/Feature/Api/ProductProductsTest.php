<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductProductsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_product_products(): void
    {
        $product = Product::factory()->create();
        $products = Product::factory()
            ->count(2)
            ->create([
                'translation_id' => $product->id,
            ]);

        $response = $this->getJson(
            route('api.products.products.index', $product)
        );

        $response->assertOk()->assertSee($products[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_product_products(): void
    {
        $product = Product::factory()->create();
        $data = Product::factory()
            ->make([
                'translation_id' => $product->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.products.products.store', $product),
            $data
        );

        $this->assertDatabaseHas('products', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $product = Product::latest('id')->first();

        $this->assertEquals($product->id, $product->translation_id);
    }
}
