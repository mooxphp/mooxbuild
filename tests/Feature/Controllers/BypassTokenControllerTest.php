<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BypassToken;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BypassTokenControllerTest extends TestCase
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
    public function it_displays_index_view_with_bypass_tokens(): void
    {
        $bypassTokens = BypassToken::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bypass-tokens.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bypass_tokens.index')
            ->assertViewHas('bypassTokens');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bypass_token(): void
    {
        $response = $this->get(route('bypass-tokens.create'));

        $response->assertOk()->assertViewIs('app.bypass_tokens.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bypass_token(): void
    {
        $data = BypassToken::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bypass-tokens.store'), $data);

        $this->assertDatabaseHas('bypass_tokens', $data);

        $bypassToken = BypassToken::latest('id')->first();

        $response->assertRedirect(route('bypass-tokens.edit', $bypassToken));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bypass_token(): void
    {
        $bypassToken = BypassToken::factory()->create();

        $response = $this->get(route('bypass-tokens.show', $bypassToken));

        $response
            ->assertOk()
            ->assertViewIs('app.bypass_tokens.show')
            ->assertViewHas('bypassToken');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bypass_token(): void
    {
        $bypassToken = BypassToken::factory()->create();

        $response = $this->get(route('bypass-tokens.edit', $bypassToken));

        $response
            ->assertOk()
            ->assertViewIs('app.bypass_tokens.edit')
            ->assertViewHas('bypassToken');
    }

    /**
     * @test
     */
    public function it_updates_the_bypass_token(): void
    {
        $bypassToken = BypassToken::factory()->create();

        $user = User::factory()->create();

        $data = [
            'token' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->put(
            route('bypass-tokens.update', $bypassToken),
            $data
        );

        $data['id'] = $bypassToken->id;

        $this->assertDatabaseHas('bypass_tokens', $data);

        $response->assertRedirect(route('bypass-tokens.edit', $bypassToken));
    }

    /**
     * @test
     */
    public function it_deletes_the_bypass_token(): void
    {
        $bypassToken = BypassToken::factory()->create();

        $response = $this->delete(route('bypass-tokens.destroy', $bypassToken));

        $response->assertRedirect(route('bypass-tokens.index'));

        $this->assertModelMissing($bypassToken);
    }
}
