<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpOption;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpOptionControllerTest extends TestCase
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
    public function it_displays_index_view_with_wp_options(): void
    {
        $wpOptions = WpOption::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-options.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_options.index')
            ->assertViewHas('wpOptions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_option(): void
    {
        $response = $this->get(route('wp-options.create'));

        $response->assertOk()->assertViewIs('app.wp_options.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_option(): void
    {
        $data = WpOption::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-options.store'), $data);

        $this->assertDatabaseHas('wp_options', $data);

        $wpOption = WpOption::latest('option_id')->first();

        $response->assertRedirect(route('wp-options.edit', $wpOption));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_option(): void
    {
        $wpOption = WpOption::factory()->create();

        $response = $this->get(route('wp-options.show', $wpOption));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_options.show')
            ->assertViewHas('wpOption');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_option(): void
    {
        $wpOption = WpOption::factory()->create();

        $response = $this->get(route('wp-options.edit', $wpOption));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_options.edit')
            ->assertViewHas('wpOption');
    }

    /**
     * @test
     */
    public function it_updates_the_wp_option(): void
    {
        $wpOption = WpOption::factory()->create();

        $data = [
            'option_name' => $this->faker->text(191),
            'option_value' => $this->faker->text(),
            'autoload' => $this->faker->text(255),
        ];

        $response = $this->put(route('wp-options.update', $wpOption), $data);

        $data['option_id'] = $wpOption->option_id;

        $this->assertDatabaseHas('wp_options', $data);

        $response->assertRedirect(route('wp-options.edit', $wpOption));
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_option(): void
    {
        $wpOption = WpOption::factory()->create();

        $response = $this->delete(route('wp-options.destroy', $wpOption));

        $response->assertRedirect(route('wp-options.index'));

        $this->assertModelMissing($wpOption);
    }
}
