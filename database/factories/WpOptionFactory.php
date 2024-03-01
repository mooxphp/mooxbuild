<?php

namespace Database\Factories;

use App\Models\WpOption;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WpOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WpOption::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'option_name' => $this->faker->text(191),
            'option_value' => $this->faker->text(),
            'autoload' => $this->faker->text(255),
        ];
    }
}
