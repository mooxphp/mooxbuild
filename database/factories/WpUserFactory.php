<?php

namespace Database\Factories;

use App\Models\WpUser;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WpUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WpUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_login' => $this->faker->text(60),
            'user_pass' => $this->faker->text(255),
            'user_nicename' => $this->faker->text(50),
            'user_email' => $this->faker->text(100),
            'user_url' => $this->faker->text(100),
            'user_registered' => $this->faker->dateTime(),
            'user_activation_key' => $this->faker->text(255),
            'user_status' => $this->faker->randomNumber(0),
            'display_name' => $this->faker->text(255),
            'spam' => $this->faker->boolean(),
            'deleted' => $this->faker->boolean(),
        ];
    }
}
