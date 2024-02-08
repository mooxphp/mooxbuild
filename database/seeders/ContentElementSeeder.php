<?php

namespace Database\Seeders;

use App\Models\ContentElement;
use Illuminate\Database\Seeder;

class ContentElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContentElement::factory()
            ->count(5)
            ->create();
    }
}
