<?php

namespace Database\Seeders;

use App\Models\WpTermMeta;
use Illuminate\Database\Seeder;

class WpTermMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpTermMeta::factory()
            ->count(5)
            ->create();
    }
}
