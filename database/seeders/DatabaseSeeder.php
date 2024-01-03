<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(AuthorSeeder::class);
        $this->call(BlacklistSeeder::class);
        $this->call(BypassTokenSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(ContinentSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(PageTemplateSeeder::class);
        $this->call(PlatformSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(PostalCodeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(RevisionSeeder::class);
        $this->call(SeoSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(TimezoneSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WhitelistSeeder::class);
    }
}
