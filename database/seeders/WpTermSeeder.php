<?php

namespace Database\Seeders;

use App\Models\WpTerm;
use Illuminate\Database\Seeder;

class WpTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpTerm::factory()
            ->count(5)
            ->create();
    }
}
