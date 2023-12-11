<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uid' => $this->faker->randomNumber(),
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'short' => $this->faker->text(),
            'content' => $this->faker->text(),
            'data' => [],
            'author_id' => \App\Models\Author::factory(),
            'language_id' => \App\Models\Language::factory(),
            'translation_id' => function () {
                return \App\Models\Item::factory()->create([
                    'translation_id' => null,
                ])->id;
            },
            'main_category_id' => \App\Models\Category::factory(),
        ];
    }
}
