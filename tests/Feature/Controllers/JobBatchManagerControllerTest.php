<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\JobBatchManager;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobBatchManagerControllerTest extends TestCase
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
    public function it_displays_index_view_with_job_batch_managers(): void
    {
        $jobBatchManagers = JobBatchManager::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('job-batch-managers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.job_batch_managers.index')
            ->assertViewHas('jobBatchManagers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_job_batch_manager(): void
    {
        $response = $this->get(route('job-batch-managers.create'));

        $response->assertOk()->assertViewIs('app.job_batch_managers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_job_batch_manager(): void
    {
        $data = JobBatchManager::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('job-batch-managers.store'), $data);

        $this->assertDatabaseHas('job_batch_manager', $data);

        $jobBatchManager = JobBatchManager::latest('id')->first();

        $response->assertRedirect(
            route('job-batch-managers.edit', $jobBatchManager)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_job_batch_manager(): void
    {
        $jobBatchManager = JobBatchManager::factory()->create();

        $response = $this->get(
            route('job-batch-managers.show', $jobBatchManager)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.job_batch_managers.show')
            ->assertViewHas('jobBatchManager');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_job_batch_manager(): void
    {
        $jobBatchManager = JobBatchManager::factory()->create();

        $response = $this->get(
            route('job-batch-managers.edit', $jobBatchManager)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.job_batch_managers.edit')
            ->assertViewHas('jobBatchManager');
    }

    /**
     * @test
     */
    public function it_updates_the_job_batch_manager(): void
    {
        $jobBatchManager = JobBatchManager::factory()->create();

        $data = [
            'batch_id' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'total_jobs' => $this->faker->randomNumber(0),
            'pending_jobs' => $this->faker->randomNumber(0),
            'failed_jobs' => $this->faker->randomNumber(0),
            'failed_job_ids' => $this->faker->text(),
            'options' => $this->faker->text(),
            'cancelled_at' => $this->faker->dateTime(),
            'finished_at' => $this->faker->dateTime(),
            'status' => $this->faker->word(),
        ];

        $response = $this->put(
            route('job-batch-managers.update', $jobBatchManager),
            $data
        );

        $data['id'] = $jobBatchManager->id;

        $this->assertDatabaseHas('job_batch_manager', $data);

        $response->assertRedirect(
            route('job-batch-managers.edit', $jobBatchManager)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_job_batch_manager(): void
    {
        $jobBatchManager = JobBatchManager::factory()->create();

        $response = $this->delete(
            route('job-batch-managers.destroy', $jobBatchManager)
        );

        $response->assertRedirect(route('job-batch-managers.index'));

        $this->assertModelMissing($jobBatchManager);
    }
}
