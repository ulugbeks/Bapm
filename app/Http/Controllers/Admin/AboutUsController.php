<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\Timeline;

class AboutUsController extends Controller
{
    /**
     * Show the form for editing the about page content.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // Get or create the about content
        $about = AboutUs::first();
        if (!$about) {
            $about = new AboutUs();
        }
        
        // Get timelines for the page
        $timelines = Timeline::orderBy('year', 'asc')->get();
        
        return view('admin.aboutus.edit', compact('about', 'timelines'));
    }

    /**
     * Update the about page content.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'additional_title' => 'nullable|string|max:255',
            'additional_description' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
        ]);
        
        $about = AboutUs::first();
        if (!$about) {
            $about = new AboutUs();
        }
        
        $about->fill($request->all());
        $about->save();
        
        return redirect()->route('aboutus.edit')->with('success', 'About page content updated successfully');
    }
}