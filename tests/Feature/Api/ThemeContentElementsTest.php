<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Theme;
use App\Models\ContentElement;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThemeContentElementsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_theme_content_elements(): void
    {
        $theme = Theme::factory()->create();
        $contentElements = ContentElement::factory()
            ->count(2)
            ->create([
                'theme_id' => $theme->id,
            ]);

        $response = $this->getJson(
            route('api.themes.content-elements.index', $theme)
        );

        $response->assertOk()->assertSee($contentElements[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_theme_content_elements(): void
    {
        $theme = Theme::factory()->create();
        $data = ContentElement::factory()
            ->make([
                'theme_id' => $theme->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.themes.content-elements.store', $theme),
            $data
        );

        $this->assertDatabaseHas('content_elements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $contentElement = ContentElement::latest('id')->first();

        $this->assertEquals($theme->id, $contentElement->theme_id);
    }
}
