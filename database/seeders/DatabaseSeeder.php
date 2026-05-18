<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SiteSettingsSeeder::class,
            NavSeeder::class,
            HeroSeeder::class,
            ArchitectureSeeder::class,
            TokenomicsSeeder::class,
            InvestorsSeeder::class,
            RoadmapSeeder::class,
            UseCasesSeeder::class,
            FooterSeeder::class,
        ]);
    }
}
