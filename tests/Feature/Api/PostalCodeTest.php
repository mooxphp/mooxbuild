<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PostalCode;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostalCodeTest extends TestCase
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
    public function it_gets_postal_codes_list(): void
    {
        $postalCodes = PostalCode::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.postal-codes.index'));

        $response->assertOk()->assertSee($postalCodes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_postal_code(): void
    {
        $data = PostalCode::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.postal-codes.store'), $data);

        $this->assertDatabaseHas('postal_codes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_postal_code(): void
    {
        $postalCode = PostalCode::factory()->create();

        $data = [];

        $response = $this->putJson(
            route('api.postal-codes.update', $postalCode),
            $data
        );

        $data['id'] = $postalCode->id;

        $this->assertDatabaseHas('postal_codes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_postal_code(): void
    {
        $postalCode = PostalCode::factory()->create();

        $response = $this->deleteJson(
            route('api.postal-codes.destroy', $postalCode)
        );

        $this->assertModelMissing($postalCode);

        $response->assertNoContent();
    }
}
