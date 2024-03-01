<?php

namespace Database\Factories;

use App\Models\WpUserMeta;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WpUserMetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WpUserMeta::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'meta_key' => $this->faker->text(255),
            'meta_value' => $this->faker->text(),
        ];
    }
}
