<?php

namespace Tests\Feature\Controllers;

use App\Models\Tag;
use App\Models\User;

use App\Models\Language;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagControllerTest extends TestCase
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

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_tags(): void
    {
        $tags = Tag::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('tags.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.tags.index')
            ->assertViewHas('tags');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_tag(): void
    {
        $response = $this->get(route('tags.create'));

        $response->assertOk()->assertViewIs('app.tags.create');
    }

    /**
     * @test
     */
    public function it_stores_the_tag(): void
    {
        $data = Tag::factory()
            ->make()
            ->toArray();

        $data['data'] = json_encode($data['data']);

        $response = $this->post(route('tags.store'), $data);

        $data['data'] = $this->castToJson($data['data']);

        $this->assertDatabaseHas('tags', $data);

        $tag = Tag::latest('id')->first();

        $response->assertRedirect(route('tags.edit', $tag));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_tag(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->get(route('tags.show', $tag));

        $response
            ->assertOk()
            ->assertViewIs('app.tags.show')
            ->assertViewHas('tag');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_tag(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->get(route('tags.edit', $tag));

        $response
            ->assertOk()
            ->assertViewIs('app.tags.edit')
            ->assertViewHas('tag');
    }

    /**
     * @test
     */
    public function it_updates_the_tag(): void
    {
        $tag = Tag::factory()->create();

        $tag = Tag::factory()->create();
        $language = Language::factory()->create();

        $data = [
            'uid' => $this->faker->randomNumber(),
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->text(),
            'data' => [],
            'weight' => 0,
            'model' => $this->faker->text(255),
            'created_by_user_id' => $this->faker->text(255),
            'created_by_user_name' => $this->faker->text(255),
            'edited_by_user_id' => $this->faker->text(255),
            'edited_by_user_name' => $this->faker->text(255),
            'published_at' => $this->faker->dateTime(),
            'translation_id' => $tag->id,
            'language_id' => $language->id,
        ];

        $data['data'] = json_encode($data['data']);

        $response = $this->put(route('tags.update', $tag), $data);

        $data['id'] = $tag->id;

        $data['data'] = $this->castToJson($data['data']);

        $this->assertDatabaseHas('tags', $data);

        $response->assertRedirect(route('tags.edit', $tag));
    }

    /**
     * @test
     */
    public function it_deletes_the_tag(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->delete(route('tags.destroy', $tag));

        $response->assertRedirect(route('tags.index'));

        $this->assertSoftDeleted($tag);
    }
}
