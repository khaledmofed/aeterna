<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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
            'ga_id', 'maintenance_mode', 'custom_css', 'custom_js',
            'app_store_url', 'android_apk_url', 'app_version_text',
        ];

        foreach ($keys as $key) {
            $value = $key === 'maintenance_mode'
                ? ($request->boolean('maintenance_mode') ? '1' : '0')
                : ($request->input($key) ?? '');
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Handle APK file upload — overrides the android_apk_url text field
        if ($request->hasFile('android_apk_file') && $request->file('android_apk_file')->isValid()) {
            $path = $request->file('android_apk_file')->storeAs('apk', 'Aeterna.apk', 'public');
            SiteSetting::updateOrCreate(['key' => 'android_apk_url'], ['value' => '/storage/' . $path]);
        }

        Cache::forget('site_settings');
        return redirect()->route('admin.settings')->with('success', 'Settings saved.');
    }
}
