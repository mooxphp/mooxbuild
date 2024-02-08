<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Wishlist;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_wishlists(): void
    {
        $wishlists = Wishlist::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wishlists.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wishlists.index')
            ->assertViewHas('wishlists');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wishlist(): void
    {
        $response = $this->get(route('wishlists.create'));

        $response->assertOk()->assertViewIs('app.wishlists.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wishlist(): void
    {
        $data = Wishlist::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wishlists.store'), $data);

        $this->assertDatabaseHas('wishlists', $data);

        $wishlist = Wishlist::latest('id')->first();

        $response->assertRedirect(route('wishlists.edit', $wishlist));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wishlist(): void
    {
        $wishlist = Wishlist::factory()->create();

        $response = $this->get(route('wishlists.show', $wishlist));

        $response
            ->assertOk()
            ->assertViewIs('app.wishlists.show')
            ->assertViewHas('wishlist');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wishlist(): void
    {
        $wishlist = Wishlist::factory()->create();

        $response = $this->get(route('wishlists.edit', $wishlist));

        $response
            ->assertOk()
            ->assertViewIs('app.wishlists.edit')
            ->assertViewHas('wishlist');
    }

    /**
     * @test
     */
    public function it_updates_the_wishlist(): void
    {
        $wishlist = Wishlist::factory()->create();

        $data = [];

        $response = $this->put(route('wishlists.update', $wishlist), $data);

        $data['id'] = $wishlist->id;

        $this->assertDatabaseHas('wishlists', $data);

        $response->assertRedirect(route('wishlists.edit', $wishlist));
    }

    /**
     * @test
     */
    public function it_deletes_the_wishlist(): void
    {
        $wishlist = Wishlist::factory()->create();

        $response = $this->delete(route('wishlists.destroy', $wishlist));

        $response->assertRedirect(route('wishlists.index'));

        $this->assertModelMissing($wishlist);
    }
}
