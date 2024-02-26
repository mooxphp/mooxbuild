<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Wishlist;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistTest extends TestCase
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
    public function it_gets_wishlists_list(): void
    {
        $wishlists = Wishlist::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wishlists.index'));

        $response->assertOk()->assertSee($wishlists[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_wishlist(): void
    {
        $data = Wishlist::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wishlists.store'), $data);

        $this->assertDatabaseHas('wishlists', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_wishlist(): void
    {
        $wishlist = Wishlist::factory()->create();

        $data = [];

        $response = $this->putJson(
            route('api.wishlists.update', $wishlist),
            $data
        );

        $data['id'] = $wishlist->id;

        $this->assertDatabaseHas('wishlists', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wishlist(): void
    {
        $wishlist = Wishlist::factory()->create();

        $response = $this->deleteJson(
            route('api.wishlists.destroy', $wishlist)
        );

        $this->assertModelMissing($wishlist);

        $response->assertNoContent();
    }
}
