<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobManager;
use App\Models\JobQueueWorker;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobQueueWorkerJobManagersTest extends TestCase
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
    public function it_gets_job_queue_worker_job_managers(): void
    {
        $jobQueueWorker = JobQueueWorker::factory()->create();
        $jobManagers = JobManager::factory()
            ->count(2)
            ->create([
                'job_queue_worker_id' => $jobQueueWorker->id,
            ]);

        $response = $this->getJson(
            route('api.job-queue-workers.job-managers.index', $jobQueueWorker)
        );

        $response->assertOk()->assertSee($jobManagers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_job_queue_worker_job_managers(): void
    {
        $jobQueueWorker = JobQueueWorker::factory()->create();
        $data = JobManager::factory()
            ->make([
                'job_queue_worker_id' => $jobQueueWorker->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.job-queue-workers.job-managers.store', $jobQueueWorker),
            $data
        );

        $this->assertDatabaseHas('job_manager', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $jobManager = JobManager::latest('id')->first();

        $this->assertEquals(
            $jobQueueWorker->id,
            $jobManager->job_queue_worker_id
        );
    }
}
