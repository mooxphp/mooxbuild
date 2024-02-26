<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ActivityLog;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityLogControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_activity_logs(): void
    {
        $activityLogs = ActivityLog::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('activity-logs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.activity_logs.index')
            ->assertViewHas('activityLogs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_activity_log(): void
    {
        $response = $this->get(route('activity-logs.create'));

        $response->assertOk()->assertViewIs('app.activity_logs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_activity_log(): void
    {
        $data = ActivityLog::factory()
            ->make()
            ->toArray();

        $data['properties'] = json_encode($data['properties']);

        $response = $this->post(route('activity-logs.store'), $data);

        $data['properties'] = $this->castToJson($data['properties']);

        $this->assertDatabaseHas('activity_log', $data);

        $activityLog = ActivityLog::latest('id')->first();

        $response->assertRedirect(route('activity-logs.edit', $activityLog));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_activity_log(): void
    {
        $activityLog = ActivityLog::factory()->create();

        $response = $this->get(route('activity-logs.show', $activityLog));

        $response
            ->assertOk()
            ->assertViewIs('app.activity_logs.show')
            ->assertViewHas('activityLog');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_activity_log(): void
    {
        $activityLog = ActivityLog::factory()->create();

        $response = $this->get(route('activity-logs.edit', $activityLog));

        $response
            ->assertOk()
            ->assertViewIs('app.activity_logs.edit')
            ->assertViewHas('activityLog');
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

        $data['properties'] = json_encode($data['properties']);

        $response = $this->put(
            route('activity-logs.update', $activityLog),
            $data
        );

        $data['id'] = $activityLog->id;

        $data['properties'] = $this->castToJson($data['properties']);

        $this->assertDatabaseHas('activity_log', $data);

        $response->assertRedirect(route('activity-logs.edit', $activityLog));
    }

    /**
     * @test
     */
    public function it_deletes_the_activity_log(): void
    {
        $activityLog = ActivityLog::factory()->create();

        $response = $this->delete(route('activity-logs.destroy', $activityLog));

        $response->assertRedirect(route('activity-logs.index'));

        $this->assertModelMissing($activityLog);
    }
}
