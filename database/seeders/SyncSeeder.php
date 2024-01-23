<?php

namespace Database\Seeders;

use App\Models\Sync;
use Illuminate\Database\Seeder;

class SyncSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sync::factory()
            ->count(5)
            ->create();
    }
}
