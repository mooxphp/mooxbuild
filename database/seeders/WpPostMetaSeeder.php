<?php

namespace Database\Seeders;

use App\Models\WpPostMeta;
use Illuminate\Database\Seeder;

class WpPostMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpPostMeta::factory()
            ->count(5)
            ->create();
    }
}
