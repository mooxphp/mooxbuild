<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpUser;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpUserControllerTest extends TestCase
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
    public function it_displays_index_view_with_wp_users(): void
    {
        $wpUsers = WpUser::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-users.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_users.index')
            ->assertViewHas('wpUsers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_user(): void
    {
        $response = $this->get(route('wp-users.create'));

        $response->assertOk()->assertViewIs('app.wp_users.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_user(): void
    {
        $data = WpUser::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-users.store'), $data);

        $this->assertDatabaseHas('wp_users', $data);

        $wpUser = WpUser::latest('id')->first();

        $response->assertRedirect(route('wp-users.edit', $wpUser));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_user(): void
    {
        $wpUser = WpUser::factory()->create();

        $response = $this->get(route('wp-users.show', $wpUser));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_users.show')
            ->assertViewHas('wpUser');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_user(): void
    {
        $wpUser = WpUser::factory()->create();

        $response = $this->get(route('wp-users.edit', $wpUser));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_users.edit')
            ->assertViewHas('wpUser');
    }

    /**
     * @test
     */
    public function it_updates_the_wp_user(): void
    {
        $wpUser = WpUser::factory()->create();

        $data = [
            'user_login' => $this->faker->text(60),
            'user_pass' => $this->faker->text(255),
            'user_nicename' => $this->faker->text(50),
            'user_email' => $this->faker->text(100),
            'user_url' => $this->faker->text(100),
            'user_registered' => $this->faker->dateTime(),
            'user_activation_key' => $this->faker->text(255),
            'user_status' => $this->faker->randomNumber(0),
            'display_name' => $this->faker->text(255),
            'spam' => $this->faker->boolean(),
            'deleted' => $this->faker->boolean(),
        ];

        $response = $this->put(route('wp-users.update', $wpUser), $data);

        $data['id'] = $wpUser->id;

        $this->assertDatabaseHas('wp_users', $data);

        $response->assertRedirect(route('wp-users.edit', $wpUser));
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_user(): void
    {
        $wpUser = WpUser::factory()->create();

        $response = $this->delete(route('wp-users.destroy', $wpUser));

        $response->assertRedirect(route('wp-users.index'));

        $this->assertModelMissing($wpUser);
    }
}
