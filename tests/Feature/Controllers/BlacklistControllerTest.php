<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Blacklist;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlacklistControllerTest extends TestCase
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
    public function it_displays_index_view_with_blacklists(): void
    {
        $blacklists = Blacklist::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('blacklists.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.blacklists.index')
            ->assertViewHas('blacklists');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_blacklist(): void
    {
        $response = $this->get(route('blacklists.create'));

        $response->assertOk()->assertViewIs('app.blacklists.create');
    }

    /**
     * @test
     */
    public function it_stores_the_blacklist(): void
    {
        $data = Blacklist::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('blacklists.store'), $data);

        $this->assertDatabaseHas('blacklists', $data);

        $blacklist = Blacklist::latest('id')->first();

        $response->assertRedirect(route('blacklists.edit', $blacklist));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_blacklist(): void
    {
        $blacklist = Blacklist::factory()->create();

        $response = $this->get(route('blacklists.show', $blacklist));

        $response
            ->assertOk()
            ->assertViewIs('app.blacklists.show')
            ->assertViewHas('blacklist');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_blacklist(): void
    {
        $blacklist = Blacklist::factory()->create();

        $response = $this->get(route('blacklists.edit', $blacklist));

        $response
            ->assertOk()
            ->assertViewIs('app.blacklists.edit')
            ->assertViewHas('blacklist');
    }

    /**
     * @test
     */
    public function it_updates_the_blacklist(): void
    {
        $blacklist = Blacklist::factory()->create();

        $data = [];

        $response = $this->put(route('blacklists.update', $blacklist), $data);

        $data['id'] = $blacklist->id;

        $this->assertDatabaseHas('blacklists', $data);

        $response->assertRedirect(route('blacklists.edit', $blacklist));
    }

    /**
     * @test
     */
    public function it_deletes_the_blacklist(): void
    {
        $blacklist = Blacklist::factory()->create();

        $response = $this->delete(route('blacklists.destroy', $blacklist));

        $response->assertRedirect(route('blacklists.index'));

        $this->assertModelMissing($blacklist);
    }
}
