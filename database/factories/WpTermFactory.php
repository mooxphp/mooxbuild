<?php

namespace Database\Factories;

use App\Models\WpTerm;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WpTermFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WpTerm::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'term_group' => $this->faker->randomNumber(),
        ];
    }
}
