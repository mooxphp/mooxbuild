<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Whitelist;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WhitelistTest extends TestCase
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
    public function it_gets_whitelists_list(): void
    {
        $whitelists = Whitelist::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.whitelists.index'));

        $response->assertOk()->assertSee($whitelists[0]->comment);
    }

    /**
     * @test
     */
    public function it_stores_the_whitelist(): void
    {
        $data = Whitelist::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.whitelists.store'), $data);

        $this->assertDatabaseHas('whitelists', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.whitelists.update', $whitelist),
            $data
        );

        $data['id'] = $whitelist->id;

        $this->assertDatabaseHas('whitelists', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_whitelist(): void
    {
        $whitelist = Whitelist::factory()->create();

        $response = $this->deleteJson(
            route('api.whitelists.destroy', $whitelist)
        );

        $this->assertSoftDeleted($whitelist);

        $response->assertNoContent();
    }
}
