<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactLocation;

class ContactLocationController extends Controller
{
    public function index()
    {
        $locations = ContactLocation::all();
        return view('admin.contact-locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.contact-locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        ContactLocation::create($request->all());

        return redirect()->route('contact-locations.index')
            ->with('success', 'Contact location created successfully.');
    }

    public function edit(ContactLocation $contactLocation)
    {
        return view('admin.contact-locations.edit', compact('contactLocation'));
    }

    public function update(Request $request, ContactLocation $contactLocation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $contactLocation->update($request->all());

        return redirect()->route('contact-locations.index')
            ->with('success', 'Contact location updated successfully');
    }

    public function destroy(ContactLocation $contactLocation)
    {
        $contactLocation->delete();

        return redirect()->route('contact-locations.index')
            ->with('success', 'Contact location deleted successfully');
    }
}