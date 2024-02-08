<?php

namespace Database\Seeders;

use App\Models\FailedJob;
use Illuminate\Database\Seeder;

class FailedJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FailedJob::factory()
            ->count(5)
            ->create();
    }
}
