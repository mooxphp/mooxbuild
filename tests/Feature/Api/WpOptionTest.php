<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpOption;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpOptionTest extends TestCase
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
    public function it_gets_wp_options_list(): void
    {
        $wpOptions = WpOption::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-options.index'));

        $response->assertOk()->assertSee($wpOptions[0]->option_name);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_option(): void
    {
        $data = WpOption::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wp-options.store'), $data);

        $this->assertDatabaseHas('wp_options', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_wp_option(): void
    {
        $wpOption = WpOption::factory()->create();

        $data = [
            'option_name' => $this->faker->text(191),
            'option_value' => $this->faker->text(),
            'autoload' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.wp-options.update', $wpOption),
            $data
        );

        $data['option_id'] = $wpOption->option_id;

        $this->assertDatabaseHas('wp_options', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_option(): void
    {
        $wpOption = WpOption::factory()->create();

        $response = $this->deleteJson(
            route('api.wp-options.destroy', $wpOption)
        );

        $this->assertModelMissing($wpOption);

        $response->assertNoContent();
    }
}
