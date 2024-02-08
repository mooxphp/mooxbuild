<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\JobBatchManager;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobBatchManagerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobBatchManager::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'batch_id' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'total_jobs' => $this->faker->randomNumber(0),
            'pending_jobs' => $this->faker->randomNumber(0),
            'failed_jobs' => $this->faker->randomNumber(0),
            'failed_job_ids' => $this->faker->text(),
            'options' => $this->faker->text(),
            'cancelled_at' => $this->faker->dateTime(),
            'finished_at' => $this->faker->dateTime(),
            'status' => $this->faker->word(),
        ];
    }
}
