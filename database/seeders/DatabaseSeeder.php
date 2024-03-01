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
        $this->call(PermissionsSeeder::class);

        $this->call(ActivityLogSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ContentSeeder::class);
        $this->call(ContentElementSeeder::class);
        $this->call(ContinentSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(FailedJobSeeder::class);
        $this->call(FirewallRuleSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(JobBatchSeeder::class);
        $this->call(JobBatchManagerSeeder::class);
        $this->call(JobManagerSeeder::class);
        $this->call(JobQueueWorkerSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(MediaSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(PageTemplateSeeder::class);
        $this->call(PlatformSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(PostalCodeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(RevisionSeeder::class);
        $this->call(RouteSeeder::class);
        $this->call(SeoSeeder::class);
        $this->call(SessionSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SyncSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(TimezoneSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WishlistSeeder::class);
        $this->call(WpCommentSeeder::class);
        $this->call(WpCommentMetaSeeder::class);
        $this->call(WpOptionSeeder::class);
        $this->call(WpPostSeeder::class);
        $this->call(WpPostMetaSeeder::class);
        $this->call(WpTermSeeder::class);
        $this->call(WpTermMetaSeeder::class);
        $this->call(WpTermRelationshipSeeder::class);
        $this->call(WpTermTaxonomySeeder::class);
        $this->call(WpUserSeeder::class);
        $this->call(WpUserMetaSeeder::class);
    }
}
