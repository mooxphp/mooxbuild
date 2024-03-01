<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WpTermRelationship;

class WpTermRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpTermRelationship::factory()
            ->count(5)
            ->create();
    }
}
