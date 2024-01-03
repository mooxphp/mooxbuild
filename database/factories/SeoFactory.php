<?php

namespace Database\Factories;

use App\Models\Seo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meta_title' => $this->faker->text(255),
            'meta_description' => $this->faker->text(255),
            'meta_keywords' => $this->faker->text(255),
            'og_title' => $this->faker->text(255),
            'og_description' => $this->faker->text(255),
            'og_image' => $this->faker->text(255),
            'twitter_card' => $this->faker->text(255),
            'twitter_site' => $this->faker->text(255),
            'twitter_creator' => $this->faker->text(255),
            'schema_markup' => [],
            'breadcrumb_title' => $this->faker->text(255),
            'canonical_url' => $this->faker->text(255),
            'redirect_url' => $this->faker->text(255),
            'focus_keyphrases' => [],
            'focus_keyphrase' => $this->faker->text(255),
            'seo_scores' => [],
            'seo_score' => $this->faker->randomNumber(1),
            'readability_score' => $this->faker->randomNumber(1),
            'fav_icon' => $this->faker->text(255),
            'app_icon' => $this->faker->text(255),
            'app_color' => $this->faker->text(255),
            'web_manifest' => [],
            'noindex' => $this->faker->boolean(),
            'nofollow' => $this->faker->boolean(),
            'seoable_type' => $this->faker->randomElement([
                \App\Models\Category::class,
                \App\Models\Item::class,
                \App\Models\Author::class,
                \App\Models\Tag::class,
                \App\Models\Page::class,
                \App\Models\Post::class,
                \App\Models\Product::class,
            ]),
            'seoable_id' => function (array $item) {
                return app($item['seoable_type'])->factory();
            },
        ];
    }
}
