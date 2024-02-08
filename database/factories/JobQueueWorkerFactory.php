<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\JobQueueWorker;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobQueueWorkerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobQueueWorker::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'worker_pid' => $this->faker->text(255),
            'queue' => $this->faker->text(255),
            'connection' => $this->faker->text(255),
            'worker_server' => $this->faker->text(255),
            'supervisor' => $this->faker->text(255),
            'status' => $this->faker->word(),
            'started_at' => $this->faker->dateTime(),
            'stopped_at' => $this->faker->dateTime(),
        ];
    }
}
