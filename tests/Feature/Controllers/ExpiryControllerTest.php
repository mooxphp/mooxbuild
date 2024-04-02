<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Expiry;

use App\Models\ExpiryMonitor;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpiryControllerTest extends TestCase
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
    public function it_displays_index_view_with_expiries(): void
    {
        $expiries = Expiry::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('expiries.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.expiries.index')
            ->assertViewHas('expiries');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_expiry(): void
    {
        $response = $this->get(route('expiries.create'));

        $response->assertOk()->assertViewIs('app.expiries.create');
    }

    /**
     * @test
     */
    public function it_stores_the_expiry(): void
    {
        $data = Expiry::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('expiries.store'), $data);

        $this->assertDatabaseHas('expiries', $data);

        $expiry = Expiry::latest('id')->first();

        $response->assertRedirect(route('expiries.edit', $expiry));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_expiry(): void
    {
        $expiry = Expiry::factory()->create();

        $response = $this->get(route('expiries.show', $expiry));

        $response
            ->assertOk()
            ->assertViewIs('app.expiries.show')
            ->assertViewHas('expiry');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_expiry(): void
    {
        $expiry = Expiry::factory()->create();

        $response = $this->get(route('expiries.edit', $expiry));

        $response
            ->assertOk()
            ->assertViewIs('app.expiries.edit')
            ->assertViewHas('expiry');
    }

    /**
     * @test
     */
    public function it_updates_the_expiry(): void
    {
        $expiry = Expiry::factory()->create();

        $expiryMonitor = ExpiryMonitor::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'item' => $this->faker->text(255),
            'link' => $this->faker->text(255),
            'expired_at' => $this->faker->dateTime(),
            'notified_at' => $this->faker->dateTime(),
            'notified_to' => $this->faker->text(255),
            'escalated_at' => $this->faker->dateTime(),
            'escalated_to' => $this->faker->text(255),
            'handled_by' => $this->faker->text(255),
            'done_at' => $this->faker->dateTime(),
            'expiry_monitor_id' => $expiryMonitor->id,
        ];

        $response = $this->put(route('expiries.update', $expiry), $data);

        $data['id'] = $expiry->id;

        $this->assertDatabaseHas('expiries', $data);

        $response->assertRedirect(route('expiries.edit', $expiry));
    }

    /**
     * @test
     */
    public function it_deletes_the_expiry(): void
    {
        $expiry = Expiry::factory()->create();

        $response = $this->delete(route('expiries.destroy', $expiry));

        $response->assertRedirect(route('expiries.index'));

        $this->assertSoftDeleted($expiry);
    }
}
