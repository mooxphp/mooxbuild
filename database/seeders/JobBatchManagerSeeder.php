<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobBatchManager;

class JobBatchManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobBatchManager::factory()
            ->count(5)
            ->create();
    }
}
