<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\FirewallRule;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FirewallRuleControllerTest extends TestCase
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
    public function it_displays_index_view_with_firewall_rules(): void
    {
        $firewallRules = FirewallRule::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('firewall-rules.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.firewall_rules.index')
            ->assertViewHas('firewallRules');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_firewall_rule(): void
    {
        $response = $this->get(route('firewall-rules.create'));

        $response->assertOk()->assertViewIs('app.firewall_rules.create');
    }

    /**
     * @test
     */
    public function it_stores_the_firewall_rule(): void
    {
        $data = FirewallRule::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('firewall-rules.store'), $data);

        $this->assertDatabaseHas('firewall_rules', $data);

        $firewallRule = FirewallRule::latest('id')->first();

        $response->assertRedirect(route('firewall-rules.edit', $firewallRule));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_firewall_rule(): void
    {
        $firewallRule = FirewallRule::factory()->create();

        $response = $this->get(route('firewall-rules.show', $firewallRule));

        $response
            ->assertOk()
            ->assertViewIs('app.firewall_rules.show')
            ->assertViewHas('firewallRule');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_firewall_rule(): void
    {
        $firewallRule = FirewallRule::factory()->create();

        $response = $this->get(route('firewall-rules.edit', $firewallRule));

        $response
            ->assertOk()
            ->assertViewIs('app.firewall_rules.edit')
            ->assertViewHas('firewallRule');
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

        $response = $this->put(
            route('firewall-rules.update', $firewallRule),
            $data
        );

        $data['id'] = $firewallRule->id;

        $this->assertDatabaseHas('firewall_rules', $data);

        $response->assertRedirect(route('firewall-rules.edit', $firewallRule));
    }

    /**
     * @test
     */
    public function it_deletes_the_firewall_rule(): void
    {
        $firewallRule = FirewallRule::factory()->create();

        $response = $this->delete(
            route('firewall-rules.destroy', $firewallRule)
        );

        $response->assertRedirect(route('firewall-rules.index'));

        $this->assertModelMissing($firewallRule);
    }
}
