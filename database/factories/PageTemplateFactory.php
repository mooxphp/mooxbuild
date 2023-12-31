<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PageTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PageTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'page_id' => \App\Models\Page::factory(),
        ];
    }
}
