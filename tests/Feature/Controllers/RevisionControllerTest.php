<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Revision;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RevisionControllerTest extends TestCase
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
    public function it_displays_index_view_with_revisions(): void
    {
        $revisions = Revision::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('revisions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.revisions.index')
            ->assertViewHas('revisions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_revision(): void
    {
        $response = $this->get(route('revisions.create'));

        $response->assertOk()->assertViewIs('app.revisions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_revision(): void
    {
        $data = Revision::factory()
            ->make()
            ->toArray();

        $data['data'] = json_encode($data['data']);
        $data['categories'] = json_encode($data['categories']);
        $data['tags'] = json_encode($data['tags']);
        $data['fields'] = json_encode($data['fields']);

        $response = $this->post(route('revisions.store'), $data);

        $data['data'] = $this->castToJson($data['data']);
        $data['categories'] = $this->castToJson($data['categories']);
        $data['tags'] = $this->castToJson($data['tags']);
        $data['fields'] = $this->castToJson($data['fields']);

        $this->assertDatabaseHas('revisions', $data);

        $revision = Revision::latest('id')->first();

        $response->assertRedirect(route('revisions.edit', $revision));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_revision(): void
    {
        $revision = Revision::factory()->create();

        $response = $this->get(route('revisions.show', $revision));

        $response
            ->assertOk()
            ->assertViewIs('app.revisions.show')
            ->assertViewHas('revision');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_revision(): void
    {
        $revision = Revision::factory()->create();

        $response = $this->get(route('revisions.edit', $revision));

        $response
            ->assertOk()
            ->assertViewIs('app.revisions.edit')
            ->assertViewHas('revision');
    }

    /**
     * @test
     */
    public function it_updates_the_revision(): void
    {
        $revision = Revision::factory()->create();

        $data = [
            'revname' => $this->faker->text(255),
            'revcomment' => $this->faker->text(),
            'revretention' => $this->faker->dateTime(),
            'uid' => $this->faker->randomNumber(),
            'main_category_id' => $this->faker->randomNumber(),
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'short' => $this->faker->text(),
            'content' => $this->faker->text(),
            'data' => [],
            'author_id' => $this->faker->randomNumber(),
            'language_id' => $this->faker->randomNumber(),
            'translation_id' => $this->faker->randomNumber(),
            'categories' => [],
            'tags' => [],
            'fields' => [],
        ];

        $data['data'] = json_encode($data['data']);
        $data['categories'] = json_encode($data['categories']);
        $data['tags'] = json_encode($data['tags']);
        $data['fields'] = json_encode($data['fields']);

        $response = $this->put(route('revisions.update', $revision), $data);

        $data['id'] = $revision->id;

        $data['data'] = $this->castToJson($data['data']);
        $data['categories'] = $this->castToJson($data['categories']);
        $data['tags'] = $this->castToJson($data['tags']);
        $data['fields'] = $this->castToJson($data['fields']);

        $this->assertDatabaseHas('revisions', $data);

        $response->assertRedirect(route('revisions.edit', $revision));
    }

    /**
     * @test
     */
    public function it_deletes_the_revision(): void
    {
        $revision = Revision::factory()->create();

        $response = $this->delete(route('revisions.destroy', $revision));

        $response->assertRedirect(route('revisions.index'));

        $this->assertSoftDeleted($revision);
    }
}
