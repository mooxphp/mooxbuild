<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

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
            'main_category_id' => \App\Models\Category::factory(),
            'translation_id' => function () {
                return \App\Models\Page::factory()->create([
                    'translation_id' => null,
                ])->id;
            },
        ];
    }
}
