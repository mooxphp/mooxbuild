<?php

namespace Database\Factories;

use App\Models\Translation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Translation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'language_id' => \App\Models\Language::factory(),
            'fallback_language_id' => \App\Models\Language::factory(),
        ];
    }
}
