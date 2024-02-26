<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Timezone;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimezoneTest extends TestCase
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
    public function it_gets_timezones_list(): void
    {
        $timezones = Timezone::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.timezones.index'));

        $response->assertOk()->assertSee($timezones[0]->zone_name);
    }

    /**
     * @test
     */
    public function it_stores_the_timezone(): void
    {
        $data = Timezone::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.timezones.store'), $data);

        $this->assertDatabaseHas('timezones', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_timezone(): void
    {
        $timezone = Timezone::factory()->create();

        $data = [
            'zone_name' => $this->faker->text(255),
            'country_code' => $this->faker->countryCode(),
            'abbreviation' => $this->faker->text(6),
            'time_start' => $this->faker->randomNumber(0),
            'gmt_offset' => $this->faker->randomNumber(0),
            'dst' => $this->faker->boolean(),
        ];

        $response = $this->putJson(
            route('api.timezones.update', $timezone),
            $data
        );

        $data['id'] = $timezone->id;

        $this->assertDatabaseHas('timezones', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_timezone(): void
    {
        $timezone = Timezone::factory()->create();

        $response = $this->deleteJson(
            route('api.timezones.destroy', $timezone)
        );

        $this->assertModelMissing($timezone);

        $response->assertNoContent();
    }
}
