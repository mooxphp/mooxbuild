<?php

namespace Database\Factories;

use App\Models\ActivityLog;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivityLog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'log_name' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'event' => $this->faker->text(255),
            'properties' => [],
            'batch_uuid' => $this->faker->uuid(),
        ];
    }
}
