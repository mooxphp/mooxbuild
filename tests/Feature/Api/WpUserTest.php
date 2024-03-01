<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpUser;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpUserTest extends TestCase
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
    public function it_gets_wp_users_list(): void
    {
        $wpUsers = WpUser::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-users.index'));

        $response->assertOk()->assertSee($wpUsers[0]->user_login);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_user(): void
    {
        $data = WpUser::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wp-users.store'), $data);

        $this->assertDatabaseHas('wp_users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_wp_user(): void
    {
        $wpUser = WpUser::factory()->create();

        $data = [
            'user_login' => $this->faker->text(60),
            'user_pass' => $this->faker->text(255),
            'user_nicename' => $this->faker->text(50),
            'user_email' => $this->faker->text(100),
            'user_url' => $this->faker->text(100),
            'user_registered' => $this->faker->dateTime(),
            'user_activation_key' => $this->faker->text(255),
            'user_status' => $this->faker->randomNumber(0),
            'display_name' => $this->faker->text(255),
            'spam' => $this->faker->boolean(),
            'deleted' => $this->faker->boolean(),
        ];

        $response = $this->putJson(
            route('api.wp-users.update', $wpUser),
            $data
        );

        $data['id'] = $wpUser->id;

        $this->assertDatabaseHas('wp_users', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_user(): void
    {
        $wpUser = WpUser::factory()->create();

        $response = $this->deleteJson(route('api.wp-users.destroy', $wpUser));

        $this->assertModelMissing($wpUser);

        $response->assertNoContent();
    }
}
