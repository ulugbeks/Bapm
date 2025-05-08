<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppointmentSetting;

class AppointmentSettingController extends Controller
{
    public function edit()
    {
        $settings = AppointmentSetting::first();
        if (!$settings) {
            $settings = new AppointmentSetting();
            $settings->working_hours = [
                'Mon - Tues' => '09:00AM - 6:00PM',
                'Wed - Thu' => '09:00AM - 6:00PM',
                'Fri - Sat' => '09:00AM - 6:00PM',
                'Emergency' => '24/7 Hours 7 Days'
            ];
        }
        
        return view('admin.appointment.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'working_hours' => 'nullable|array',
            'active' => 'nullable|boolean',
        ]);
        
        $settings = AppointmentSetting::first();
        if (!$settings) {
            $settings = new AppointmentSetting();
        }
        
        $settings->title = $request->title;
        $settings->subtitle = $request->subtitle;
        $settings->description = $request->description;
        $settings->button_text = $request->button_text;
        $settings->active = $request->has('active');
        
        // Обработка рабочих часов
        if ($request->has('working_hours')) {
            $workingHours = [];
            $days = $request->input('working_hours.days', []);
            $hours = $request->input('working_hours.hours', []);
            
            foreach ($days as $index => $day) {
                if (!empty($day) && isset($hours[$index])) {
                    $workingHours[$day] = $hours[$index];
                }
            }
            
            $settings->working_hours = $workingHours;
        }
        
        $settings->save();
        
        return redirect()->route('appointment.edit')
            ->with('success', 'Appointment settings updated successfully');
    }
}