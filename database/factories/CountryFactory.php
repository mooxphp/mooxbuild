<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

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
            'delivery' => $this->faker->boolean(),
            'official' => $this->faker->text(255),
            'native_name' => [],
            'tld' => $this->faker->text(255),
            'independent' => $this->faker->boolean(),
            'un_member' => $this->faker->boolean(),
            'status' => 'officially-assigned',
            'cca2' => $this->faker->text(255),
            'ccn3' => $this->faker->text(255),
            'cca3' => $this->faker->text(255),
            'cioc' => $this->faker->text(255),
            'continent_id' => \App\Models\Continent::factory(),
        ];
    }
}
