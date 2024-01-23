<?php

namespace Database\Seeders;

use App\Models\FirewallRule;
use Illuminate\Database\Seeder;

class FirewallRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FirewallRule::factory()
            ->count(5)
            ->create();
    }
}
