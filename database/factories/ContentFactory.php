<?php

namespace Database\Factories;

use App\Models\Content;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

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
            'data' => [],
            'settings' => [],
            'content_element_id' => \App\Models\ContentElement::factory(),
        ];
    }
}
