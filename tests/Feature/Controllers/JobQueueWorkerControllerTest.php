<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\JobQueueWorker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobQueueWorkerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_job_queue_workers(): void
    {
        $jobQueueWorkers = JobQueueWorker::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('job-queue-workers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.job_queue_workers.index')
            ->assertViewHas('jobQueueWorkers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_job_queue_worker(): void
    {
        $response = $this->get(route('job-queue-workers.create'));

        $response->assertOk()->assertViewIs('app.job_queue_workers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_job_queue_worker(): void
    {
        $data = JobQueueWorker::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('job-queue-workers.store'), $data);

        $this->assertDatabaseHas('job_queue_workers', $data);

        $jobQueueWorker = JobQueueWorker::latest('id')->first();

        $response->assertRedirect(
            route('job-queue-workers.edit', $jobQueueWorker)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_job_queue_worker(): void
    {
        $jobQueueWorker = JobQueueWorker::factory()->create();

        $response = $this->get(
            route('job-queue-workers.show', $jobQueueWorker)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.job_queue_workers.show')
            ->assertViewHas('jobQueueWorker');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_job_queue_worker(): void
    {
        $jobQueueWorker = JobQueueWorker::factory()->create();

        $response = $this->get(
            route('job-queue-workers.edit', $jobQueueWorker)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.job_queue_workers.edit')
            ->assertViewHas('jobQueueWorker');
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

        $response = $this->put(
            route('job-queue-workers.update', $jobQueueWorker),
            $data
        );

        $data['id'] = $jobQueueWorker->id;

        $this->assertDatabaseHas('job_queue_workers', $data);

        $response->assertRedirect(
            route('job-queue-workers.edit', $jobQueueWorker)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_job_queue_worker(): void
    {
        $jobQueueWorker = JobQueueWorker::factory()->create();

        $response = $this->delete(
            route('job-queue-workers.destroy', $jobQueueWorker)
        );

        $response->assertRedirect(route('job-queue-workers.index'));

        $this->assertModelMissing($jobQueueWorker);
    }
}
