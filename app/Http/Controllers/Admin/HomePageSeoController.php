<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePageSeo;

class HomePageSeoController extends Controller
{
    public function edit()
    {
        $seo = HomePageSeo::first();
        if (!$seo) {
            $seo = new HomePageSeo();
        }
        
        return view('admin.home-page-seo.edit', compact('seo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
        ]);
        
        $seo = HomePageSeo::first();
        if (!$seo) {
            $seo = new HomePageSeo();
        }
        
        $seo->fill($request->all());
        $seo->save();
        
        return redirect()->route('home-page-seo.edit')->with('success', 'Home page SEO settings updated successfully');
    }
}