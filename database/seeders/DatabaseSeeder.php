<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Always ensure admin user exists (safe — uses updateOrCreate on email)
        $this->call([AdminUserSeeder::class]);

        // Always ensure site_settings keys exist (uses firstOrCreate — won't overwrite admin changes)
        $this->call([SiteSettingsSeeder::class]);

        // Always run seeders that use firstOrCreate (safe to re-run, won't overwrite admin changes)
        $this->call([ExplorerSeeder::class]);

        // Always (re)apply translated strings — idempotent setTranslations() calls, safe to re-run
        $this->call([
            TranslationsSeeder::class,
            JsonTranslationsSeeder::class,
        ]);

        // Skip content seeders if DB was previously seeded to preserve admin changes
        if (SiteSetting::where('key', '_content_seeded')->exists()) {
            $this->command->info('Content already seeded — skipping to preserve admin panel data.');
            return;
        }

        $this->call([
            NavSeeder::class,
            SolutionsSeeder::class,
            HeroSeeder::class,
            ArchitectureSeeder::class,
            TokenomicsSeeder::class,
            InvestorsSeeder::class,
            RoadmapSeeder::class,
            UseCasesSeeder::class,
            FooterSeeder::class,
        ]);

        // Mark as seeded so subsequent deploys skip content seeders
        SiteSetting::create(['key' => '_content_seeded', 'value' => '1', 'type' => 'text', 'group' => 'system']);
    }
}
