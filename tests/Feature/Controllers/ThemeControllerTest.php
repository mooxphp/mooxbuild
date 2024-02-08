<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Theme;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThemeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_themes(): void
    {
        $themes = Theme::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('themes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.themes.index')
            ->assertViewHas('themes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_theme(): void
    {
        $response = $this->get(route('themes.create'));

        $response->assertOk()->assertViewIs('app.themes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_theme(): void
    {
        $data = Theme::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('themes.store'), $data);

        $this->assertDatabaseHas('themes', $data);

        $theme = Theme::latest('id')->first();

        $response->assertRedirect(route('themes.edit', $theme));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_theme(): void
    {
        $theme = Theme::factory()->create();

        $response = $this->get(route('themes.show', $theme));

        $response
            ->assertOk()
            ->assertViewIs('app.themes.show')
            ->assertViewHas('theme');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_theme(): void
    {
        $theme = Theme::factory()->create();

        $response = $this->get(route('themes.edit', $theme));

        $response
            ->assertOk()
            ->assertViewIs('app.themes.edit')
            ->assertViewHas('theme');
    }

    /**
     * @test
     */
    public function it_updates_the_theme(): void
    {
        $theme = Theme::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'theme_package' => $this->faker->text(255),
        ];

        $response = $this->put(route('themes.update', $theme), $data);

        $data['id'] = $theme->id;

        $this->assertDatabaseHas('themes', $data);

        $response->assertRedirect(route('themes.edit', $theme));
    }

    /**
     * @test
     */
    public function it_deletes_the_theme(): void
    {
        $theme = Theme::factory()->create();

        $response = $this->delete(route('themes.destroy', $theme));

        $response->assertRedirect(route('themes.index'));

        $this->assertSoftDeleted($theme);
    }
}
