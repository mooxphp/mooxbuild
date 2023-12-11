<?php

namespace Database\Factories;

use App\Models\BypassToken;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BypassTokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BypassToken::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'token' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
