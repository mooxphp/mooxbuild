<?php

namespace Database\Seeders;

use App\Models\WpOption;
use Illuminate\Database\Seeder;

class WpOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpOption::factory()
            ->count(5)
            ->create();
    }
}
