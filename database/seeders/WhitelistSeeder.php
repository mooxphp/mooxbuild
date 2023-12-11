<?php

namespace Database\Seeders;

use App\Models\Whitelist;
use Illuminate\Database\Seeder;

class WhitelistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Whitelist::factory()
            ->count(5)
            ->create();
    }
}
