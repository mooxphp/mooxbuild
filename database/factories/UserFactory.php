<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'gender' => \Arr::random(['male', 'female', 'other']),
            'title' => $this->faker->sentence(10),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique->email(),
            'website' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'email_verified_at' => now(),
            'password' => \Hash::make('password'),
            'remember_token' => Str::random(10),
            'avatar_url' => $this->faker->text(2048),
            'profile_photo_path' => $this->faker->text(255),
            'wp_id' => $this->faker->randomNumber(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
