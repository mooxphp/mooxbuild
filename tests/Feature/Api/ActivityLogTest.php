<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ActivityLog;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityLogTest extends TestCase
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
    public function it_gets_activity_logs_list(): void
    {
        $activityLogs = ActivityLog::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.activity-logs.index'));

        $response->assertOk()->assertSee($activityLogs[0]->log_name);
    }

    /**
     * @test
     */
    public function it_stores_the_activity_log(): void
    {
        $data = ActivityLog::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.activity-logs.store'), $data);

        $this->assertDatabaseHas('activity_log', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_activity_log(): void
    {
        $activityLog = ActivityLog::factory()->create();

        $data = [
            'log_name' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'event' => $this->faker->text(255),
            'properties' => [],
            'batch_uuid' => $this->faker->uuid(),
        ];

        $response = $this->putJson(
            route('api.activity-logs.update', $activityLog),
            $data
        );

        $data['id'] = $activityLog->id;

        $this->assertDatabaseHas('activity_log', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_activity_log(): void
    {
        $activityLog = ActivityLog::factory()->create();

        $response = $this->deleteJson(
            route('api.activity-logs.destroy', $activityLog)
        );

        $this->assertModelMissing($activityLog);

        $response->assertNoContent();
    }
}
