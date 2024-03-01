<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\WpTermRelationship;
use Illuminate\Database\Eloquent\Factories\Factory;

class WpTermRelationshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WpTermRelationship::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'term_taxonomy_id' => $this->faker->randomNumber(),
            'term_order' => $this->faker->randomNumber(0),
        ];
    }
}
