<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BypassToken;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BypassTokenTest extends TestCase
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
    public function it_gets_bypass_tokens_list(): void
    {
        $bypassTokens = BypassToken::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bypass-tokens.index'));

        $response->assertOk()->assertSee($bypassTokens[0]->token);
    }

    /**
     * @test
     */
    public function it_stores_the_bypass_token(): void
    {
        $data = BypassToken::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bypass-tokens.store'), $data);

        $this->assertDatabaseHas('bypass_tokens', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.bypass-tokens.update', $bypassToken),
            $data
        );

        $data['id'] = $bypassToken->id;

        $this->assertDatabaseHas('bypass_tokens', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bypass_token(): void
    {
        $bypassToken = BypassToken::factory()->create();

        $response = $this->deleteJson(
            route('api.bypass-tokens.destroy', $bypassToken)
        );

        $this->assertModelMissing($bypassToken);

        $response->assertNoContent();
    }
}
