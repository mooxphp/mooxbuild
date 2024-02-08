<?php

namespace Database\Seeders;

use App\Models\JobBatch;
use Illuminate\Database\Seeder;

class JobBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobBatch::factory()
            ->count(5)
            ->create();
    }
}
