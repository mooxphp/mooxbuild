<?php

namespace Database\Factories;

use App\Models\Timezone;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimezoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Timezone::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }
}
