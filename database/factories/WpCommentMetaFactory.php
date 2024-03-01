<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\WpCommentMeta;
use Illuminate\Database\Eloquent\Factories\Factory;

class WpCommentMetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WpCommentMeta::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment_id' => $this->faker->randomNumber(),
            'meta_key' => $this->faker->text(255),
            'meta_value' => $this->faker->text(),
        ];
    }
}
