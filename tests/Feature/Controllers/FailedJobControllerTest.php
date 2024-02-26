<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\FailedJob;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FailedJobControllerTest extends TestCase
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
    public function it_displays_index_view_with_failed_jobs(): void
    {
        $failedJobs = FailedJob::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('failed-jobs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.failed_jobs.index')
            ->assertViewHas('failedJobs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_failed_job(): void
    {
        $response = $this->get(route('failed-jobs.create'));

        $response->assertOk()->assertViewIs('app.failed_jobs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_failed_job(): void
    {
        $data = FailedJob::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('failed-jobs.store'), $data);

        $this->assertDatabaseHas('failed_jobs', $data);

        $failedJob = FailedJob::latest('id')->first();

        $response->assertRedirect(route('failed-jobs.edit', $failedJob));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_failed_job(): void
    {
        $failedJob = FailedJob::factory()->create();

        $response = $this->get(route('failed-jobs.show', $failedJob));

        $response
            ->assertOk()
            ->assertViewIs('app.failed_jobs.show')
            ->assertViewHas('failedJob');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_failed_job(): void
    {
        $failedJob = FailedJob::factory()->create();

        $response = $this->get(route('failed-jobs.edit', $failedJob));

        $response
            ->assertOk()
            ->assertViewIs('app.failed_jobs.edit')
            ->assertViewHas('failedJob');
    }

    /**
     * @test
     */
    public function it_updates_the_failed_job(): void
    {
        $failedJob = FailedJob::factory()->create();

        $data = [
            'uuid' => $this->faker->text(255),
            'connection' => $this->faker->text(),
            'queue' => $this->faker->text(),
            'payload' => $this->faker->text(),
            'exception' => $this->faker->text(),
            'failed_at' => $this->faker->dateTime(),
        ];

        $response = $this->put(route('failed-jobs.update', $failedJob), $data);

        $data['id'] = $failedJob->id;

        $this->assertDatabaseHas('failed_jobs', $data);

        $response->assertRedirect(route('failed-jobs.edit', $failedJob));
    }

    /**
     * @test
     */
    public function it_deletes_the_failed_job(): void
    {
        $failedJob = FailedJob::factory()->create();

        $response = $this->delete(route('failed-jobs.destroy', $failedJob));

        $response->assertRedirect(route('failed-jobs.index'));

        $this->assertModelMissing($failedJob);
    }
}
