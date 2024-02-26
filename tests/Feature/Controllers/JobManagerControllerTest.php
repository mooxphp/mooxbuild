<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\JobManager;

use App\Models\JobQueueWorker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobManagerControllerTest extends TestCase
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

    /**
     * @test
     */
    public function it_displays_index_view_with_job_managers(): void
    {
        $jobManagers = JobManager::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('job-managers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.job_managers.index')
            ->assertViewHas('jobManagers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_job_manager(): void
    {
        $response = $this->get(route('job-managers.create'));

        $response->assertOk()->assertViewIs('app.job_managers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_job_manager(): void
    {
        $data = JobManager::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('job-managers.store'), $data);

        $this->assertDatabaseHas('job_manager', $data);

        $jobManager = JobManager::latest('id')->first();

        $response->assertRedirect(route('job-managers.edit', $jobManager));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_job_manager(): void
    {
        $jobManager = JobManager::factory()->create();

        $response = $this->get(route('job-managers.show', $jobManager));

        $response
            ->assertOk()
            ->assertViewIs('app.job_managers.show')
            ->assertViewHas('jobManager');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_job_manager(): void
    {
        $jobManager = JobManager::factory()->create();

        $response = $this->get(route('job-managers.edit', $jobManager));

        $response
            ->assertOk()
            ->assertViewIs('app.job_managers.edit')
            ->assertViewHas('jobManager');
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

        $response = $this->put(
            route('job-managers.update', $jobManager),
            $data
        );

        $data['id'] = $jobManager->id;

        $this->assertDatabaseHas('job_manager', $data);

        $response->assertRedirect(route('job-managers.edit', $jobManager));
    }

    /**
     * @test
     */
    public function it_deletes_the_job_manager(): void
    {
        $jobManager = JobManager::factory()->create();

        $response = $this->delete(route('job-managers.destroy', $jobManager));

        $response->assertRedirect(route('job-managers.index'));

        $this->assertModelMissing($jobManager);
    }
}
