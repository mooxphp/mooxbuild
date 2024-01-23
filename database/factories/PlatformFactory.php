<?php

namespace Database\Factories;

use App\Models\Platform;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlatformFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Platform::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'master' => $this->faker->boolean(),
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'bind_to_domain' => $this->faker->text(255),
        ];
    }
}
