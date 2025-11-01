<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // Old combined settings page (kept for backward compatibility)
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('order')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    // Individual settings pages
    public function general()
    {
        $settings = Setting::where('group', 'general')->orderBy('order')->get();
        return view('admin.settings.general', compact('settings'));
    }

    public function contact()
    {
        $settings = Setting::where('group', 'contact')->orderBy('order')->get();
        return view('admin.settings.contact', compact('settings'));
    }

    public function hours()
    {
        $settings = Setting::where('group', 'hours')->orderBy('order')->get();
        return view('admin.settings.hours', compact('settings'));
    }

    public function social()
    {
        $settings = Setting::where('group', 'social')->orderBy('order')->get();
        return view('admin.settings.social', compact('settings'));
    }

    public function seo()
    {
        $settings = Setting::where('group', 'seo')->orderBy('order')->get();
        return view('admin.settings.seo', compact('settings'));
    }

    public function delivery()
    {
        $settings = Setting::where('group', 'delivery')->orderBy('order')->get();
        return view('admin.settings.delivery', compact('settings'));
    }

    public function email()
    {
        $settings = Setting::where('group', 'email')->orderBy('order')->get();
        return view('admin.settings.email', compact('settings'));
    }

    public function features()
    {
        $settings = Setting::where('group', 'features')->orderBy('order')->get();
        return view('admin.settings.features', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'group' => 'nullable|string',
        ]);

        foreach ($request->input('settings', []) as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if (!$setting) continue;

            // Handle file uploads for image type
            if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                // Delete old image if exists
                if ($setting->value && str_starts_with($setting->value, '/storage/')) {
                    $oldImagePath = str_replace('/storage/', '', $setting->value);
                    Storage::disk('public')->delete($oldImagePath);
                }

                // Store new image
                $image = $request->file("settings.{$key}");
                $filename = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('settings', $filename, 'public');
                $value = '/storage/' . $path;
            }

            $setting->update(['value' => $value]);
        }

        // Clear settings cache
        Setting::clearCache();

        // Redirect back to the appropriate settings page
        $group = $request->input('group');
        if ($group && in_array($group, ['general', 'contact', 'hours', 'social', 'seo', 'delivery', 'email', 'features'])) {
            return redirect()->route("admin.settings.{$group}")
                ->with('success', ucfirst($group) . ' settings updated successfully!');
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}

