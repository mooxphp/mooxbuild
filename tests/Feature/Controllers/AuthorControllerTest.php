<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Author;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorControllerTest extends TestCase
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
    public function it_displays_index_view_with_authors(): void
    {
        $authors = Author::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('authors.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.authors.index')
            ->assertViewHas('authors');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_author(): void
    {
        $response = $this->get(route('authors.create'));

        $response->assertOk()->assertViewIs('app.authors.create');
    }

    /**
     * @test
     */
    public function it_stores_the_author(): void
    {
        $data = Author::factory()
            ->make()
            ->toArray();

        $data['social'] = json_encode($data['social']);

        $response = $this->post(route('authors.store'), $data);

        $data['social'] = $this->castToJson($data['social']);

        $this->assertDatabaseHas('authors', $data);

        $author = Author::latest('id')->first();

        $response->assertRedirect(route('authors.edit', $author));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_author(): void
    {
        $author = Author::factory()->create();

        $response = $this->get(route('authors.show', $author));

        $response
            ->assertOk()
            ->assertViewIs('app.authors.show')
            ->assertViewHas('author');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_author(): void
    {
        $author = Author::factory()->create();

        $response = $this->get(route('authors.edit', $author));

        $response
            ->assertOk()
            ->assertViewIs('app.authors.edit')
            ->assertViewHas('author');
    }

    /**
     * @test
     */
    public function it_updates_the_author(): void
    {
        $author = Author::factory()->create();

        $user = User::factory()->create();

        $data = [
            'salutation' => $this->faker->text(255),
            'title' => $this->faker->sentence(10),
            'name' => $this->faker->name(),
            'full_name' => $this->faker->text(255),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'mail_address' => $this->faker->text(255),
            'website' => $this->faker->text(255),
            'address' => $this->faker->text(),
            'social' => [],
            'user_id' => $user->id,
        ];

        $data['social'] = json_encode($data['social']);

        $response = $this->put(route('authors.update', $author), $data);

        $data['id'] = $author->id;

        $data['social'] = $this->castToJson($data['social']);

        $this->assertDatabaseHas('authors', $data);

        $response->assertRedirect(route('authors.edit', $author));
    }

    /**
     * @test
     */
    public function it_deletes_the_author(): void
    {
        $author = Author::factory()->create();

        $response = $this->delete(route('authors.destroy', $author));

        $response->assertRedirect(route('authors.index'));

        $this->assertSoftDeleted($author);
    }
}
