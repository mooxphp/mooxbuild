<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Author;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAuthorsTest extends TestCase
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
    public function it_gets_user_authors(): void
    {
        $user = User::factory()->create();
        $authors = Author::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.authors.index', $user));

        $response->assertOk()->assertSee($authors[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_user_authors(): void
    {
        $user = User::factory()->create();
        $data = Author::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.authors.store', $user),
            $data
        );

        $this->assertDatabaseHas('authors', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $author = Author::latest('id')->first();

        $this->assertEquals($user->id, $author->user_id);
    }
}
