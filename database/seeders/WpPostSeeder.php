<?php

namespace Database\Seeders;

use App\Models\WpPost;
use Illuminate\Database\Seeder;

class WpPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpPost::factory()
            ->count(5)
            ->create();
    }
}
