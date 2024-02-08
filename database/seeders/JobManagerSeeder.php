<?php

namespace Database\Seeders;

use App\Models\JobManager;
use Illuminate\Database\Seeder;

class JobManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobManager::factory()
            ->count(5)
            ->create();
    }
}
