<?php

namespace Database\Seeders;

use App\Models\WpComment;
use Illuminate\Database\Seeder;

class WpCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpComment::factory()
            ->count(5)
            ->create();
    }
}
