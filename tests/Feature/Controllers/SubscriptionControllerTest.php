<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Subscription;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_subscriptions(): void
    {
        $subscriptions = Subscription::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('subscriptions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.subscriptions.index')
            ->assertViewHas('subscriptions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_subscription(): void
    {
        $response = $this->get(route('subscriptions.create'));

        $response->assertOk()->assertViewIs('app.subscriptions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_subscription(): void
    {
        $data = Subscription::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('subscriptions.store'), $data);

        $this->assertDatabaseHas('subscriptions', $data);

        $subscription = Subscription::latest('id')->first();

        $response->assertRedirect(route('subscriptions.edit', $subscription));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_subscription(): void
    {
        $subscription = Subscription::factory()->create();

        $response = $this->get(route('subscriptions.show', $subscription));

        $response
            ->assertOk()
            ->assertViewIs('app.subscriptions.show')
            ->assertViewHas('subscription');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_subscription(): void
    {
        $subscription = Subscription::factory()->create();

        $response = $this->get(route('subscriptions.edit', $subscription));

        $response
            ->assertOk()
            ->assertViewIs('app.subscriptions.edit')
            ->assertViewHas('subscription');
    }

    /**
     * @test
     */
    public function it_updates_the_subscription(): void
    {
        $subscription = Subscription::factory()->create();

        $user = User::factory()->create();

        $data = [
            'user_id' => $user->id,
        ];

        $response = $this->put(
            route('subscriptions.update', $subscription),
            $data
        );

        $data['id'] = $subscription->id;

        $this->assertDatabaseHas('subscriptions', $data);

        $response->assertRedirect(route('subscriptions.edit', $subscription));
    }

    /**
     * @test
     */
    public function it_deletes_the_subscription(): void
    {
        $subscription = Subscription::factory()->create();

        $response = $this->delete(
            route('subscriptions.destroy', $subscription)
        );

        $response->assertRedirect(route('subscriptions.index'));

        $this->assertModelMissing($subscription);
    }
}
