<?php

namespace Database\Factories;

use App\Models\Sync;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SyncFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sync::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_sync' => $this->faker->dateTime(),
            'source_platform_id' => \App\Models\Platform::factory(),
            'target_platform_id' => \App\Models\Platform::factory(),
            'syncable_type' => $this->faker->randomElement([
                \App\Models\User::class,
            ]),
            'syncable_id' => function (array $item) {
                return app($item['syncable_type'])->factory();
            },
        ];
    }
}
