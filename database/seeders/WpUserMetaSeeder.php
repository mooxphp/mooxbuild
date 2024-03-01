<?php

namespace Database\Seeders;

use App\Models\WpUserMeta;
use Illuminate\Database\Seeder;

class WpUserMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpUserMeta::factory()
            ->count(5)
            ->create();
    }
}
