<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\WpTermTaxonomy;
use Illuminate\Database\Eloquent\Factories\Factory;

class WpTermTaxonomyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WpTermTaxonomy::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'term_id' => $this->faker->randomNumber(),
            'taxonomy' => $this->faker->text(32),
            'description' => $this->faker->text(),
            'parent' => $this->faker->randomNumber(),
            'count' => $this->faker->randomNumber(),
        ];
    }
}
