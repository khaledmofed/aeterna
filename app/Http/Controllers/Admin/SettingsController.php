<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'site_name', 'site_tagline', 'logo_url', 'favicon_url',
            'meta_title', 'meta_description', 'og_image_url',
            'twitter_url', 'discord_url', 'telegram_url', 'github_url',
            'ga_id', 'maintenance_mode',
        ];

        foreach ($keys as $key) {
            $value = $key === 'maintenance_mode'
                ? ($request->boolean('maintenance_mode') ? '1' : '0')
                : ($request->input($key) ?? '');
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget('site_settings');
        return redirect()->route('admin.settings')->with('success', 'Settings saved.');
    }
}
