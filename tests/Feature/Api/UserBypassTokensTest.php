<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BypassToken;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserBypassTokensTest extends TestCase
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
    public function it_gets_user_bypass_tokens(): void
    {
        $user = User::factory()->create();
        $bypassTokens = BypassToken::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.bypass-tokens.index', $user)
        );

        $response->assertOk()->assertSee($bypassTokens[0]->token);
    }

    /**
     * @test
     */
    public function it_stores_the_user_bypass_tokens(): void
    {
        $user = User::factory()->create();
        $data = BypassToken::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.bypass-tokens.store', $user),
            $data
        );

        $this->assertDatabaseHas('bypass_tokens', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bypassToken = BypassToken::latest('id')->first();

        $this->assertEquals($user->id, $bypassToken->user_id);
    }
}
