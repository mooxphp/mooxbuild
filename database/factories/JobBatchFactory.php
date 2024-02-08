<?php

namespace Database\Factories;

use App\Models\JobBatch;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobBatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobBatch::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'total_jobs' => $this->faker->randomNumber(0),
            'pending_jobs' => $this->faker->randomNumber(0),
            'failed_jobs' => $this->faker->randomNumber(0),
            'failed_job_ids' => $this->faker->text(),
            'options' => $this->faker->text(),
            'cancelled_at' => $this->faker->randomNumber(0),
            'created_at' => $this->faker->randomNumber(0),
            'finished_at' => $this->faker->randomNumber(0),
        ];
    }
}
