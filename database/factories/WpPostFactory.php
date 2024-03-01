<?php

namespace Database\Factories;

use App\Models\WpPost;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WpPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WpPost::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_author' => $this->faker->randomNumber(),
            'post_date' => $this->faker->dateTime(),
            'post_date_gmt' => $this->faker->dateTime(),
            'post_content' => $this->faker->text(),
            'post_title' => $this->faker->text(),
            'post_excerpt' => $this->faker->text(),
            'post_status' => $this->faker->text(20),
            'comment_status' => $this->faker->text(20),
            'ping_status' => $this->faker->text(20),
            'post_password' => $this->faker->text(255),
            'post_name' => $this->faker->text(200),
            'to_ping' => $this->faker->text(),
            'pinged' => $this->faker->text(),
            'post_modified' => $this->faker->dateTime(),
            'post_modified_gmt' => $this->faker->dateTime(),
            'post_content_filtered' => $this->faker->text(),
            'post_parent' => $this->faker->randomNumber(),
            'guid' => $this->faker->text(255),
            'menu_order' => $this->faker->randomNumber(0),
            'post_type' => $this->faker->text(20),
            'post_mime_type' => $this->faker->text(100),
            'comment_count' => $this->faker->randomNumber(),
        ];
    }
}
