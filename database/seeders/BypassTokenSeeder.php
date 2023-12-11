<?php

namespace Database\Seeders;

use App\Models\BypassToken;
use Illuminate\Database\Seeder;

class BypassTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BypassToken::factory()
            ->count(5)
            ->create();
    }
}
