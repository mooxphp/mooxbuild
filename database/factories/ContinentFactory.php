<?php

namespace Database\Factories;

use App\Models\Continent;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContinentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Continent::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'parent_continent_id' => function () {
                return \App\Models\Continent::factory()->create([
                    'parent_continent_id' => null,
                ])->id;
            },
        ];
    }
}
