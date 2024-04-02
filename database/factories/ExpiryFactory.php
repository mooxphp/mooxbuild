<?php

namespace Database\Factories;

use App\Models\Expiry;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpiryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expiry::class;

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
            'item' => $this->faker->text(255),
            'link' => $this->faker->text(255),
            'expired_at' => $this->faker->dateTime(),
            'notified_at' => $this->faker->dateTime(),
            'notified_to' => $this->faker->text(255),
            'escalated_at' => $this->faker->dateTime(),
            'escalated_to' => $this->faker->text(255),
            'handled_by' => $this->faker->text(255),
            'done_at' => $this->faker->dateTime(),
            'expiry_monitor_id' => \App\Models\ExpiryMonitor::factory(),
        ];
    }
}
