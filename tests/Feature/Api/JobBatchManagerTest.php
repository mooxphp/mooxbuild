<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobBatchManager;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobBatchManagerTest extends TestCase
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
    public function it_gets_job_batch_managers_list(): void
    {
        $jobBatchManagers = JobBatchManager::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.job-batch-managers.index'));

        $response->assertOk()->assertSee($jobBatchManagers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_job_batch_manager(): void
    {
        $data = JobBatchManager::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.job-batch-managers.store'),
            $data
        );

        $this->assertDatabaseHas('job_batch_manager', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.job-batch-managers.update', $jobBatchManager),
            $data
        );

        $data['id'] = $jobBatchManager->id;

        $this->assertDatabaseHas('job_batch_manager', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_job_batch_manager(): void
    {
        $jobBatchManager = JobBatchManager::factory()->create();

        $response = $this->deleteJson(
            route('api.job-batch-managers.destroy', $jobBatchManager)
        );

        $this->assertModelMissing($jobBatchManager);

        $response->assertNoContent();
    }
}
