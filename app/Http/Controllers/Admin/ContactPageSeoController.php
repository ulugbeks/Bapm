<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactPageSeo;

class ContactPageSeoController extends Controller
{
    public function edit()
    {
        $seo = ContactPageSeo::first();
        if (!$seo) {
            $seo = new ContactPageSeo();
        }
        
        return view('admin.contact-page-seo.edit', compact('seo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
        ]);
        
        $seo = ContactPageSeo::first();
        if (!$seo) {
            $seo = new ContactPageSeo();
        }
        
        $seo->fill($request->all());
        $seo->save();
        
        return redirect()->route('contact-page-seo.edit')->with('success', 'Contact page SEO settings updated successfully');
    }
}