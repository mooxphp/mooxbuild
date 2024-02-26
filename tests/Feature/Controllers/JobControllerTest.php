<?php

namespace Tests\Feature\Controllers;

use App\Models\Job;
use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobControllerTest extends TestCase
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
    public function it_displays_index_view_with_jobs(): void
    {
        $jobs = Job::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('jobs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.jobs.index')
            ->assertViewHas('jobs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_job(): void
    {
        $response = $this->get(route('jobs.create'));

        $response->assertOk()->assertViewIs('app.jobs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_job(): void
    {
        $data = Job::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('jobs.store'), $data);

        $this->assertDatabaseHas('jobs', $data);

        $job = Job::latest('id')->first();

        $response->assertRedirect(route('jobs.edit', $job));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_job(): void
    {
        $job = Job::factory()->create();

        $response = $this->get(route('jobs.show', $job));

        $response
            ->assertOk()
            ->assertViewIs('app.jobs.show')
            ->assertViewHas('job');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_job(): void
    {
        $job = Job::factory()->create();

        $response = $this->get(route('jobs.edit', $job));

        $response
            ->assertOk()
            ->assertViewIs('app.jobs.edit')
            ->assertViewHas('job');
    }

    /**
     * @test
     */
    public function it_updates_the_job(): void
    {
        $job = Job::factory()->create();

        $data = [
            'queue' => $this->faker->text(255),
            'payload' => $this->faker->text(),
            'attempts' => $this->faker->numberBetween(0, 127),
            'reserved_at' => $this->faker->randomNumber(),
            'available_at' => $this->faker->randomNumber(),
            'created_at' => $this->faker->randomNumber(),
        ];

        $response = $this->put(route('jobs.update', $job), $data);

        $data['id'] = $job->id;

        $this->assertDatabaseHas('jobs', $data);

        $response->assertRedirect(route('jobs.edit', $job));
    }

    /**
     * @test
     */
    public function it_deletes_the_job(): void
    {
        $job = Job::factory()->create();

        $response = $this->delete(route('jobs.destroy', $job));

        $response->assertRedirect(route('jobs.index'));

        $this->assertModelMissing($job);
    }
}
