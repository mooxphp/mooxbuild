<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\FirewallRule;
use Illuminate\Database\Eloquent\Factories\Factory;

class FirewallRuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FirewallRule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rule' => $this->faker->sentence(10),
            'type' => 'allow',
            'all_rule' => $this->faker->boolean(),
            'ip_address' => $this->faker->ipv4(),
        ];
    }
}
