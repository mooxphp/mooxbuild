<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uid' => $this->faker->randomNumber(),
            'sku' => $this->faker->text(255),
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'short' => $this->faker->text(),
            'content' => $this->faker->text(),
            'data' => [],
            'created_by_user_id' => $this->faker->text(255),
            'created_by_user_name' => $this->faker->text(255),
            'edited_by_user_id' => $this->faker->text(255),
            'edited_by_user_name' => $this->faker->text(255),
            'published_at' => $this->faker->dateTime(),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'stock' => $this->faker->numberBetween(0, 127),
            'main_category_id' => \App\Models\Category::factory(),
            'author_id' => \App\Models\Author::factory(),
            'language_id' => \App\Models\Language::factory(),
            'translation_id' => function () {
                return \App\Models\Product::factory()->create([
                    'translation_id' => null,
                ])->id;
            },
        ];
    }
}
