<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Theme;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThemeTest extends TestCase
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
    public function it_gets_themes_list(): void
    {
        $themes = Theme::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.themes.index'));

        $response->assertOk()->assertSee($themes[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_theme(): void
    {
        $data = Theme::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.themes.store'), $data);

        $this->assertDatabaseHas('themes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.themes.update', $theme), $data);

        $data['id'] = $theme->id;

        $this->assertDatabaseHas('themes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_theme(): void
    {
        $theme = Theme::factory()->create();

        $response = $this->deleteJson(route('api.themes.destroy', $theme));

        $this->assertSoftDeleted($theme);

        $response->assertNoContent();
    }
}
