<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\JobBatch;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobBatchControllerTest extends TestCase
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
    public function it_displays_index_view_with_job_batches(): void
    {
        $jobBatches = JobBatch::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('job-batches.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.job_batches.index')
            ->assertViewHas('jobBatches');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_job_batch(): void
    {
        $response = $this->get(route('job-batches.create'));

        $response->assertOk()->assertViewIs('app.job_batches.create');
    }

    /**
     * @test
     */
    public function it_stores_the_job_batch(): void
    {
        $data = JobBatch::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('job-batches.store'), $data);

        $this->assertDatabaseHas('job_batches', $data);

        $jobBatch = JobBatch::latest('id')->first();

        $response->assertRedirect(route('job-batches.edit', $jobBatch));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_job_batch(): void
    {
        $jobBatch = JobBatch::factory()->create();

        $response = $this->get(route('job-batches.show', $jobBatch));

        $response
            ->assertOk()
            ->assertViewIs('app.job_batches.show')
            ->assertViewHas('jobBatch');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_job_batch(): void
    {
        $jobBatch = JobBatch::factory()->create();

        $response = $this->get(route('job-batches.edit', $jobBatch));

        $response
            ->assertOk()
            ->assertViewIs('app.job_batches.edit')
            ->assertViewHas('jobBatch');
    }

    /**
     * @test
     */
    public function it_updates_the_job_batch(): void
    {
        $jobBatch = JobBatch::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'total_jobs' => $this->faker->randomNumber(0),
            'pending_jobs' => $this->faker->randomNumber(0),
            'failed_jobs' => $this->faker->randomNumber(0),
            'failed_job_ids' => $this->faker->text(),
            'options' => $this->faker->text(),
            'cancelled_at' => $this->faker->randomNumber(0),
            'created_at' => $this->faker->randomNumber(0),
            'finished_at' => $this->faker->randomNumber(0),
        ];

        $response = $this->put(route('job-batches.update', $jobBatch), $data);

        $data['id'] = $jobBatch->id;

        $this->assertDatabaseHas('job_batches', $data);

        $response->assertRedirect(route('job-batches.edit', $jobBatch));
    }

    /**
     * @test
     */
    public function it_deletes_the_job_batch(): void
    {
        $jobBatch = JobBatch::factory()->create();

        $response = $this->delete(route('job-batches.destroy', $jobBatch));

        $response->assertRedirect(route('job-batches.index'));

        $this->assertModelMissing($jobBatch);
    }
}
