<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Revision;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RevisionTest extends TestCase
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
    public function it_gets_revisions_list(): void
    {
        $revisions = Revision::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.revisions.index'));

        $response->assertOk()->assertSee($revisions[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_revision(): void
    {
        $data = Revision::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.revisions.store'), $data);

        $this->assertDatabaseHas('revisions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.revisions.update', $revision),
            $data
        );

        $data['id'] = $revision->id;

        $this->assertDatabaseHas('revisions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_revision(): void
    {
        $revision = Revision::factory()->create();

        $response = $this->deleteJson(
            route('api.revisions.destroy', $revision)
        );

        $this->assertSoftDeleted($revision);

        $response->assertNoContent();
    }
}
