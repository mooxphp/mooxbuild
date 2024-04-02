<?php

namespace Tests\Feature\Api;

use App\Models\User;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
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
    public function it_gets_users_list(): void
    {
        $users = User::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.users.index'));

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user(): void
    {
        $data = User::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(route('api.users.store'), $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['two_factor_confirmed_at']);
        unset($data['current_team_id']);
        unset($data['avatar_url']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_user(): void
    {
        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'gender' => \Arr::random(['male', 'female', 'other']),
            'title' => $this->faker->sentence(10),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique->email(),
            'website' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'profile_photo_path' => $this->faker->text(255),
            'wp_id' => $this->faker->randomNumber(),
        ];

        $data['password'] = \Str::random('8');

        $response = $this->putJson(route('api.users.update', $user), $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['two_factor_confirmed_at']);
        unset($data['current_team_id']);
        unset($data['avatar_url']);

        $data['id'] = $user->id;

        $this->assertDatabaseHas('users', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_user(): void
    {
        $user = User::factory()->create();

        $response = $this->deleteJson(route('api.users.destroy', $user));

        $this->assertSoftDeleted($user);

        $response->assertNoContent();
    }
}
