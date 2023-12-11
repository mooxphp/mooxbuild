<?php

namespace Database\Seeders;

use App\Models\Revision;
use Illuminate\Database\Seeder;

class RevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Revision::factory()
            ->count(5)
            ->create();
    }
}
