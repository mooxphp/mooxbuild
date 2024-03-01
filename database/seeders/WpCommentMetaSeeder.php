<?php

namespace Database\Seeders;

use App\Models\WpCommentMeta;
use Illuminate\Database\Seeder;

class WpCommentMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpCommentMeta::factory()
            ->count(5)
            ->create();
    }
}
