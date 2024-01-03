<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Author;
use App\Models\Product;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorProductsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_author_products(): void
    {
        $author = Author::factory()->create();
        $products = Product::factory()
            ->count(2)
            ->create([
                'author_id' => $author->id,
            ]);

        $response = $this->getJson(
            route('api.authors.products.index', $author)
        );

        $response->assertOk()->assertSee($products[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_author_products(): void
    {
        $author = Author::factory()->create();
        $data = Product::factory()
            ->make([
                'author_id' => $author->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.authors.products.store', $author),
            $data
        );

        $this->assertDatabaseHas('products', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $product = Product::latest('id')->first();

        $this->assertEquals($author->id, $product->author_id);
    }
}
