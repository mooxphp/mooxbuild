<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\FirewallRule;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FirewallRuleTest extends TestCase
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
    public function it_gets_firewall_rules_list(): void
    {
        $firewallRules = FirewallRule::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.firewall-rules.index'));

        $response->assertOk()->assertSee($firewallRules[0]->rule);
    }

    /**
     * @test
     */
    public function it_stores_the_firewall_rule(): void
    {
        $data = FirewallRule::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.firewall-rules.store'), $data);

        $this->assertDatabaseHas('firewall_rules', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_firewall_rule(): void
    {
        $firewallRule = FirewallRule::factory()->create();

        $data = [
            'rule' => $this->faker->sentence(10),
            'type' => 'allow',
            'all_rule' => $this->faker->boolean(),
            'ip_address' => $this->faker->ipv4(),
        ];

        $response = $this->putJson(
            route('api.firewall-rules.update', $firewallRule),
            $data
        );

        $data['id'] = $firewallRule->id;

        $this->assertDatabaseHas('firewall_rules', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_firewall_rule(): void
    {
        $firewallRule = FirewallRule::factory()->create();

        $response = $this->deleteJson(
            route('api.firewall-rules.destroy', $firewallRule)
        );

        $this->assertModelMissing($firewallRule);

        $response->assertNoContent();
    }
}
