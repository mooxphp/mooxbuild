<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemItemsTest extends TestCase
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
    public function it_gets_item_items(): void
    {
        $item = Item::factory()->create();
        $items = Item::factory()
            ->count(2)
            ->create([
                'translation_id' => $item->id,
            ]);

        $response = $this->getJson(route('api.items.items.index', $item));

        $response->assertOk()->assertSee($items[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_item_items(): void
    {
        $item = Item::factory()->create();
        $data = Item::factory()
            ->make([
                'translation_id' => $item->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.items.items.store', $item),
            $data
        );

        $this->assertDatabaseHas('items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $item = Item::latest('id')->first();

        $this->assertEquals($item->id, $item->translation_id);
    }
}
