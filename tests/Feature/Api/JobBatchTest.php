<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobBatch;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobBatchTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_job_batches_list(): void
    {
        $jobBatches = JobBatch::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.job-batches.index'));

        $response->assertOk()->assertSee($jobBatches[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_job_batch(): void
    {
        $data = JobBatch::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.job-batches.store'), $data);

        $this->assertDatabaseHas('job_batches', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.job-batches.update', $jobBatch),
            $data
        );

        $data['id'] = $jobBatch->id;

        $this->assertDatabaseHas('job_batches', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job_batch(): void
    {
        $jobBatch = JobBatch::factory()->create();

        $response = $this->deleteJson(
            route('api.job-batches.destroy', $jobBatch)
        );

        $this->assertModelMissing($jobBatch);

        $response->assertNoContent();
    }
}
