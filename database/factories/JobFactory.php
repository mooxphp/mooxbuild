<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'queue' => $this->faker->text(255),
            'payload' => $this->faker->text(),
            'attempts' => $this->faker->numberBetween(0, 127),
            'reserved_at' => $this->faker->randomNumber(),
            'available_at' => $this->faker->randomNumber(),
            'created_at' => $this->faker->randomNumber(),
        ];
    }
}
