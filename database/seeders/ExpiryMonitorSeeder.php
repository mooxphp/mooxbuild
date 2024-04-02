<?php

namespace Database\Seeders;

use App\Models\ExpiryMonitor;
use Illuminate\Database\Seeder;

class ExpiryMonitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpiryMonitor::factory()
            ->count(5)
            ->create();
    }
}
