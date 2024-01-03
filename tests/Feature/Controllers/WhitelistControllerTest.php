<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Whitelist;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WhitelistControllerTest extends TestCase
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
    public function it_displays_index_view_with_whitelists(): void
    {
        $whitelists = Whitelist::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('whitelists.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.whitelists.index')
            ->assertViewHas('whitelists');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_whitelist(): void
    {
        $response = $this->get(route('whitelists.create'));

        $response->assertOk()->assertViewIs('app.whitelists.create');
    }

    /**
     * @test
     */
    public function it_stores_the_whitelist(): void
    {
        $data = Whitelist::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('whitelists.store'), $data);

        $this->assertDatabaseHas('whitelists', $data);

        $whitelist = Whitelist::latest('id')->first();

        $response->assertRedirect(route('whitelists.edit', $whitelist));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_whitelist(): void
    {
        $whitelist = Whitelist::factory()->create();

        $response = $this->get(route('whitelists.show', $whitelist));

        $response
            ->assertOk()
            ->assertViewIs('app.whitelists.show')
            ->assertViewHas('whitelist');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_whitelist(): void
    {
        $whitelist = Whitelist::factory()->create();

        $response = $this->get(route('whitelists.edit', $whitelist));

        $response
            ->assertOk()
            ->assertViewIs('app.whitelists.edit')
            ->assertViewHas('whitelist');
    }

    /**
     * @test
     */
    public function it_updates_the_whitelist(): void
    {
        $whitelist = Whitelist::factory()->create();

        $data = [
            'comment' => $this->faker->text(),
            'ip-address' => $this->faker->text(255),
            'lookup' => $this->faker->text(255),
            'expires' => $this->faker->dateTime(),
        ];

        $response = $this->put(route('whitelists.update', $whitelist), $data);

        $data['id'] = $whitelist->id;

        $this->assertDatabaseHas('whitelists', $data);

        $response->assertRedirect(route('whitelists.edit', $whitelist));
    }

    /**
     * @test
     */
    public function it_deletes_the_whitelist(): void
    {
        $whitelist = Whitelist::factory()->create();

        $response = $this->delete(route('whitelists.destroy', $whitelist));

        $response->assertRedirect(route('whitelists.index'));

        $this->assertSoftDeleted($whitelist);
    }
}
