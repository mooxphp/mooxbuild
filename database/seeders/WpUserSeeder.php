<?php

namespace Database\Seeders;

use App\Models\WpUser;
use Illuminate\Database\Seeder;

class WpUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WpUser::factory()
            ->count(5)
            ->create();
    }
}
