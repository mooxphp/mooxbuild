<?php

namespace Database\Seeders;

use App\Models\JobQueueWorker;
use Illuminate\Database\Seeder;

class JobQueueWorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobQueueWorker::factory()
            ->count(5)
            ->create();
    }
}
