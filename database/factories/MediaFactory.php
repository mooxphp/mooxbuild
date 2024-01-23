<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->unique->uuid(),
            'collection_name' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'file_name' => $this->faker->text(255),
            'mime_type' => $this->faker->text(255),
            'disk' => 'public',
            'conversions_disk' => $this->faker->text(255),
            'size' => $this->faker->randomNumber(),
            'manipulations' => [],
            'custom_properties' => [],
            'generated_conversions' => [],
            'responsive_images' => [],
            'order_column' => $this->faker->randomNumber(),
        ];
    }
}
