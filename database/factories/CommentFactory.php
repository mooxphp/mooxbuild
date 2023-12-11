<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

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
            'content' => $this->faker->text(),
            'translations' => [],
            'is_from_author' => $this->faker->boolean(),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'parent_id' => function () {
                return \App\Models\Comment::factory()->create([
                    'parent_id' => null,
                ])->id;
            },
            'author_id' => \App\Models\Author::factory(),
        ];
    }
}
