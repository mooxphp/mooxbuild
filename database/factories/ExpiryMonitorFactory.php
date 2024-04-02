<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ExpiryMonitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpiryMonitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExpiryMonitor::class;

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
            'description' => $this->faker->sentence(15),
            'runs' => 'weekly',
            'monitors' => $this->faker->text(255),
            'executes' => $this->faker->text(255),
            'notifies' => $this->faker->text(255),
            'escalates' => $this->faker->text(255),
        ];
    }
}
