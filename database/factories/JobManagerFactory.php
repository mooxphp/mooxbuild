<?php

namespace Database\Factories;

use App\Models\JobManager;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobManagerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobManager::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_id' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'queue' => $this->faker->text(255),
            'available_at' => $this->faker->dateTime(),
            'started_at' => $this->faker->dateTime(),
            'finished_at' => $this->faker->dateTime(),
            'failed' => $this->faker->boolean(),
            'attempt' => $this->faker->randomNumber(0),
            'progress' => $this->faker->randomNumber(0),
            'exception_message' => $this->faker->text(),
            'status' => $this->faker->word(),
            'job_queue_worker_id' => \App\Models\JobQueueWorker::factory(),
        ];
    }
}
