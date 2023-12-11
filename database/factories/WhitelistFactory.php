<?php

namespace Database\Factories;

use App\Models\Whitelist;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WhitelistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Whitelist::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->text(),
            'ip-address' => $this->faker->text(255),
            'lookup' => $this->faker->text(255),
            'expires' => $this->faker->dateTime(),
        ];
    }
}
