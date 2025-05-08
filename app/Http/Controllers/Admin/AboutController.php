<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::first();
        if (!$about) {
            $about = new About();
        }
        
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image1' => 'nullable|string|max:255',
            'image2' => 'nullable|string|max:255',
            'image3' => 'nullable|string|max:255',
            'signature_image' => 'nullable|string|max:255',
            'doctor_name' => 'nullable|string|max:255',
            'doctor_title' => 'nullable|string|max:255',
            'doctor_image' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'second_section_subtitle' => 'nullable|string|max:255',
            'second_section_title' => 'nullable|string|max:255',
            'second_section_description' => 'nullable|string',
            'second_section_years' => 'nullable|integer',
            'second_section_feature1_title' => 'nullable|string|max:255',
            'second_section_feature1_description' => 'nullable|string',
            'second_section_feature2_title' => 'nullable|string|max:255',
            'second_section_feature2_description' => 'nullable|string',
        ]);
        
        $about = About::first();
        if (!$about) {
            $about = new About();
        }
        
        // Преобразование массива особенностей в JSON
        if ($request->has('features')) {
            $request->merge(['features' => json_encode($request->features)]);
        }
        
        $about->fill($request->all());
        $about->save();
        
        return redirect()->route('about.edit')->with('success', 'About information updated successfully');
    }
}