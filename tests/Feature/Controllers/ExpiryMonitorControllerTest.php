<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ExpiryMonitor;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpiryMonitorControllerTest extends TestCase
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
    public function it_displays_index_view_with_expiry_monitors(): void
    {
        $expiryMonitors = ExpiryMonitor::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('expiry-monitors.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.expiry_monitors.index')
            ->assertViewHas('expiryMonitors');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_expiry_monitor(): void
    {
        $response = $this->get(route('expiry-monitors.create'));

        $response->assertOk()->assertViewIs('app.expiry_monitors.create');
    }

    /**
     * @test
     */
    public function it_stores_the_expiry_monitor(): void
    {
        $data = ExpiryMonitor::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('expiry-monitors.store'), $data);

        $this->assertDatabaseHas('expiry_monitors', $data);

        $expiryMonitor = ExpiryMonitor::latest('id')->first();

        $response->assertRedirect(
            route('expiry-monitors.edit', $expiryMonitor)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_expiry_monitor(): void
    {
        $expiryMonitor = ExpiryMonitor::factory()->create();

        $response = $this->get(route('expiry-monitors.show', $expiryMonitor));

        $response
            ->assertOk()
            ->assertViewIs('app.expiry_monitors.show')
            ->assertViewHas('expiryMonitor');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_expiry_monitor(): void
    {
        $expiryMonitor = ExpiryMonitor::factory()->create();

        $response = $this->get(route('expiry-monitors.edit', $expiryMonitor));

        $response
            ->assertOk()
            ->assertViewIs('app.expiry_monitors.edit')
            ->assertViewHas('expiryMonitor');
    }

    /**
     * @test
     */
    public function it_updates_the_expiry_monitor(): void
    {
        $expiryMonitor = ExpiryMonitor::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(15),
            'runs' => 'weekly',
            'monitors' => $this->faker->text(255),
            'executes' => $this->faker->text(255),
            'notifies' => $this->faker->text(255),
            'escalates' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('expiry-monitors.update', $expiryMonitor),
            $data
        );

        $data['id'] = $expiryMonitor->id;

        $this->assertDatabaseHas('expiry_monitors', $data);

        $response->assertRedirect(
            route('expiry-monitors.edit', $expiryMonitor)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_expiry_monitor(): void
    {
        $expiryMonitor = ExpiryMonitor::factory()->create();

        $response = $this->delete(
            route('expiry-monitors.destroy', $expiryMonitor)
        );

        $response->assertRedirect(route('expiry-monitors.index'));

        $this->assertModelMissing($expiryMonitor);
    }
}
