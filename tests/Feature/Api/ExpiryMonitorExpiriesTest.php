<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Expiry;
use App\Models\ExpiryMonitor;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpiryMonitorExpiriesTest extends TestCase
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
    public function it_gets_expiry_monitor_expiries(): void
    {
        $expiryMonitor = ExpiryMonitor::factory()->create();
        $expiries = Expiry::factory()
            ->count(2)
            ->create([
                'expiry_monitor_id' => $expiryMonitor->id,
            ]);

        $response = $this->getJson(
            route('api.expiry-monitors.expiries.index', $expiryMonitor)
        );

        $response->assertOk()->assertSee($expiries[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_expiry_monitor_expiries(): void
    {
        $expiryMonitor = ExpiryMonitor::factory()->create();
        $data = Expiry::factory()
            ->make([
                'expiry_monitor_id' => $expiryMonitor->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.expiry-monitors.expiries.store', $expiryMonitor),
            $data
        );

        $this->assertDatabaseHas('expiries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $expiry = Expiry::latest('id')->first();

        $this->assertEquals($expiryMonitor->id, $expiry->expiry_monitor_id);
    }
}
