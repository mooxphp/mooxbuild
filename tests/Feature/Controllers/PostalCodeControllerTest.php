<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PostalCode;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostalCodeControllerTest extends TestCase
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
    public function it_displays_index_view_with_postal_codes(): void
    {
        $postalCodes = PostalCode::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('postal-codes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.postal_codes.index')
            ->assertViewHas('postalCodes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_postal_code(): void
    {
        $response = $this->get(route('postal-codes.create'));

        $response->assertOk()->assertViewIs('app.postal_codes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_postal_code(): void
    {
        $data = PostalCode::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('postal-codes.store'), $data);

        $this->assertDatabaseHas('postal_codes', $data);

        $postalCode = PostalCode::latest('id')->first();

        $response->assertRedirect(route('postal-codes.edit', $postalCode));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_postal_code(): void
    {
        $postalCode = PostalCode::factory()->create();

        $response = $this->get(route('postal-codes.show', $postalCode));

        $response
            ->assertOk()
            ->assertViewIs('app.postal_codes.show')
            ->assertViewHas('postalCode');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_postal_code(): void
    {
        $postalCode = PostalCode::factory()->create();

        $response = $this->get(route('postal-codes.edit', $postalCode));

        $response
            ->assertOk()
            ->assertViewIs('app.postal_codes.edit')
            ->assertViewHas('postalCode');
    }

    /**
     * @test
     */
    public function it_updates_the_postal_code(): void
    {
        $postalCode = PostalCode::factory()->create();

        $data = [];

        $response = $this->put(
            route('postal-codes.update', $postalCode),
            $data
        );

        $data['id'] = $postalCode->id;

        $this->assertDatabaseHas('postal_codes', $data);

        $response->assertRedirect(route('postal-codes.edit', $postalCode));
    }

    /**
     * @test
     */
    public function it_deletes_the_postal_code(): void
    {
        $postalCode = PostalCode::factory()->create();

        $response = $this->delete(route('postal-codes.destroy', $postalCode));

        $response->assertRedirect(route('postal-codes.index'));

        $this->assertModelMissing($postalCode);
    }
}
