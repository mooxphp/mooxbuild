<?php

namespace Database\Factories;

use App\Models\Revision;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RevisionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Revision::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'revname' => $this->faker->text(255),
            'revcomment' => $this->faker->text(),
            'revretention' => $this->faker->dateTime(),
            'uid' => $this->faker->randomNumber(),
            'main_category_id' => $this->faker->randomNumber(),
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'short' => $this->faker->text(),
            'content' => $this->faker->text(),
            'data' => [],
            'author_id' => $this->faker->randomNumber(),
            'language_id' => $this->faker->randomNumber(),
            'translation_id' => $this->faker->randomNumber(),
            'categories' => [],
            'tags' => [],
        ];
    }
}
