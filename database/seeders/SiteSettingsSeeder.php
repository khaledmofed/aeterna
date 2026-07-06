<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name',        'value' => 'AeternaX',                   'type' => 'text',    'group' => 'general'],
            ['key' => 'site_tagline',     'value' => 'AI Native Chain Abstraction Layer 1', 'type' => 'text', 'group' => 'general'],
            ['key' => 'logo_url',         'value' => '/site-assets/logo-wite.svg',  'type' => 'image',   'group' => 'general'],
            ['key' => 'favicon_url',      'value' => 'https://www.aeternaio.com/favicon.ico', 'type' => 'image', 'group' => 'general'],
            // SEO
            ['key' => 'meta_title',       'value' => 'Aeterna | AI Native & Chain Abstraction Layer', 'type' => 'text',     'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Deploy AI Agents across 15+ chains with a single Universal Address. 160K+ TPS, sub-100ms finality.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'og_image_url',     'value' => '/site-assets/app-preview.png', 'type' => 'image',   'group' => 'seo'],
            // Social
            ['key' => 'twitter_url',      'value' => 'https://twitter.com/aeternaio',       'type' => 'text', 'group' => 'social'],
            ['key' => 'discord_url',      'value' => 'https://discord.gg/rzJKbPSaaQ',       'type' => 'text', 'group' => 'social'],
            ['key' => 'telegram_url',     'value' => '#',                                    'type' => 'text', 'group' => 'social'],
            ['key' => 'github_url',       'value' => 'https://github.com/aeternaio',         'type' => 'text', 'group' => 'social'],
            // Analytics
            ['key' => 'ga_id',            'value' => '',                             'type' => 'text',    'group' => 'analytics'],
            // Maintenance
            ['key' => 'maintenance_mode', 'value' => '0',                            'type' => 'boolean', 'group' => 'maintenance'],
            // App Downloads
            ['key' => 'app_store_url',    'value' => '',                             'type' => 'text',    'group' => 'app'],
            ['key' => 'android_apk_url',  'value' => '',                             'type' => 'text',    'group' => 'app'],
        ];

        foreach ($settings as $setting) {
            // firstOrCreate: creates if missing, never overwrites admin changes
            SiteSetting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
