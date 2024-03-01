<?php

namespace Database\Factories;

use App\Models\WpComment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WpCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WpComment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment_post_ID' => $this->faker->randomNumber(),
            'comment_author' => $this->faker->text(),
            'comment_author_email' => $this->faker->text(255),
            'comment_author_url' => $this->faker->text(255),
            'comment_author_IP' => $this->faker->text(255),
            'comment_date' => $this->faker->dateTime(),
            'comment_date_gmt' => $this->faker->dateTime(),
            'comment_content' => $this->faker->text(),
            'comment_karma' => $this->faker->randomNumber(0),
            'comment_approved' => $this->faker->text(255),
            'comment_agent' => $this->faker->text(255),
            'comment_type' => $this->faker->text(255),
            'comment_parent' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
        ];
    }
}
