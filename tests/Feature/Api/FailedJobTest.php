<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\FailedJob;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FailedJobTest extends TestCase
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
    public function it_gets_failed_jobs_list(): void
    {
        $failedJobs = FailedJob::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.failed-jobs.index'));

        $response->assertOk()->assertSee($failedJobs[0]->uuid);
    }

    /**
     * @test
     */
    public function it_stores_the_failed_job(): void
    {
        $data = FailedJob::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.failed-jobs.store'), $data);

        $this->assertDatabaseHas('failed_jobs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.failed-jobs.update', $failedJob),
            $data
        );

        $data['id'] = $failedJob->id;

        $this->assertDatabaseHas('failed_jobs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_failed_job(): void
    {
        $failedJob = FailedJob::factory()->create();

        $response = $this->deleteJson(
            route('api.failed-jobs.destroy', $failedJob)
        );

        $this->assertModelMissing($failedJob);

        $response->assertNoContent();
    }
}
