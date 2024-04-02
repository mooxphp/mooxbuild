<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Expiry;

use App\Models\ExpiryMonitor;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpiryTest extends TestCase
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
    public function it_gets_expiries_list(): void
    {
        $expiries = Expiry::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.expiries.index'));

        $response->assertOk()->assertSee($expiries[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_expiry(): void
    {
        $data = Expiry::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.expiries.store'), $data);

        $this->assertDatabaseHas('expiries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_expiry(): void
    {
        $expiry = Expiry::factory()->create();

        $expiryMonitor = ExpiryMonitor::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'item' => $this->faker->text(255),
            'link' => $this->faker->text(255),
            'expired_at' => $this->faker->dateTime(),
            'notified_at' => $this->faker->dateTime(),
            'notified_to' => $this->faker->text(255),
            'escalated_at' => $this->faker->dateTime(),
            'escalated_to' => $this->faker->text(255),
            'handled_by' => $this->faker->text(255),
            'done_at' => $this->faker->dateTime(),
            'expiry_monitor_id' => $expiryMonitor->id,
        ];

        $response = $this->putJson(
            route('api.expiries.update', $expiry),
            $data
        );

        $data['id'] = $expiry->id;

        $this->assertDatabaseHas('expiries', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_expiry(): void
    {
        $expiry = Expiry::factory()->create();

        $response = $this->deleteJson(route('api.expiries.destroy', $expiry));

        $this->assertSoftDeleted($expiry);

        $response->assertNoContent();
    }
}
