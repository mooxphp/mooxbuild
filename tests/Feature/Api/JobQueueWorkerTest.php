<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobQueueWorker;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobQueueWorkerTest extends TestCase
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
    public function it_gets_job_queue_workers_list(): void
    {
        $jobQueueWorkers = JobQueueWorker::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.job-queue-workers.index'));

        $response->assertOk()->assertSee($jobQueueWorkers[0]->worker_pid);
    }

    /**
     * @test
     */
    public function it_stores_the_job_queue_worker(): void
    {
        $data = JobQueueWorker::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.job-queue-workers.store'),
            $data
        );

        $this->assertDatabaseHas('job_queue_workers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_job_queue_worker(): void
    {
        $jobQueueWorker = JobQueueWorker::factory()->create();

        $data = [
            'worker_pid' => $this->faker->text(255),
            'queue' => $this->faker->text(255),
            'worker_server' => $this->faker->text(255),
            'supervisor' => $this->faker->text(255),
            'status' => $this->faker->word(),
            'started_at' => $this->faker->dateTime(),
            'stopped_at' => $this->faker->dateTime(),
        ];

        $response = $this->putJson(
            route('api.job-queue-workers.update', $jobQueueWorker),
            $data
        );

        $data['id'] = $jobQueueWorker->id;

        $this->assertDatabaseHas('job_queue_workers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job_queue_worker(): void
    {
        $jobQueueWorker = JobQueueWorker::factory()->create();

        $response = $this->deleteJson(
            route('api.job-queue-workers.destroy', $jobQueueWorker)
        );

        $this->assertModelMissing($jobQueueWorker);

        $response->assertNoContent();
    }
}
