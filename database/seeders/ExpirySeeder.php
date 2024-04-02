<?php

namespace Database\Seeders;

use App\Models\Expiry;
use Illuminate\Database\Seeder;

class ExpirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expiry::factory()
            ->count(5)
            ->create();
    }
}
