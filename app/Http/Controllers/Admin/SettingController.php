<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('order')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
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

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}

