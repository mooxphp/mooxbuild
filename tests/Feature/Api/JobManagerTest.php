<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobManager;

use App\Models\JobQueueWorker;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobManagerTest extends TestCase
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
    public function it_gets_job_managers_list(): void
    {
        $jobManagers = JobManager::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.job-managers.index'));

        $response->assertOk()->assertSee($jobManagers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_job_manager(): void
    {
        $data = JobManager::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.job-managers.store'), $data);

        $this->assertDatabaseHas('job_manager', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_job_manager(): void
    {
        $jobManager = JobManager::factory()->create();

        $jobQueueWorker = JobQueueWorker::factory()->create();

        $data = [
            'job_id' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'queue' => $this->faker->text(255),
            'connection' => $this->faker->text(255),
            'available_at' => $this->faker->dateTime(),
            'started_at' => $this->faker->dateTime(),
            'finished_at' => $this->faker->dateTime(),
            'failed' => $this->faker->boolean(),
            'attempt' => $this->faker->randomNumber(0),
            'progress' => $this->faker->randomNumber(0),
            'exception_message' => $this->faker->text(),
            'status' => $this->faker->word(),
            'job_queue_worker_id' => $jobQueueWorker->id,
        ];

        $response = $this->putJson(
            route('api.job-managers.update', $jobManager),
            $data
        );

        $data['id'] = $jobManager->id;

        $this->assertDatabaseHas('job_manager', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job_manager(): void
    {
        $jobManager = JobManager::factory()->create();

        $response = $this->deleteJson(
            route('api.job-managers.destroy', $jobManager)
        );

        $this->assertModelMissing($jobManager);

        $response->assertNoContent();
    }
}
