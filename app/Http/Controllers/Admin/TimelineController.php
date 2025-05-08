<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timeline;

class TimelineController extends Controller
{
    public function index()
    {
        $timelines = Timeline::orderBy('year')->get();
        return view('admin.timeline.index', compact('timelines'));
    }

    public function create()
    {
        return view('admin.timeline.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        Timeline::create($request->all());

        return redirect()->route('timeline.index')
            ->with('success', 'Timeline item created successfully.');
    }

    public function edit(Timeline $timeline)
    {
        return view('admin.timeline.edit', compact('timeline'));
    }

    public function update(Request $request, Timeline $timeline)
    {
        $request->validate([
            'year' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        $timeline->update($request->all());

        return redirect()->route('timeline.index')
            ->with('success', 'Timeline item updated successfully');
    }

    public function destroy(Timeline $timeline)
    {
        $timeline->delete();

        return redirect()->route('timeline.index')
            ->with('success', 'Timeline item deleted successfully');
    }
}