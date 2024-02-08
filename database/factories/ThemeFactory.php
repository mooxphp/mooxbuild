<?php

namespace Database\Factories;

use App\Models\Theme;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThemeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Theme::class;

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
            'theme_package' => $this->faker->text(255),
            'themeable_type' => $this->faker->randomElement([
                \App\Models\PageTemplate::class,
            ]),
            'themeable_id' => function (array $item) {
                return app($item['themeable_type'])->factory();
            },
        ];
    }
}
