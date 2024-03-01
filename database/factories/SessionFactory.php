<?php

namespace Database\Factories;

use App\Models\Session;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Session::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'payload' => $this->faker->text(),
            'last_activity' => $this->faker->randomNumber(0),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
