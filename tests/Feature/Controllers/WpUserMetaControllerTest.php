<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpUserMeta;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpUserMetaControllerTest extends TestCase
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
    public function it_displays_index_view_with_wp_user_metas(): void
    {
        $wpUserMetas = WpUserMeta::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-user-metas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_user_metas.index')
            ->assertViewHas('wpUserMetas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_user_meta(): void
    {
        $response = $this->get(route('wp-user-metas.create'));

        $response->assertOk()->assertViewIs('app.wp_user_metas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_user_meta(): void
    {
        $data = WpUserMeta::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-user-metas.store'), $data);

        $this->assertDatabaseHas('wp_usermeta', $data);

        $wpUserMeta = WpUserMeta::latest('umeta_id')->first();

        $response->assertRedirect(route('wp-user-metas.edit', $wpUserMeta));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_user_meta(): void
    {
        $wpUserMeta = WpUserMeta::factory()->create();

        $response = $this->get(route('wp-user-metas.show', $wpUserMeta));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_user_metas.show')
            ->assertViewHas('wpUserMeta');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_user_meta(): void
    {
        $wpUserMeta = WpUserMeta::factory()->create();

        $response = $this->get(route('wp-user-metas.edit', $wpUserMeta));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_user_metas.edit')
            ->assertViewHas('wpUserMeta');
    }

    /**
     * @test
     */
    public function it_updates_the_wp_user_meta(): void
    {
        $wpUserMeta = WpUserMeta::factory()->create();

        $data = [
            'user_id' => $this->faker->randomNumber(),
            'meta_key' => $this->faker->text(255),
            'meta_value' => $this->faker->text(),
        ];

        $response = $this->put(
            route('wp-user-metas.update', $wpUserMeta),
            $data
        );

        $data['umeta_id'] = $wpUserMeta->umeta_id;

        $this->assertDatabaseHas('wp_usermeta', $data);

        $response->assertRedirect(route('wp-user-metas.edit', $wpUserMeta));
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_user_meta(): void
    {
        $wpUserMeta = WpUserMeta::factory()->create();

        $response = $this->delete(route('wp-user-metas.destroy', $wpUserMeta));

        $response->assertRedirect(route('wp-user-metas.index'));

        $this->assertModelMissing($wpUserMeta);
    }
}
