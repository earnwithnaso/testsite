<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show general site settings.
     */
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update site settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email',
            'site_phone' => 'nullable|string|max:20',
            'site_address' => 'nullable|string',
            'social_facebook' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_youtube' => 'nullable|url',
            'currency_code' => 'nullable|string|size:3',
            'currency_symbol' => 'nullable|string|max:5',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'account_name' => 'nullable|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Show SEO settings.
     */
    public function seo()
    {
        $seoSettings = SeoSetting::first() ?? new SeoSetting();
        return view('admin.settings.seo', compact('seoSettings'));
    }

    /**
     * Update SEO settings.
     */
    public function updateSeo(Request $request)
    {
        $validated = $request->validate([
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
        ]);

        $seoSetting = SeoSetting::first() ?? new SeoSetting();

        if ($request->hasFile('og_image')) {
            $path = $request->file('og_image')->store('seo', 'public');
            $validated['og_image'] = $path;
        }

        $seoSetting->fill($validated);
        $seoSetting->save();

        return redirect()->route('admin.settings.seo')
            ->with('success', 'SEO settings updated successfully.');
    }

    /**
     * Show environment configuration.
     */
    public function env()
    {
        // Read sensitive .env values
        $envData = [
            'APP_NAME' => env('APP_NAME'),
            'APP_ENV' => env('APP_ENV'),
            'APP_DEBUG' => env('APP_DEBUG'),
            'STRIPE_KEY' => env('STRIPE_KEY'),
            'STRIPE_SECRET' => env('STRIPE_SECRET') ? '***hidden***' : null,
            'MAIL_MAILER' => env('MAIL_MAILER'),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
        ];

        return view('admin.settings.env', compact('envData'));
    }

    /**
     * Show about/info page manager.
     */
    public function about()
    {
        $aboutSettings = SiteSetting::whereIn('key', ['about_title', 'about_content', 'about_mission', 'about_vision'])
            ->pluck('value', 'key')
            ->toArray();
        
        return view('admin.settings.about', compact('aboutSettings'));
    }

    /**
     * Update about page.
     */
    public function updateAbout(Request $request)
    {
        $validated = $request->validate([
            'about_title' => 'required|string|max:255',
            'about_content' => 'required|string',
            'about_mission' => 'nullable|string',
            'about_vision' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.about')
            ->with('success', 'About page updated successfully.');
    }
}
