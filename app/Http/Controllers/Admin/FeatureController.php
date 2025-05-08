<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('order')->get();
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean',
        ]);

        Feature::create($request->all());

        return redirect()->route('features.index')
            ->with('success', 'Feature created successfully.');
    }

    public function show(Feature $feature)
    {
        return view('admin.features.show', compact('feature'));
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean',
        ]);

        $feature->update($request->all());

        return redirect()->route('features.index')
            ->with('success', 'Feature updated successfully');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();

        return redirect()->route('features.index')
            ->with('success', 'Feature deleted successfully');
    }
}