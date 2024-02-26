<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Timezone;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimezoneControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_timezones(): void
    {
        $timezones = Timezone::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('timezones.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.timezones.index')
            ->assertViewHas('timezones');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_timezone(): void
    {
        $response = $this->get(route('timezones.create'));

        $response->assertOk()->assertViewIs('app.timezones.create');
    }

    /**
     * @test
     */
    public function it_stores_the_timezone(): void
    {
        $data = Timezone::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('timezones.store'), $data);

        $this->assertDatabaseHas('timezones', $data);

        $timezone = Timezone::latest('id')->first();

        $response->assertRedirect(route('timezones.edit', $timezone));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_timezone(): void
    {
        $timezone = Timezone::factory()->create();

        $response = $this->get(route('timezones.show', $timezone));

        $response
            ->assertOk()
            ->assertViewIs('app.timezones.show')
            ->assertViewHas('timezone');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_timezone(): void
    {
        $timezone = Timezone::factory()->create();

        $response = $this->get(route('timezones.edit', $timezone));

        $response
            ->assertOk()
            ->assertViewIs('app.timezones.edit')
            ->assertViewHas('timezone');
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

        $response = $this->put(route('timezones.update', $timezone), $data);

        $data['id'] = $timezone->id;

        $this->assertDatabaseHas('timezones', $data);

        $response->assertRedirect(route('timezones.edit', $timezone));
    }

    /**
     * @test
     */
    public function it_deletes_the_timezone(): void
    {
        $timezone = Timezone::factory()->create();

        $response = $this->delete(route('timezones.destroy', $timezone));

        $response->assertRedirect(route('timezones.index'));

        $this->assertModelMissing($timezone);
    }
}
