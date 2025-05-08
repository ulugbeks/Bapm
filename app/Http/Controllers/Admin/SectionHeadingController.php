<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionHeading;
use Illuminate\Http\Request;

class SectionHeadingController extends Controller
{
    /**
     * Show the form for editing section headings.
     */
    public function edit()
    {
        // Get or create the portfolio section heading
        $portfolio = SectionHeading::firstOrCreate(
            ['section_key' => 'portfolio'],
            [
                'subtitle' => 'Latest Portfolio',
                'title' => 'We\'ve Done A Lot\'s, Check',
                'title_span' => 'Our Latest Research'
            ]
        );
        
        // Get or create the blog section heading
        $blog = SectionHeading::firstOrCreate(
            ['section_key' => 'blog'],
            [
                'subtitle' => 'Recent Articles',
                'title' => 'Innovation in Focus Stories',
                'title_span' => 'Updated From Lab'
            ]
        );
        
        return view('admin.section-headings.edit', compact('portfolio', 'blog'));
    }

    /**
     * Update the section headings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'portfolio_subtitle' => 'nullable|string|max:255',
            'portfolio_title' => 'nullable|string|max:255',
            'portfolio_title_span' => 'nullable|string|max:255',
            'blog_subtitle' => 'nullable|string|max:255',
            'blog_title' => 'nullable|string|max:255',
            'blog_title_span' => 'nullable|string|max:255',
        ]);
        
        // Update portfolio section
        $portfolio = SectionHeading::where('section_key', 'portfolio')->first();
        if ($portfolio) {
            $portfolio->subtitle = $request->portfolio_subtitle;
            $portfolio->title = $request->portfolio_title;
            $portfolio->title_span = $request->portfolio_title_span;
            $portfolio->save();
        }
        
        // Update blog section
        $blog = SectionHeading::where('section_key', 'blog')->first();
        if ($blog) {
            $blog->subtitle = $request->blog_subtitle;
            $blog->title = $request->blog_title;
            $blog->title_span = $request->blog_title_span;
            $blog->save();
        }
        
        return redirect()->route('section-headings.edit')
            ->with('success', 'Section headings updated successfully');
    }
}