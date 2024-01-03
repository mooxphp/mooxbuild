<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'salutation' => $this->faker->text(255),
            'title' => $this->faker->sentence(10),
            'name' => $this->faker->name(),
            'full_name' => $this->faker->text(255),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'mail_address' => $this->faker->text(255),
            'website' => $this->faker->text(255),
            'address' => $this->faker->text(),
            'social' => [],
            'published_at' => $this->faker->dateTime(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
