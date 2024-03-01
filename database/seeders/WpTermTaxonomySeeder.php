<?php

namespace Database\Seeders;

use App\Models\WpTermTaxonomy;
use Illuminate\Database\Seeder;

class WpTermTaxonomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpTermTaxonomy::factory()
            ->count(5)
            ->create();
    }
}
