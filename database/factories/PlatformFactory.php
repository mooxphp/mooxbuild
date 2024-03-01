<?php

namespace Database\Factories;

use App\Models\Platform;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlatformFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Platform::class;

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
            'domain' => $this->faker->text(255),
            'selection' => $this->faker->boolean(),
            'order' => $this->faker->numberBetween(0, 127),
            'locked' => $this->faker->boolean(),
            'master' => $this->faker->boolean(),
            'platformable_type' => $this->faker->randomElement([
                \App\Models\User::class,
            ]),
            'platformable_id' => function (array $item) {
                return app($item['platformable_type'])->factory();
            },
        ];
    }
}
