<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ContentElement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentElementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContentElement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'data_structure' => [],
            'template' => $this->faker->text(),
            'component' => $this->faker->text(255),
            'theme_id' => \App\Models\Theme::factory(),
        ];
    }
}
