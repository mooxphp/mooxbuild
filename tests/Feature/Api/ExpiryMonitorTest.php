<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ExpiryMonitor;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpiryMonitorTest extends TestCase
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
    public function it_gets_expiry_monitors_list(): void
    {
        $expiryMonitors = ExpiryMonitor::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.expiry-monitors.index'));

        $response->assertOk()->assertSee($expiryMonitors[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_expiry_monitor(): void
    {
        $data = ExpiryMonitor::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.expiry-monitors.store'), $data);

        $this->assertDatabaseHas('expiry_monitors', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_expiry_monitor(): void
    {
        $expiryMonitor = ExpiryMonitor::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(15),
            'runs' => 'weekly',
            'monitors' => $this->faker->text(255),
            'executes' => $this->faker->text(255),
            'notifies' => $this->faker->text(255),
            'escalates' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.expiry-monitors.update', $expiryMonitor),
            $data
        );

        $data['id'] = $expiryMonitor->id;

        $this->assertDatabaseHas('expiry_monitors', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_expiry_monitor(): void
    {
        $expiryMonitor = ExpiryMonitor::factory()->create();

        $response = $this->deleteJson(
            route('api.expiry-monitors.destroy', $expiryMonitor)
        );

        $this->assertModelMissing($expiryMonitor);

        $response->assertNoContent();
    }
}
