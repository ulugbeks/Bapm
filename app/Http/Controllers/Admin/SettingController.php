<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }
        
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_title' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'map_url' => 'nullable|string',
            'footer_cta_title' => 'nullable|string',
            'newsletter_text' => 'nullable|string',
        ]);
        
        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }
        
        $settings->fill($request->all());
        $settings->save();
        
        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully');
    }
}